What is it?
===========
This is a super simple Bundle that faciliatate the [Google Chart Image API](http://code.google.com/apis/chart/image/) and the [Google Chart Tool](http://code.google.com/apis/chart/interactive/docs/index.html).

It allows to render:
  * QRCode 
  * Pie Chart (3 ways: canvas or svg, simple image from url, simple 3d image from url)
  * Column Chart
  * Bar Chart
  * Area Chart
  * scatter Chart
  * Combo Chart
  * Table
  * Gauge

Make sure you read the [Chart Image terms](http://code.google.com/apis/chart/image/terms.html) and [Chart tool terms](http://code.google.com/apis/chart/interactive/terms.html) before using that bundle. 

It also contains some Twig extension that facilitates the integration.

How to install it?
------------------

The easiest way is to install it is to git clone or git add module:

<pre>git submodule add git://github.com/saadtazi/GChartBundle.git src/Bundle/SaadTazi/GChartBundle</pre>

Then add it to your app/autoload.php and app/AppKernel.php

    //in app/Autoload.php
    $loader->registerNamespaces(array(     ...
        'SaadTazi'         => __DIR__.'/../src',
        ..
    ));
  
    //in app/AppKernel.php
          $bundles = array(
              ...
              new SaadTazi\GChartBundle\GChartBundle(),
              ...
          );


Optional: If you want to see the demo page, add the following to your routing.yml (requires Twig):

    _demo:
        resource: "@GChartBundle/Resources/config/routing.yml"
        type:     yaml
        prefix:   /gchart

Then you should be able to go to http://your.site.com/gchart/demo

Don't forget to include the required javascript in your layout, for example:
        <script type="text/javascript">
            //adds the package you need
            google.load("visualization", "1", {packages:["corechart", 'table', 'gauge']});
            //jquery mini-dependency
            google.load('jquery', '1.6.0');
        </script> 

How to use it?
--------------

Mmm, please check the Controller\DemoController to see how to build DataTable,
and Resources\views\Demo\demo.html.twig

Notes
-----
I implemented almost all the corechart chart types from the Google Chart Tool.
But I only implemented 3 Google Chart Image types, because <strike>they are ugly</strike> almost all of them can be built using the Google Chart Tool.

You don't have to use the Twig functions: you can use the php classes (in DataTable and or in Chart).
But you will probably find it a little bit boring.

TODO
----
Add (a lot of) unit tests. 