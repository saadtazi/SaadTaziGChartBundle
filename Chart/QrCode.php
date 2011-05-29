<?php

namespace SaadTazi\GChartBundle\Chart;

/**
 * Super simple class that uses google charts
 * to generate QrCode image
 * @link http://code.google.com/apis/chart/image/docs/gallery/qr_codes.html
 */
class QrCode extends BaseChart {
    
    
    protected $defaults = array(
        'width'             => 150,
        'height'            => 150,
        'encoding'          => 'UTF-8',
        'correctionlevel'   => 'L'
    );
    
    public function __construct(array $options = array()) {
        $this->options = array_merge($this->defaults, $options);
    }
    
    public function getUrl($text, $params = array(), $rawParams = array() /* $width = null, $height = null, $encoding = null, $correctionlevel = null*/) {
        $width           = isset($params['width']) ? $params['width']: $this->options['width'];
        $height          = isset($params['height']) ? $params['height']: $this->options['height'];
        $encoding        = isset($params['encoding'])? $params['encoding']: $this->options['encoding'];
        $correctionLevel = isset($params['correctionLevel'])? $params['correctionLevel']: $this->options['correctionlevel'];
        
        
        $params = array(
            'cht'  => 'qr',
            'chs'  => $width . 'x' . $height,
            'chl'  => urlencode($text),
            'chld' => $correctionLevel,
            'choe' => $encoding
            
        );
        $params = array_merge($params, $rawParams);
        return self::BuildUrl($params);
    }
}
