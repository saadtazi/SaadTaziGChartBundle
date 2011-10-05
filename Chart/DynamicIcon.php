<?php

namespace SaadTazi\GChartBundle\Chart;

/**
 * Super simple class that uses google charts
 * to generate Dynamic icon image, like markers
 * @link http://code.google.com/apis/chart/infographics/docs/dynamic_icons.html
 */
class DynamicIcon extends BaseChart {

    public function __construct(array $options = array()) {
    
    }
    
    public function getUrl($type, $data) {
        if (is_array($data)) {
            $data = implode('|', $data);
        }
        
        $params = array(
            //chst=d_bubble_icon_text_small&chld=ski|bb|Wheeee!|FFFFFF|000000
            'chst'  => $type,
            'chld'  => $data
            
        );
        $params = array_merge($params);
        return self::BuildUrl($params);
    }
}
