<?php

namespace SaadTazi\GChartBundle\Tests\Chart;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

use SaadTazi\GChartBundle\DataTable\DataRow;
use SaadTazi\GChartBundle\DataTable\DataCell;
use SaadTazi\GChartBundle\DataTable\DataColumn;

class DataRowTest extends TestCase
{
    
    
    public function getTestDataRow() {
        return new DataRow(array(
            //an array
            array('v' => 'the first value', 'f' => 'label 1'),
            //just a value
            'just a single value',
            new DataCell('another value', 'label 3'),
            new DataCell(0, 'zero value'),
            new DataCell(null, 'null value'),
            null,
            new DataCell(new \DateTime('2010-02-01'), 'date value'),
            new DataCell(new \DateTime('2010-02-01 20:01:02'), 'datetime value'),
            new DataCell(array(20,1,2), 'timeofday value')
            
        ));
    }
    
    public function getTestDataRowToArray() {
        return array(
                    array('v' => 'the first value', 'f' => 'label 1'),
                    array('v' => 'just a single value'),
                    array('v' => 'another value', 'f' => 'label 3'),
                    array('v' => 0, 'f' => 'zero value'),
                    array('f' => 'null value'),
                    array(),
                    array('v' => '[new Date](2010,2,1,0,00,00)[new Date]', 'f' => 'date value'),
                    array('v' => '[new Date](2010,2,1,20,01,02)[new Date]', 'f' => 'datetime value'),
                    array('v' => array(20,1,2), 'f' => 'timeofday value')
                );
    }
    public function getTestDataRowFromArray() {
        return array(
                    array('v' => 'the first value', 'f' => 'label 1'),
                    array('v' => 'just a single value'),
                    array('v' => 'another value', 'f' => 'label 3'),
                    array('v' => 0, 'f' => 'zero value'),
                    array('f' => 'null value'),
                    array(),
                    array('v' => new \DateTime('2010-02-01'), 'f' => 'date value'),
                    array('v' => new \DateTime('2010-02-01 20:01:02'), 'f' => 'datetime value'),
                    array('v' => array(20,1,2), 'f' => 'timeofday value')
                );
    }
    
    public function testConstructor() 
    {
        $row1 = $this->getTestDataRow();
        
        $this->assertEquals(
                $row1->toArray(),
                $this->getTestDataRowToArray()
        );
    }
    
    public function testFromArray()
    {
        $row1 = DataRow::fromArray(array(
            //an array
            array('v' => 'the first value', 'f' => 'label 1'),
            //just a value
            'just a single value',
            new DataCell('another value', 'label 3'),
            new DataCell(0, 'zero value'),
            new DataCell(null, 'null value'),
            null,
            new DataCell(new \DateTime('2010-02-01'), 'date value'),
            new DataCell(new \DateTime('2010-02-01 20:01:02'), 'datetime value'),
            new DataCell(array(20,1,2), 'timeofday value'),
        ));
        
        $this->assertEquals(
                $row1->toArray(),
                $this->getTestDataRowToArray()
        );
        
    }
    
    public function testToMatchingArray() {
        // works also with int keys
        $row1 = DataRow::fromArray(array(
            //an array
            'first' => array('v' => 'the first value', 'f' => 'label 1'),
            //just a value
            'second' => 'just a single value',
            'third' => new DataCell('another value', 'label 3'),
            'fourth' => new DataCell(0, 'zero value'),
            'null' => new DataCell(null, 'null value'),
            'null2' => null
        ));
        
        $dataCols = array(
                new DataColumn('first', 'label String', 'string'),
                new DataColumn('second', 'label String 2', 'string'),
                new DataColumn('third', 'label String 3', 'string'),
                new DataColumn('fourth', 'label int 4', 'number'),
                new DataColumn('null', 'label null number 5', 'number'),
                new DataColumn('null2', 'label null string 6', 'string')
        );
        
        $shouldBeEqualTo = array(
                        array('v' => 'the first value', 'f' => 'label 1'),
                        array('v' => 'just a single value'),
                        array('v' => 'another value', 'f' => 'label 3'),
                        array('v' => 0, 'f' => 'zero value'),
                        array('f' => 'null value'),
                        array()
                    );
        
        //var_dump($row1->toMatchingArray($dataCols));
        
        $this->assertEquals(
                    $row1->toMatchingArray($dataCols),
                    $shouldBeEqualTo
        );
    }

}
