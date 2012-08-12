<?php


namespace SaadTazi\GChartBundle\DataTable;

/**
 * This class represents a cell in a Google DataTable
 * @link http://code.google.com/apis/chart/interactive/docs/reference.html#DataTable
 */
class DataCell {
    
    protected $v    = null;
    protected $f = null;
    protected $p  = null;
    
    public function __construct($v, $f = null, $p = null) {
        
        $this->v = $v;
        $this->f = $f;
        $this->p = $p;
    }
    
    /**
     * Create an instance of DataCell from an array.
     * 
     * @param array $arr asssociative array expected 
     *     keys: 
     *     - 'v': value - recommanded, almost mandatory
     *     - 'f' (text representation of value
     *     - 'p': some options (array) - see http://code.google.com/apis/chart/interactive/docs/reference.html#rowsproperty
     * @return DataCell 
     */
    public static function fromArray(array $arr) {
        $v = isset($arr['v'])? $arr['v'] : null;
        $f = isset($arr['f'])? $arr['f'] : null;
        $p = isset($arr['p'])? $arr['p'] : null;
        return new DataCell($v, $f, $p);
    }
    
    
    /**
     *returns an array representation of the cell (useful for JSON)
     * @return array
     */
    public function toArray() {
        $arr = array_filter(
                array(
                    'v' => $this->getValueForArray(),
                    'f' => $this->f,
                    'p' => $this->p,
                ), function ($val) { return !is_null($val);}
        );
        // mm, some charts don't work if 'v' is not present
        if (!isset($arr['v'])) {
            $arr['v'] = null;
        }
        return $arr;
    }
    
    /**
     * returns the label of the cell
     * @return string
     */
    public function getLabel() {
        return (!is_null($this->f))? $this->f : $this->v;
    }
    
    /**
     * returns the value of the cell
     * @return string|number
     */
    public function getValue() {
        return $this->v;
    }
    
    public function getValueForArray() {
        return self::getValueForArraySatic($this->v);
    }
    public static function getValueForArraySatic($value) {
        return (is_object($value) && $value instanceof \DateTime)? '[new Date]('.($value->format('U')*1000).')[new Date]': $value;
    }
    
    public function getOptions() {
        return $this->p;
    }
}
