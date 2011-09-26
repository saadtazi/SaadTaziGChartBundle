<?php


namespace SaadTazi\GChartBundle\DataTable;

/**
 * This class represents a row in a Google DataTable
 * 
 * @link http://code.google.com/apis/chart/interactive/docs/reference.html#DataTable
 */
class DataRow {
    
    /**
     *
     * @var array
     */
    protected $cells    = null;

    /**
     * Constructor
     * takes an array of value, 
     *   an array of DataCell,
     *   or an array of "cell array" (DataCell::fromArray)
     * 
     * @param array $cells 
     */
    public function __construct(array $cells) {
        foreach($cells as $key => $cell) {
            //if it's an array, then v, f, p
            if (is_array($cell)) {
                $this->cells[$key] = DataCell::fromArray($cell);
            } elseif ($cell instanceof DataCell) {
                $this->cells[$key] = $cell;
            } else {
                // just the value of the cell I guess...
                $this->cells[$key] = new DataCell($cell);
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
        foreach ($this->cells as $key => $cell) {
            $arr[] = $cell->toArray();
        }
        return $arr;
    }
    
    /**
     * returns an array representation of the instance,
     * by matching column ids with Row cell key
     * @return array 
     */
    public function toMatchingArray($colsArr) {
        $arr = array();
        //var_dump($colsArr);die();
        foreach ($colsArr as $key => $col) {
            $arr[] = $this->getCellArrayForPosition($col->getId());
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
    
    public function getCellArrayForPosition($pos) {
        return (isset($this->cells[$pos])) ? $this->cells[$pos]->toArray(): array('v' => null);
    }
    
}
