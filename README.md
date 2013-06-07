HtmlCompressorBundle
====================
Allow to minify cacheable HTML and XML responses using [htmlcompressor](https://code.google.com/p/htmlcompressor/).

## Installation

### Get the bundle

Add this line in your composer.json **require** section:

``` json
"matthecat/htmlcompressor-bundle": "dev-master"
```

and run this command in your project directory:

``` bash
$ php composer.phar update matthecat/htmlcompressor-bundle
```

### Enable the bundle

Edit your application's kernel:
``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new MatTheCat\HtmlCompressorBundle\MatTheCatHtmlCompressorBundle(),
    );
}
```
Now, it's time to configure it!

## Configuration

    # app/config/config.yml
    html_compressor:
        enabled: true
        java:    /usr/bin/java
        jar:     ~
        options: {}

<table>
    <thead>
        <tr>
            <th></th>
            <th>Description</th>
            <th>Default value</th>
            <th>Exemple</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>enabled</th>
            <td>determine if responses must be minified if they can</td>
            <td>true</td>
            <td>-</td>
        </tr>
        <tr>
            <th>java</th>
            <td>path to Java executable</td>
            <td>/usr/bin/java</td>
            <td>-</td>
        </tr>
        <tr>
            <th>jar</th>
            <td>path to htmlcompressor executable</td>
            <td>-</td>
            <td>%kernel.root_dir%/Resources/java/htmlcompressor-1.5.3.jar</td>
        </tr>
        <tr>
            <th>options</th>
            <td>any option described in the <a href="https://code.google.com/p/htmlcompressor/wiki/Documentation#Compressing_HTML_and_XML_files_from_a_command_line">htmlcompressor documentation</a></td>
            <td>-</td>
            <td>{ '--compress-js': ~, '--js-compressor': closure }</td>
        </tr>
    </tbody>
</table>