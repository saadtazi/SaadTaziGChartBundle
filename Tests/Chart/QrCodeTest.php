<?php

namespace SaadTazi\GChartBundle\Tests\Chart;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use SaadTazi\GChartBundle\Chart\QrCode;

class QrCodeTest extends TestCase
{
    protected function setUp() {
        $this->testStrings = array(
            '1- test string',
            '2- with accentued chàräçtèr'
        );
    }
    
    public function testQrCodeUrlWithDefaultOptions()
    {
        $api = new QrCode();
        foreach ($this->testStrings as $test) {
            $this->assertEquals('https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl='. urlencode($test) .'&chld=L&choe=UTF-8', $api->getUrl($test));
        }
    }

    
    public function testQrCodeUrlInitializedWithAllOptions()
    {
        $api = new QrCode(array(
            'width'    => 120,
            'height'   => 120,
            'encoding' => 'ISO-8859-1',
            'correctionlevel' => 'M'
        ));

        foreach ($this->testStrings as $test) {
            $this->assertEquals('https://chart.googleapis.com/chart?cht=qr&chs=120x120&chl='. urlencode($test) .'&chld=M&choe=ISO-8859-1', $api->getUrl($test));
        }
    }
    
    public function testQrCodeUrlWithParams()
    {
        $api = new QrCode();

        foreach ($this->testStrings as $test) {
            $this->assertEquals('https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl='. urlencode($test) .'&chld=L&choe=UTF-8', $api->getUrl($test, array('width'=> 200, 'height' => 200)));
        }
    }
    
    public function testQrCodeUrlWithRawParams()
    {
        $api = new QrCode();

        foreach ($this->testStrings as $test) {
            $this->assertEquals('https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl='. urlencode($test) .'&chld=L&choe=UTF-8&test=value', $api->getUrl($test, array('width'=> 200, 'height' => 200), array('test' => 'value')));
        }
    }


}
