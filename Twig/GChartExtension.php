<?php

namespace SaadTazi\GChartBundle\Twig;

use SaadTazi\GChartBundle\Chart;

/**
 * Defines GChart Twig functions
 */
class GChartExtension extends \Twig_Extension {

    /**
     * @param array $resources a list of resources (see Resources/g_chart.xml)
     */
    public function __construct(array $resources = array()) {
        $this->resources = $resources;
    }

    /**
     * Defines the Twig functions exposed by this extension
     * @return array list of Twig functions
     */
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('gchart_area_chart', array($this, 'gchartAreaChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_bar_chart', array($this, 'gchartBarChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_bubble_chart', array($this, 'gchartBubbleChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_calendar', array($this, 'gchartCalendar'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_candlestick_chart', array($this, 'gchartCandleStickChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_column_chart', array($this, 'gchartColumnChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_combo_chart', array($this, 'gchartComboChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_donut_chart', array($this, 'gchartDonutChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_gantt', array($this, 'gchartGantt'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_gauge', array($this, 'gchartGauge'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_geo_chart', array($this, 'gchartGeoChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_get_icon_pin_url', array($this, 'getIconPinUrl'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('gchart_get_icon_url', array($this, 'getIconUrl'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('gchart_get_letter_pin_url', array($this, 'getLetterPinUrl'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('gchart_get_pie_chart_url', array($this, 'getPieChartUrl'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('gchart_get_pie_chart3d_url', array($this, 'getPieChart3DUrl'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('gchart_get_qrcode_url', array($this, 'getQrCodeUrl')),
            new \Twig_SimpleFunction('gchart_histogram', array($this, 'gchartHistogram'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_interval', array($this, 'gchartInterval'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_line_chart', array($this, 'gchartLineChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_map', array($this, 'gchartMap'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_org_chart', array($this, 'gchartOrgChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_pie_chart', array($this, 'gchartPieChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_sankey', array($this, 'gchartSankey'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_scatter_chart', array($this, 'gchartScatterChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_stepped_area_chart', array($this, 'gchartSteppedAreaChart'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_table', array($this, 'gchartTable'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_timeline', array($this, 'gchartTimeline'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_treemap', array($this, 'gchartTreeMap'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_trendlines', array($this, 'gchartTrendlines'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_waterfall', array($this, 'gchartWaterfall'), array('is_safe' => array('html'), 'needs_environment' => true)),
            new \Twig_SimpleFunction('gchart_word_tree', array($this, 'gchartWordTree'), array('is_safe' => array('html'), 'needs_environment' => true)),
        );
    }

    /**
     * gchart_area_chart definition
     */
    public function gchartAreaChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'AreaChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_bar_chart definition
     */
    public function gchartBarChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'BarChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_bubble_chart definition
     */
    public function gchartBubbleChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'BubbleChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_calendar definition
     */
    public function gchartCalendar(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'Calendar', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_candlestick_chart definition - needs 5 cols
     * @see http://code.google.com/apis/chart/interactive/docs/gallery/candlestickchart.html#Data_Format
     */
    public function gchartCandleStickChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'CandlestickChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_column_chart definition
     */
    public function gchartColumnChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'ColumnChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_combo_chart definition
     */
    public function gchartComboChart(\Twig_Environment $env, $data, $id, $width, $height, $seriesType = 'line', $title = null, $config = array(), $events = array()) {
        if (isset($seriesType) && !isset($config['seriesType'])) {
            $config['seriesType'] = $seriesType;
        }
        return $this->renderGChart($env, $data, $id, 'ComboChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_donut_chart definition
     */
    public function gchartDonutChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        if(!array_key_exists('pieHole', $config)) {
            $config['pieHole'] = 0.4; // default pieHole value that makes the pie a donut
        }
        return $this->renderGChart($env, $data, $id, 'DonutChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_calendar definition
     */
    public function gchartGantt(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'Gantt', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_gauge definition
     */
    public function gchartGauge(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'Gauge', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_geo_chart definition
     */
    public function gchartGeoChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'GeoChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_histogram definition
     */
    public function gchartHistogramChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'Histogram', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_interval definition
     */
    public function gchartIntervalChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'Interval', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_line_chart definition
     */
    public function gchartLineChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'LineChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_map definition
     */
    public function gchartMap(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'Map', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_org_chart definition
     */
    public function gchartOrgChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'OrgChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_pie_chart definition
     */
    public function gchartPieChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'PieChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_sankey definition
     */
    public function gchartSankey(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'Sankey', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_column_chart definition
     * note: The x-axis column cannot be of type string
     */
    public function gchartScatterChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $xLabel = null, $yLabel = null, $config = array(), $events = array()) {
        if (!is_null($xLabel)) {
            $hAxis = isset($config['hAxis'])? $config['hAxis']: array();
            $hAxis['title'] = $xLabel;
            $config['hAxis'] = $hAxis;
        }
        if (!is_null($yLabel)) {
            $vAxis = isset($config['vAxis'])? $config['vAxis']: array();
            $vAxis['title'] = $yLabel;
            $config['vAxis'] = $vAxis;
        }

        return $this->renderGChart($env, $data, $id, 'ScatterChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_stepped_area_chart definition
     */
    public function gchartSteppedAreaChart(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        if (!is_null($yLabel)) {
            $vAxis = isset($config['vAxis'])? $config['vAxis']: array();
            $vAxis['title'] = $yLabel;
            $config['vAxis'] = $vAxis;
        }

        return $this->renderGChart($env, $data, $id, 'SteppedAreaChart', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_table definition
     */
    public function gchartTable(\Twig_Environment $env, $data, $id, $config = null, $events = array()) {
        return $this->renderTemplate($env, 'gChartTemplate', array('chartType' => 'Table', 'data' => $data, 'id' => $id, 'config' => $config, 'events' => $events ));
    }

    /**
     * gchart_timeline definition
     */
    public function gchartTimeline(\Twig_Environment $env, $data, $id, $config = null, $events = array()) {
        return $this->renderGChart($env, $data, $id, 'Timeline', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_treemap definition - needs 4 cols
     * @see http://code.google.com/apis/chart/interactive/docs/gallery/treemap.html#Data_Format
     */
    public function gchartTreeMap(\Twig_Environment $env, $data, $id, $width, $height, $title = '', $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'TreeMap', $width, $height, $title, $config, true, $events);
    }

    /**
     * gchart_trendlines
     * note: The x-axis column cannot be of type string
     */
    public function gchartTrendlines(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $xLabel = null, $yLabel = null, $config = array(), $events = array()) {
        if (!is_null($xLabel)) {
            $hAxis = isset($config['hAxis'])? $config['hAxis']: array();
            $hAxis['title'] = $xLabel;
            $config['hAxis'] = $hAxis;
        }
        if (!is_null($yLabel)) {
            $vAxis = isset($config['vAxis'])? $config['vAxis']: array();
            $vAxis['title'] = $yLabel;
            $config['vAxis'] = $vAxis;
        }

        return $this->renderGChart($env, $data, $id, 'Trendlines', $width, $height, $title, $config, false, $events);
    }

    /**
     * gchart_waterfall definition
     */
    public function gchartWaterfall(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        $configs['bar'] = array('groupWidth' => '100%');
        return $this->renderGChart($env, $data, $id, 'Waterfall', $width, $height, $title, $config, false, $events);
    }


    /**
     * gchart_word_tree definition
     */
    public function gchartWordTree(\Twig_Environment $env, $data, $id, $width, $height, $title = null, $config = array(), $events = array()) {
        return $this->renderGChart($env, $data, $id, 'WordTree', $width, $height, $title, $config, false, $events);
    }

    /**
     * Generic method that returns html of gchart charts
     */
    protected function renderGChart(\Twig_Environment $env, $data, $id, $type, $width, $height, $title = null, $config = array(), $addDivWithAndHeight = false, $events = array()) {
        $config['width'] = $width;
        $config['height'] = $height;
        if (!isset($config['title']) && !is_null($title) && trim($title) != '') { $config['title'] = $title;}
        return $this->renderTemplate($env, 'gChartTemplate', array('chartType' => $type, 'data' => $data, 'id' => $id, 'config' => $config, 'events' => $events  ), $addDivWithAndHeight);
    }

    /**
     * generic method that generates a Twig template based on its name
     */
    protected function renderTemplate(\Twig_Environment $env, $templateName, $params, $addDivWithAndHeight = false) {
        $templ = false;
        if (isset($this->resources[$templateName])) {
            $templ = $env->loadTemplate($this->resources[$templateName]);
        } else {
            throw new \Exception('mmm, template not found');
        }
        if ($addDivWithAndHeight && isset($params['config']) && isset($params['config']['width']) && isset($params['config']['height'])) {
            $params['addDivWithAndHeight'] = true;
            $params['width'] = $params['config']['width'];
            $params['height'] = $params['config']['height'];
        } else {
            $params['addDivWithAndHeight'] = false;
        }

        return $templ->render($params);
    }

    /**
     * gchart_get_qrcode_url definition
     */
    public function getQrCodeUrl($text, $params = array(), $rawParams = array() ) {
        $chart = new Chart\QrCode();
        return $chart->getUrl($text, $params, $rawParams);
    }

    public function getPieChartUrl($data, $id, $width, $height, $title = null, $params = array()) {
        $chart = new Chart\PieChart();
        return $chart->getUrl($data, $width, $height, $title, $params);
    }

    public function getPieChart3DUrl($data, $id, $width, $height, $title = null, $params = array()) {
        $chart = new Chart\PieChart3D();
        return $chart->getUrl($data, $width, $height, $title, $params);
    }

    public function getIconUrl($type, $data) {
        $chart = new Chart\DynamicIcon();
        return $chart->getUrl($type, $data);
    }

    public function getLetterPinUrl($text, $fill_color, $text_color = '000000', $with_shadow = false, $pin_style = 'pin') {
        $type = $with_shadow? 'd_map_xpin_letter_withshadow': 'd_map_pin_xletter';
        $data = array($pin_style, $text, $fill_color, $text_color);
        return $this->getIconUrl($type, $data);
    }

    public function getIconPinUrl($icon_srting, $fill_color, $with_shadow = false, $pin_style = 'pin') {
        $type = $with_shadow? 'd_map_xpin_icon_withshadow': 'd_map_xpin_icon';
        $data = array($pin_style, $icon_srting, $fill_color);
        return $this->getIconUrl($type, $data);
    }

    /**
     * @return string
     */
    public function getName() {
        return 'g_chart';
    }

}
