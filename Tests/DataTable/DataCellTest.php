<?php

namespace SaadTazi\GChartBundle\Tests\Chart;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use SaadTazi\GChartBundle\DataTable\DataCell;

class DataCellTest extends TestCase
{
    public function getTestConstructorObject() {
        return array(
            'testSuperSimple' => array(
                                'obj'   => new DataCell(1),
                                'array' => array('v' => 1)
                            ),
            'testSimple' => array(
                                'obj'   => new DataCell(10, 'testSimple'),
                                'array' => array('v' => 10, 'f' => 'testSimple')
                            ),
            'testZero'   => array(
                                'obj'   => new DataCell(0, 'testZero'),
                                'array' => array('v' => 0, 'f' => 'testZero')
                            ),
            'testNull'  => array(
                                'obj'   => new DataCell(null, 'testNull'),    
                                'array' => array('f' => 'testNull')
                                ),
            'testFloat'  => array(
                                'obj'   => new DataCell(10.119, 'testFloat'),
                                'array' => array('v' => 10.119, 'f' => 'testFloat')
                            ),
            'testString' => array(
                                'obj'   => new DataCell('a string', 'testString'),
                                'array' => array('v' => 'a string', 'f' => 'testString')
                            ),
            'testDate' => array(
                                'obj'   => new DataCell(new \DateTime('2010-02-19'), 'testDate'),
                                'array' => array('v' => '[new Date](2010,2,19,0,00,00)[new Date]', 'f' => 'testDate'),
                                'arrayDate' => array('v' => new \DateTime('2010-02-19'), 'f' => 'testDate'),
                
                            ),
            'testDateTime' => array(
                                'obj'   => new DataCell(new \DateTime('2010-02-19 12:01:02'), 'testDateTime'),
                                'array' => array('v' => '[new Date](2010,2,19,12,01,02)[new Date]', 'f' => 'testDateTime'),
                                'arrayDate' => array('v' => new \DateTime('2010-02-19 12:01:02'), 'f' => 'testDateTime')
                            ),
            'testTimeOfDay' => array(
                                'obj'   => new DataCell(array(12, 1, 2, 4), 'testTimeOfDay', array('option1' =>'optionvalue1')),
                                'array' => array('v' => array(12, 1, 2, 4), 'f' => 'testTimeOfDay', 'p' => array('option1' =>'optionvalue1'))
                            ),
            'testOption' => array(
                                'obj'   => new DataCell(10, 'testOption', array('option1' =>'optionvalue1')),
                                'array' => array('v' => 10, 'f' => 'testOption', 'p' => array('option1' =>'optionvalue1'))
                            )
        );
        
    }
    
    public function testContructor()
    {
        foreach ($this->getTestConstructorObject() as $dataCell) {
            $this->assertEquals($dataCell['obj']->toArray(), $dataCell['array']);
        }
    }
    
    public function testFromArray() {
        foreach ($this->getTestConstructorObject() as $dataCell) {
            $this->assertEquals($dataCell['obj'], DataCell::fromArray(isset($dataCell['arrayDate'])? $dataCell['arrayDate'] : $dataCell['array']));
        }
    }

    
    


}
