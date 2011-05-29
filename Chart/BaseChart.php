<?php

namespace SaadTazi\GChartBundle\Chart;

/**
 * Super simple class that uses google charts
 * to generate QrCode image
 * @link http://code.google.com/apis/chart/image/docs/gallery/qr_codes.html
 */
class BaseChart {
    const GOOGLE_CHART_URL = 'https://chart.googleapis.com/chart';
    
    protected $options = array(
        'width'             => 150,
        'height'            => 150,
    );
    protected $managedOptions = array();
    
    protected function BuildUrl($params) {
        $paramArray = array();
        
        //can't urlencode here... so do it manually
        foreach ($params as $key => $value) {
            if (!is_null($value)) {
                $paramArray[] = $key . '=' . $value; 
            }
            
        }
        $paramString = implode('&', $paramArray);
        return self::GOOGLE_CHART_URL . '?' . $paramString;
    }
    
    public static function urlEncode(&$value) {
        $value = urlencode($value);
        return $value;
    }
}

