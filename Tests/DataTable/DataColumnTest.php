<?php

namespace SaadTazi\GChartBundle\Tests\Chart;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use SaadTazi\GChartBundle\DataTable\DataColumn;

class DataColumnTest extends TestCase
{
    public function getTestValidColumn() {
        return array(
            //'string', 'number', 'date', 'boolean'
            'testString' => array(
                                'obj'   => new DataColumn('idString', 'label String', 'string'),
                                'array' => array('id' => 'idString', 'label' => 'label String', 'type' => 'string')
                            ),
            'testNumber' => array(
                                'obj'   => new DataColumn('idNumber', 'label Number', 'number'),
                                'array' => array('id' => 'idNumber', 'label' => 'label Number', 'type' => 'number')
                            ),
            'testDate'   => array(
                                'obj'   => new DataColumn('idDate', 'label Date', 'date'),
                                'array' => array('id' => 'idDate', 'label' => 'label Date', 'type' => 'date')
                            ),
            'testBoolean'  => array(
                                'obj'   => new DataColumn('idBoolean', 'label Boolean', 'boolean'),
                                'array' => array('id' => 'idBoolean', 'label' => 'label Boolean', 'type' => 'boolean')
                            )
        );
        
    }
    
    public function getTestInvalidColumn() {
        return array(
            //'string', 'number', 'date', 'boolean'
            'testInvalidType' => array('id' => 'idInvalidType', 'label' => 'label InvalidType', 'type' => 'invalidType'),
            'testNoType' => array('id' => 'idInvalidType', 'label' => 'label InvalidType')

        );
    }
    
    public function testValidContructor() {
        foreach ($this->getTestValidColumn() as $dataColumn) {
            $this->assertEquals($dataColumn['obj']->toArray(), $dataColumn['array']);
        }
    }
    
    public function testInvalidContructor() {
        foreach ($this->getTestInvalidColumn() as $data) {
            $crashed = false;
            try {
                $dataColumn = new DataColumn($data['id'], $data['label'], $data['type']);
            } catch (\Exception $e) {
                $crashed = true;
            }
           $this->assertTrue($crashed);
           // ok, let's make sure the fromArray static method does the same...
           $crashed = false;
            try {
                $dataColumn = DataColumn::fromArray($data);
            } catch (\Exception $e) {
                $crashed = true;
            }
           $this->assertTrue($crashed);
        }
    }
    
    public function testFromArray() {
        foreach ($this->getTestValidColumn() as $dataColumn) {
            $this->assertEquals($dataColumn['obj'], DataColumn::fromArray($dataColumn['array']));
        }
    }

    
    


}
