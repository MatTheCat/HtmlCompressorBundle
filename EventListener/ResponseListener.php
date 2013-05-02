<?php

namespace MatTheCat\HtmlCompressorBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Process\ProcessBuilder;

class ResponseListener
{
    protected $javaPath;
    protected $htmlCompressorPath;
    protected $htmlCompressorOptions;

    public function __construct($javaPath, $htmlCompressorPath, array $htmlCompressorOptions)
    {
        $this->javaPath = $javaPath;
        $this->htmlCompressorPath = $htmlCompressorPath;
        $this->htmlCompressorOptions = $htmlCompressorOptions;
    }

    public function onKernelResponse(FilterResponseEvent $event) {
        $response = $event->getResponse();
        $contentType = $response->headers->get('Content-type');
        if(
            !$response->isCacheable() ||
            in_array(
                substr($contentType, strrpos($contentType, '/')+1),
                array('xml', 'html')
            )
        ) {
            return;
        }
        $pb = new ProcessBuilder(
            array(
                $this->javaPath,
                '-jar',
                $this->htmlCompressorPath
            )
        );
        foreach($this->htmlCompressorOptions as $option => $value) {
            if(!is_null($option)) {
                $pb->add($option);

                if(!is_null($value)) {
                    $pb->add($value);
                }
            }
        }
        $pb->add($input = tempnam(sys_get_temp_dir(), 'html_compressor'));
        file_put_contents($input, $response->getContent());
        $proc = $pb->getProcess();
        $code = $proc->run();
        unlink($input);

        if (!$code) {
            $response->setContent($proc->getOutput());
        }
    }
}