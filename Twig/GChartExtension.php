<?php

namespace SaadTazi\GChartBundle\Twig;

use SaadTazi\GChartBundle\Chart;


/**
 * Defines GChart Twig functions
 */
class GChartExtension extends \Twig_Extension {

    
    protected $environment;

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
            'gchart_get_qrcode_url' => new \Twig_Function_Method($this, 'getQrCodeUrl'),
            'gchart_pie_chart' => new \Twig_Function_Method($this, 'gchartPieChart', array('is_safe' => array('html'))),
            'gchart_column_chart' => new \Twig_Function_Method($this, 'gchartColumnChart', array('is_safe' => array('html'))),
            'gchart_line_chart' => new \Twig_Function_Method($this, 'gchartLineChart', array('is_safe' => array('html'))),
            'gchart_bar_chart' => new \Twig_Function_Method($this, 'gchartBarChart', array('is_safe' => array('html'))),
            'gchart_area_chart' => new \Twig_Function_Method($this, 'gchartAreaChart', array('is_safe' => array('html'))),
            'gchart_scatter_chart' => new \Twig_Function_Method($this, 'gchartScatterChart', array('is_safe' => array('html'))),
            'gchart_combo_chart' => new \Twig_Function_Method($this, 'gchartComboChart', array('is_safe' => array('html'))),
            'gchart_gauge' => new \Twig_Function_Method($this, 'gchartGauge', array('is_safe' => array('html'))),
            'gchart_table' => new \Twig_Function_Method($this, 'gchartTable', array('is_safe' => array('html'))),
            'gchart_get_pie_chart_url' => new \Twig_Function_Method($this, 'getPieChartUrl', array('is_safe' => array('html'))),
            'gchart_get_pie_chart3d_url' => new \Twig_Function_Method($this, 'getPieChart3DUrl', array('is_safe' => array('html'))),
            
        );
    }
    
    /**
     * gchart_pie_chart definition
     */
    public function gchartPieChart($data, $id, $width, $height, $title = null, $config = array()) {
        return $this->renderGChart($data, $id, 'PieChart', $width, $height, $title, $config);
    }
    /**
     * gchart_column_chart definition
     */
    public function gchartColumnChart($data, $id, $width, $height, $title = null, $config = array()) {
        return $this->renderGChart($data, $id, 'ColumnChart', $width, $height, $title, $config);
    }
    /**
     * gchart_line_chart definition
     */
    public function gchartLineChart($data, $id, $width, $height, $title = null, $config = array()) {
        return $this->renderGChart($data, $id, 'LineChart', $width, $height, $title, $config);
    }
    /**
     * gchart_bar_chart definition
     */
    public function gchartBarChart($data, $id, $width, $height, $title = null, $config = array()) {
        return $this->renderGChart($data, $id, 'BarChart', $width, $height, $title, $config);
    }
    
    /**
     * gchart_area_chart defniition
     */
    public function gchartAreaChart($data, $id, $width, $height, $title = null, $config = array()) {
        return $this->renderGChart($data, $id, 'AreaChart', $width, $height, $title, $config);
    }
    
    /**
     * gchart_column_chart definition
     * note: The x-axis column cannot be of type string
     */
    public function gchartScatterChart($data, $id, $width, $height, $title = null, $xLabel = null, $yLabel = null, $config = array()) {
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
        
        return $this->renderGChart($data, $id, 'ScatterChart', $width, $height, $title, $config);
    }
    
    /**
     * gchart_combo_chart definition
     */
    public function gchartComboChart($data, $id, $width, $height, $seriesType = 'line', $title = null, $config = array()) {
        if (isset($seriesType) && !isset($config['seriesType'])) {
            $config['seriesType'] = $seriesType;
        }
        return $this->renderGChart($data, $id, 'ComboChart', $width, $height, $title, $config);
    }
    
    /**
     * gchart_gauge definition
     */
    public function gchartGauge($data, $id, $width, $height, $title = null, $config = array()) {
        return $this->renderGChart($data, $id, 'Gauge', $width, $height, $title, $config);
    }
    
    /**
     * gchart_table definition
     */
    public function gchartTable($data, $id, $config = null) {
        return $this->renderTemplate('gChartTemplate', array('chartType' => 'Table', 'data' => $data, 'id' => $id, 'config' => $config ));
    }
    
    
    /**
     * Generic method that returns html of gchart charts
     */
    protected function renderGChart($data, $id, $type, $width, $height, $title = null, $config = array()) {
        $config['width'] = $width;
        $config['height'] = $height;
        if (!isset($config['title'])) { $config['title'] = $title;}
        return $this->renderTemplate('gChartTemplate', array('chartType' => $type, 'data' => $data, 'id' => $id, 'config' => $config ));
    }
    
    /**
     * generic method that generate a Twig template based on its name
     */
    protected function renderTemplate($templateName, $params) {
        $templ = false;
        if (isset($this->resources[$templateName])) {
            $templ = $this->environment->loadTemplate($this->resources[$templateName]);
        } else {
            throw new \Exception('mmm, template not found');
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
    
    /**
     * to be able to call a Twig template from the Twig extension
     * @param \Twig_Environment $environment 
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    
    /**
     * @return string
     */
    public function getName()
    {
        return 'g_chart';
    }

}
