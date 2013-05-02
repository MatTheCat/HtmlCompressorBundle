<?php

namespace MatTheCat\HtmlCompressorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use MatTheCat\HtmlCompressorBundle\DependencyInjection\MatTheCatHtmlCompressorExtension;

class MatTheCatHtmlCompressorBundle extends Bundle
{
    public function __construct()
    {
        $this->extension = new MatTheCatHtmlCompressorExtension;
    }
}
