<?php


namespace SaadTazi\GChartBundle\DataTable;

/**
 * This class represents a row in a Google DataTable
 * 
 * @link http://code.google.com/apis/chart/interactive/docs/reference.html#DataTable
 */
class DataRow {
    
    protected $cells    = null;

    /**
     * Constructor
     * @param array $cells 
     */
    public function __construct(array $cells) {
        //var_dump($cells);die();
        foreach($cells as $cell) {
            //if it's an array, then v, f, p
            if (is_array($cell)) {
                $this->cells[] = DataCell::fromArray($cell);
            } else {
                $this->cells[] = new DataCell($cell);
            }
        }
    }
    
    /**
     *
     * @param array $arr
     * @return DataRow 
     */
    public static function fromArray($arr) {
        return new DataRow($arr);
    }
    
    /**
     * returns an array representation of the instance
     * @return array 
     */
    public function toArray() {
        $arr = array();
        foreach ($this->cells as $cell) {
            $arr[] = $cell->toArray();
        }
        return $arr;
    }
    
    /**
     * Returns a value in the row at a specific position
     * @param integer $pos
     * @return string|number 
     */
    public function getValueForPosition($pos) {
        return (isset($this->cells[$pos])) ? $this->cells[$pos]->getValue(): null;
    }
    
}
