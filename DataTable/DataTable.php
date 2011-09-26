<?php

namespace SaadTazi\GChartBundle\DataTable;

/**
 * This class represents a Google DataTable
 * It's composed of:
 * - columns
 * - rows,
 * - options
 * 
 * @link http://code.google.com/apis/chart/interactive/docs/reference.html#DataTable
 */
class DataTable {
    /**
     *
     * @var array array of DataColumn objects
     */
    protected $cols = array();
    /**
     *
     * @var array array of DataRow objects
     */
    protected $rows = array();
    
    /**
     *
     * @var array array of options
     */
    protected $p = array();
    
    /**
     * constructor
     * The $data should be an associative array with keys are 'cols', 'rows' and 'p' ('p' optional)
     * @param array $data 
     */
    public function __construct(array $data = array()) {
        if (isset($data['cols'])) {
            $this->addColumns($data['cols']);
        }
        if (isset($data['rows'])) {
            $this->addRows($data['rows']);
        }
        if (isset($data['p'])) {
            $this->p = $data['p'];
        }
    }
    
    /**
     * Adds multiple columns at the end of the array
     * the column should be an associative array, that can have 'label', 'id' and 'type'
     * @param array $cols 
     */
    public function addColumns(array $cols) {
        foreach ($cols as $col) {
            $this->cols[] = DataColumn::fromArray($col);
        }
    }
    
    /**
     * Adds a column at the end of the DataTable
     * @param DataColumn $col 
     */
    public function addColumnObject(DataColumn $col) {
        $this->cols[] = $col; 
    }
    
    public function getColumns() {
        return $this->cols;
    }
    
    /**
     * Adds a column at the end of the DataTable
     * @param string $id
     * @param string $label
     * @param string $type 
     */
    public function addColumn($id, $label, $type) {
        $this->cols[] = new DataColumn($id, $label, $type);
    }
    
    /**
     * Returns all the column labels
     * @return array 
     */
    public function getLabels() {
        $labels = array();
        foreach ($this->cols as $col) {
            $labels[] = $col->getLabel();
        }
        return $labels;
    }
    
    /**
     * adds rows at the end of the DataTable
     * each row can be an array, or just a value (string or number)
     * @param array $rows 
     */
    public function addRows(array $rows) {
        foreach ($rows as $row) {
            $this->rows[] = DataRow::fromArray($row);
        }
    }
    
    /**
     * Adds a datarow at the end of the DataTable
     * @param DataRow $row 
     */
    public function addRowObject(DataRow $row) {
        $this->rows[] = $row; 
    }
    
    /**
     * Add a row (from simple array) at the end of the DataTable
     * @param array $row 
     */
    public function addRow(array $row) {
        $this->rows[] = new DataRow($row);
    }
    
    /**
     *
     * @return array an array of DataRows
     */
    public function getRows() {
        return $this->rows;
    }
    
    /**
     * Return an array representation of the DataTable (to JSON)
     * It doesn't try to match the column ids to data ids
     * so all the dataRows cell needs to be defined (put null if you need)
     * @return array
     */
    public function toArray() {
        $colsArray = $this->getColArray();
        
        $rowsArray = $this->rows;
        
        array_walk($rowsArray, function (&$item) {
            $item = array('c' => $item->toArray());
        });
        
        //remove nulls
        return self::getFilteredArray($colsArray, $rowsArray, $this->p);
        
    }
    
    /**
     * Return an array representation of the DataTable (to JSON)
     * It doesn't try to match the column ids to data ids
     * so all the dataRows cell needs to be defined (put null if you need)
     * @return array
     */
    public function toStrictArray() {
        $colsArray = $this->getColArray();
        
        $rowsArray = $this->rows;
        
        array_walk($rowsArray, function (&$item, $key, $cols) {
            $item = array('c' => $item->toMatchingArray($cols));
        }, $this->cols);

        return self::getFilteredArray($colsArray, $rowsArray, $this->p);
        
    }
    
    protected function getColArray() {
         $colsArray = $this->cols;
        array_walk($colsArray, function (&$item) {
            $item = $item->toArray();
        });
        return $colsArray;
    }
    
    protected static function getFilteredArray($cols, $rows, $p) {
        return array_filter(
                array(
                    'cols' => $cols,
                    'rows' => $rows,
                    'p'    => $p
                ), function ($val) { return !is_null($val);}
        );
    }
    /** 
     * Returns an array that contains the values for a specific column
     * @param integer $pos
     * @return array
     */
    public function getValuesForPosition($pos) {
        $arr = array();
        foreach ($this->rows as $key => $row) {
            $arr[$key] = $row->getValueForPosition($pos);
        }
        return $arr;
    }
    
    /**
     * Returns a DataTable from a simple matrix (array of array, with first row = label if hasHeader = true)
     * @param array $array
     * @param boolean $hasHeader if true, indicates that the first row contains the labels
     * @return DataTable 
     */
    public static function fromSimpleMatrix(array $array, $hasHeader = true) {
        $dataTable = new DataTable();
        
        $labelArray = array();
        if ($hasHeader) {
            $labelArray = $array[0];
            array_shift($array);
            
        }
        //need to found out the data type... just string or number
        $firstDataRow = $array[0];
        foreach ($firstDataRow as $key => $value) {
            $type = "string";
            $label = isset($labelArray[$key])? $labelArray[$key]: 'c'.$key;
            if (is_object($value) && $value instanceof \DateTime) {
                $type = 'datetime';
            } elseif (is_bool($value)) {
                $type = 'boolean';
            } elseif (is_numeric($value)) {
                $type = 'number';
            }
            $dataTable->addColumn('id'.$key, $label, $type);
        }
        //now the data...
        foreach ($array as $key => $row) {
                $dataTable->addRow($row);
        }
        return $dataTable;
        
        
    }
    

    
    
}