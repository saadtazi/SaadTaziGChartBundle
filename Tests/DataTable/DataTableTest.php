<?php

namespace SaadTazi\GChartBundle\Tests\Chart;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use SaadTazi\GChartBundle\DataTable\DataRow;
use SaadTazi\GChartBundle\DataTable\DataCell;
use SaadTazi\GChartBundle\DataTable\DataColumn;
use SaadTazi\GChartBundle\DataTable\DataTable;

class DataTableTest extends TestCase
{
    public function getColArray() {
        return array(
            array('id'    => 'id1', 'label' => 'label1', 'type'  => 'string'),
            array('id'    => 'id2', 'label' => 'label2', 'type'  => 'number'),
            array('id'    => 'id3', 'label' => 'label3', 'type'  => 'date'),
            array('id'    => 'id4', 'label' => 'label4', 'type'  => 'timeofday'),
            array('id'    => 'id5', 'label' => 'label5', 'type'  => 'boolean')
        );
    }
    
    public function getRowsArray() {
        return array(
            array(
                'id1' => array('v' => 'teststring', 'f' => 'value string teststring'),
                'id2' => array('v' => -10, 'f' => 'value number 10'),
                'id3' => array('v' => new \DateTime('2001-01-01'), 'f' => 'value date 2010-01-01'),
                'id4' => array('v' => array(14,1,2), 'f' => 'value timeofday 25:01:02'),
                'id5' => array('v' => true, 'f' => 'value boolean true'),
            ),
            array(
                'id1' => array('v' => null, 'f' => 'value string null'),
                'id2' => array('v' => null, 'f' => 'value number null'),
                'id3' => array('v' => null, 'f' => 'value date null'),
                'id4' => array('v' => null, 'f' => 'value timeofday null'),
                'id5' => array('v' => null, 'f' => 'value boolean null')
            ),
            array(
                'id1' => array('v' => 'test 2', 'f' => 'value string "test 2"'),
                'id2' => array('v' => 0, 'f' => 'value number 0'),
                'id3' => array('v' => new \DateTime('1750-12-24'), 'f' => 'value date 1750-12-24'),
                'id4' => array('v' => array(25,25,78), 'f' => 'value timeofday 25:25:78'),
                'id5' => array('v' => false, 'f' => 'value boolean false')
            )
        );
    }
    
    public function getEmptyRowArray() {
        return array(
            array(
                //'id1' => array('v' => 'teststring', 'f' => 'value string teststring'),
                'id2' => array('v' => -10, 'f' => 'value number 10'),
                //'id3' => array('v' => new \DateTime('2001-01-01'), 'f' => 'value date 2010-01-01'),
                'id4' => array('v' => array(14,1,2), 'f' => 'value timeofday 25:01:02'),
                //'id5' => array('v' => true, 'f' => 'value boolean true'),
            ),
            array(
                'id2' => array('v' => null, 'f' => 'value number null'),
                'id1' => array('v' => null, 'f' => 'value string null'),
                //'id3' => array('v' => null, 'f' => 'value date null'),
                'id4' => array('v' => null, 'f' => 'value timeofday null'),
                //'id5' => array('v' => null, 'f' => 'value boolean null')
            ),
            array(
                'id5' => array('v' => false, 'f' => 'value boolean false'),
                'id4' => array('v' => array(25,25,78), 'f' => 'value timeofday 25:25:78'),
                'id3' => array('v' => new \DateTime('1750-12-24'), 'f' => 'value date 1750-12-24'),
                'id2' => array('v' => 0, 'f' => 'value number 0'),
                'id1' => array('v' => 'test 2', 'f' => 'value string "test 2"')
            )
        );
    }
    
    public function getEmptyRowStrictArray() {
        return array(
            array(
                'id1' => array('v' => null),
                'id2' => array('v' => -10, 'f' => 'value number 10'),
                'id3' => array('v' => null),
                'id4' => array('v' => array(14,1,2), 'f' => 'value timeofday 25:01:02'),
                'id5' => array('v' => null),
            ),
            array(
                'id1' => array('v' => null, 'f' => 'value string null'),
                'id2' => array('v' => null, 'f' => 'value number null'),
                'id3' => array('v' => null),
                'id4' => array('v' => null, 'f' => 'value timeofday null'),
                'id5' => array('v' => null)
            ),
            array(
                'id1' => array('v' => 'test 2', 'f' => 'value string "test 2"'),
                'id2' => array('v' => 0, 'f' => 'value number 0'),
                'id3' => array('v' => new \DateTime('1750-12-24'), 'f' => 'value date 1750-12-24'),
                'id4' => array('v' => array(25,25,78), 'f' => 'value timeofday 25:25:78'),
                'id5' => array('v' => false, 'f' => 'value boolean false')
            )
        );
    }
    
    // hacky... remove null values in cell, add a 'c' key...
    public function getRowsArrayToCompare($arr) {
        $arrRes = array();
        foreach ($arr as $key => $row) {
            foreach ($row as $id => $cell) {
                $cellCopy = array();
                foreach ($cell as $i => $entry) {
                    if (!is_null($entry)) {
                        if ($i != 'v') {
                        $cellCopy[$i] = $entry;
                        } else {
                            $cellCopy[$i] = DataCell::getValueForArraySatic($entry);
                        }
                    }
                }
                
                $arrRes[$key]['c'][] = $cellCopy; 
            }
        }
        return $arrRes;
    }
    
    public function getFromArrayDataTable($colArray, $rowArray) {
        return new DataTable(
                array(
                    'cols' => $colArray,
                    'rows' => $rowArray
                    )
            );
    }
    
    public function testToArray() 
    {
        $table = $this->getFromArrayDataTable($this->getColArray(), $this->getRowsArray());

        $expected = array(
                    'cols' => $this->getColArray(),
                    'rows' => $this->getRowsArrayToCompare($this->getRowsArray()),
                    'p'    => array()
                );
        
        $this->assertEquals(
                $table->toArray(),
                $expected
        );
    }
    
    public function testToStrictArray() {
        $table = $this->getFromArrayDataTable($this->getColArray(), $this->getRowsArray());

        $expected = array(
                    'cols' => $this->getColArray(),
                    'rows' => $this->getRowsArrayToCompare($this->getRowsArray()),
                    'p'    => array()
                );
        
        $this->assertEquals(
                $table->toStrictArray(),
                $expected
        );
        
        // test with empty rows and rows in wrong order (need to use toStrictArray()
        $table = $this->getFromArrayDataTable($this->getColArray(), $this->getEmptyRowStrictArray());
        
        $expected = array(
                    'cols' => $this->getColArray(),
                    'rows' => $this->getRowsArrayToCompare($this->getEmptyRowStrictArray()),
                    'p'    => array()
                );
        $this->assertEquals(
                $table->toStrictArray(),
                $expected
        );
    }
    
    public function testAddColumn() {
        $cols = $this->getColArray();
        $table = $this->getFromArrayDataTable($cols, $this->getRowsArray());
        
        $table->addColumn('id6', 'label added', 'boolean');
        $col = new DataColumn('id6', 'label added', 'boolean');
        $cols = $table->getColumns();
        $this->assertEquals(end($cols)->toArray(), $col->toArray());
        
        $col2 = new DataColumn('id7', 'label added', 'boolean');
        $table->addColumnObject($col2);
        $cols = $table->getColumns();
        
        $this->assertEquals(end($cols)->toArray(), $col2->toArray());
        
    }
    public function testAddRow() {
        $cols = $this->getColArray();
        $rows = $this->getRowsArray();
        $table = $this->getFromArrayDataTable($cols, $rows);
        
        $dataRow = new DataRow(array(
            //an array
            'id1' => array('v' => 'the first value', 'f' => 'label 1'),
            //just a value
            'id2' => 19,
            'id5' => new DataCell(false, 'label 3')
                )
        );
        
        $dataRowStrict = array(
            array('v' => 'the first value', 'f' => 'label 1'),
            array('v' => 19),
            array('v' => null),
            array('v' => null),
            array('v' => false, 'f' => 'label 3'),
        );
        $table->addRowObject($dataRow);
        $colArray = array();
        foreach ($cols as $col) {
            $colArray[] = DataColumn::fromArray($col);
        }
        $toCompare = $this->getRowsArrayToCompare($rows);
        $newRow = array();
        foreach ($dataRowStrict as $cell) {
            $newRow['c'][] = $cell;
        }
        $toCompare[] = $newRow;
        
        $expected = array(
                    'cols' => $this->getColArray(),
                    'rows' => $toCompare,
                    'p'    => array()
                );
        /*var_dump($table->toStrictArray());
        echo "=======\n";
        var_dump($expected);die();*/
        $this->assertEquals(
                $table->toStrictArray(),
                $expected
        );
    }
    public function testAddRowObject() {
        $cols = $this->getColArray();
        $rows = $this->getRowsArray();
        $table = $this->getFromArrayDataTable($cols, $rows);
        
        $dataRow = new DataRow(array(
            //an array
            'id1' => array('v' => 'the first value', 'f' => 'label 1'),
            //just a value
            'id2' => 19,
            'id5' => new DataCell(false, 'label 3')
                )
        );
        
        $dataRowStrict = array(
            array('v' => 'the first value', 'f' => 'label 1'),
            array('v' => 19),
            array('v' => null),
            array('v' => null),
            array('v' => false, 'f' => 'label 3'),
        );
        $table->addRowObject($dataRow);
        $colArray = array();
        foreach ($cols as $col) {
            $colArray[] = DataColumn::fromArray($col);
        }
        $toCompare = $this->getRowsArrayToCompare($rows);
        $newRow = array();
        foreach ($dataRowStrict as $cell) {
            $newRow['c'][] = $cell;
        }
        $toCompare[] = $newRow;
        
        $expected = array(
                    'cols' => $this->getColArray(),
                    'rows' => $toCompare,
                    'p'    => array()
                );
        /*var_dump($table->toStrictArray());
        echo "=======\n";
        var_dump($expected);die();*/
        $this->assertEquals(
                $table->toStrictArray(),
                $expected
        );
    }
    
    public function testFromSimpleMatrix() {
        $matrix = array(
                    array('row1', 1, true, new \DateTime('2010-01-14')),
                    array('row2', 3, false, new \DateTime('2010-02-15')),
                    array('row3', 4, true, new \DateTime('2010-03-16')),
                    array('row4', null, true, null),
                );
        
        $dataTable1 = DataTable::fromSimpleMatrix($matrix, false);
        
        //var_dump($dataTable1->toArray());die();
        $this->assertEquals(
                $dataTable1->toArray(),
                array(
                    'cols' => array(
                        array('id' => 'id0', 'label' => 'c0', 'type'  => 'string'),
                        array('id' => 'id1', 'label' => 'c1', 'type'  => 'number'),
                        array('id' => 'id2', 'label' => 'c2', 'type'  => 'boolean'),
                        array('id' => 'id3', 'label' => 'c3', 'type'  => 'datetime'),
                    ),
                    'rows' => array(
                        array(
                            'c' => array(
                                array('v' => 'row1'),
                                array('v' => 1),
                                array('v' => true),
                                array('v' => "[new Date](2010,1,14,0,00,00)[new Date]")
                            )),
                        array(
                            'c' => array(
                                array('v' => 'row2'),
                                array('v' => 3),
                                array('v' => false),
                                array('v' => "[new Date](2010,2,15,0,00,00)[new Date]")
                            )),
                        array(
                            'c' => array(
                                array('v' => 'row3'),
                                array('v' => 4),
                                array('v' => true),
                                array('v' => "[new Date](2010,3,16,0,00,00)[new Date]")
                            )),
                        array(
                            'c' => array(
                                array('v' => 'row4'),
                                array(),
                                array('v' => true),
                                array()
                            ))
                    ),
                    'p' => array()
                )
                );
        
        $matrix2 = array(
                    array('col1', 'col2', 'col3'),
                    array('row1', 3, true),
                    array('row2', null, null),
                    array(null, 4, false),
                );
        $dataTable2 = DataTable::fromSimpleMatrix($matrix2, true);
        
        $this->assertEquals(
                $dataTable2->toArray(),
                array(
                    'cols' => array(
                        array('id' => 'id0', 'label' => 'col1', 'type'  => 'string'),
                        array('id' => 'id1', 'label' => 'col2', 'type'  => 'number'),
                        array('id' => 'id2', 'label' => 'col3', 'type'  => 'boolean')
                    ),
                    'rows' => array(
                        array(
                            'c' => array(
                                array('v' => 'row1'),
                                array('v' => 3),
                                array('v' => true)
                            )),
                        array(
                            'c' => array(
                                array('v' => 'row2'),
                                array(),
                                array()
                            )),
                        array(
                            'c' => array(
                                array(),
                                array('v' => 4),
                                array('v' => false)
                            ))
                    ),
                    'p' => array()
                )
                );
    }
}
