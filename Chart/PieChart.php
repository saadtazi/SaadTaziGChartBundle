<?php

namespace SaadTazi\GChartBundle\Chart;

use SaadTazi\GChartBundle\DataTable\DataTable;
/**
 * Super simple class that uses google charts
 * to generate QrCode image
 * @link http://code.google.com/apis/chart/image/docs/gallery/pie_charts.html
 */
class PieChart extends BaseChart {
    const CHART_TYPE = 'p';
    
    protected $defaults = array(
        'width'  => 400,
        'height' => 200,
        //'color'  => '0000FF',
        'withLabels' => true,
        'transparent' => false,
        'titleColor'  => '000000',
        'withLegend'  => true
        
    );
    
    public function __construct(array $options = array()) {
        $this->options = array_merge($options, $this->defaults);
        
    }
    
    /**
     * Returns a URL for the Google Image Chart
     * 
     * @param DataTable $data (labels are keys... if associative array)
     * @param integer $width
     * @param integer $height
     * @param array $color
     * @param string $title
     * @return string the Google Image Chart URL of the PieChart 
     */
    public function getUrl(DataTable $data, $width, $height, $title = null, $params = array(), $rawParams = array()) {
        
        $title      = isset($title) ? $title: null;
        $titleSize  = isset($params['titleSize']) ? $params['titleSize']: null;
        $titleColor  = isset($params['titleColor']) ? $params['titleColor']: $this->options['titleColor'];
        $withLabels = isset($params['withLabels']) ? $params['withLabels']: $this->options['withLabels'];
        $withLegend = isset($params['withLegend']) ? $params['withLegend']: $this->options['withLegend'];
        $transparent = isset($params['transparent']) ? $params['transparent']: $this->options['transparent'];
        $backgroundFillColor = isset($params['backgroundFillColor']) ? $params['backgroundFillColor']: null;
        $color = isset($params['color']) ? : null;
        
        if (is_array($color)) {
            $color = implode('|', $color);
        } else {
            $color = $color? $color: null;
        }
        
        $labels = null;
        if ($withLabels) {
            $labels = implode('|', $data->getLabels());
        }
        //still no legend but should have one?  Take the default one...
        $legendString = $this->getLegendParamValue($data);
        
        $dataString = $this->getValueParamValue($data);
        
        //backgroundFill
        if (!is_null($backgroundFillColor)) {
            $chf = 'bg';
            if ($transparent) {
                $chf = 'a';
            }
            $chf = $chf . ',s,' . $backgroundFillColor;
        }
        $params = array(
            'chd' => $dataString,
            'cht'  => static::CHART_TYPE,
            'chs'  => $width . 'x' . $height,
            'chco' => $color,
            'chtt' => $title,
            'chts' => $titleColor . ',' . $titleSize,
            'chl'  => isset($labels)? $labels : null,
            'chdl' => isset($legendString)? $legendString : null,
            'chf'  => isset($chf)? $chf : null,
        );
        
        $params = array_merge($params, $rawParams);
        
        return self::BuildUrl($params);
    }
    public function getLegendParamValue($data) {
        return $this->getValueParamForPos($data, 0, '|');
    }
    public function getValueParamValue($data) {
        return 't:' . $this->getValueParamForPos($data, 1);
    }
    protected function getValueParamForPos(DataTable $data, $pos, $separator = ',') {
        $values = $data->getValuesForPosition($pos);
        //urlEncode...
        array_walk($values, '\SaadTazi\GChartBundle\Chart\BaseChart::urlEncode');
        return implode($separator, $values);
            
        
    }
    
    
}
