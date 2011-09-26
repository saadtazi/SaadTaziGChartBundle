<?php


namespace SaadTazi\GChartBundle\DataTable;

/**
 * This Class represents a Column in a Google DataTable
 * 
 * A column has the following properties:
 * - a label (recommended, almost mandatory),
 * - a type (string, numeric...)
 * - an id
 * @link http://code.google.com/apis/chart/interactive/docs/reference.html#DataTable
 */
class DataColumn {
    // timeofday: an array of four numbers: [hour, minute, second, millisenconds].
    // date and datetime: a js Date object... 
    public static $validTypes = array('string', 'number', 'date',  'datetime', 'timeofday', 'boolean');
    
    protected $id    = null;
    protected $label = null;
    protected $type  = null;
    
    /**
     *
     * @param string $id
     * @param string $label
     * @param string $type one of: 'string', 'number', 'date', 'boolean'
     */
    public function __construct($id, $label, $type) {
        if (!in_array($type, self::$validTypes)) {
            throw new Exception\InvalidColumnTypeException('Invalid type for DataColumn ' . $type);
        }
        if (!isset($label) || !isset($type)) {
            throw new \Exception ('DataColumn constructor excepts a label and an type');
        }
        $this->id = $id;
        $this->label = $label;
        $this->type = $type;
    }
    
    /**
     * Returns a DataColumn object from an array
     * @param array $colData an associative array with 'label', 'type' and 'id'
     * @return DataColumn
     */
    public static function fromArray(array $colData) {
       return new DataColumn($colData['id'], $colData['label'], $colData['type']);
    }
    
    /**
     * Returns the id of the column
     * @return mixed string 
     */
    public function getId() {
        return $this->id;
    }
    /**
     * Returns the label of the column
     * @return string 
     */
    public function getLabel() {
        return $this->label;
    }
    /** returns an array representation of the instance
     *
     * @return array 
     */
    public function toArray() {
        return array_filter(
                array(
                    'id' => $this->id,
                    'label' => $this->label,
                    'type' => $this->type,
                ), function ($val) { return !is_null($val);}
        );
    }
    
}
