<?php

namespace SaadTazi\GChartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use SaadTazi\GChartBundle\DataTable;

use SaadTazi\GChartBundle\Chart\PieChart;

class DemoController extends Controller
{
    public function demoAction() {
        /*
         * dataTable for Pie Chart for example (long way - 2 columns) 
         */
        $dataTable1 = new DataTable\DataTable(
                array(
                    'cols' => 
                        array(
                             array(
                                'id'    => 'id1',
                                'label' => 'label1',
                                'type'     => 'string'
                            ),
                            array(
                                'id'    => 'id2',
                                'label' => 'label2',
                                'type'  => 'number'
                            )
                        ),
                    'rows' => 
                        array(
                            //row 1
                            array(
                                array(
                                    'v' => 'auto'
                                ),
                                array(
                                    'v' => 10,
                                    'f' => '10 per hours'
                                )
                            ),
                            array(
                                array(
                                    'v' => 'auto row 2'
                                ),
                                array(
                                    'v' => 5,
                                    'f' => '5 per hours'
                                )
                            )
                        )
                    )
        );
        
        /*
         * dataTable for Bar Chart for example (3 columns)
         */
        $dataTable2 = new DataTable\DataTable();
        $dataTable2->addColumn('id1', 'label 1', 'string');
        $dataTable2->addColumnObject(new DataTable\DataColumn('id2', 'label 2', 'number'));
        $dataTable2->addColumnObject(new DataTable\DataColumn('id3', 'label 3', 'number'));
        
        //test cells as array
        $dataTable2->addRow(array(
            array('v' => 'row 1'),
            array('v' => 2, 'f' => '2 trucks'),
            array('v' => 4, 'f' => '4 bikes')
        ));
        //simple cell (not an array)
        $dataTable2->addRow(array('row 2', 5, 1));
        //mixed
        $dataTable2->addRow(array('row 3', array('v' => 5), 10));
        $dataTable2->addRow(array('row 4', array('v' => 2), 10));
        
        
        /*
         * DataTable with 2 number colums (for Jauge) 
         */
        $dataTable3 = new DataTable\DataTable();
        
        $dataTable3->addColumnObject(new DataTable\DataColumn('id2', 'label 1', 'number'));
        $dataTable3->addColumnObject(new DataTable\DataColumn('id3', 'label 2', 'number'));
        
        //test cells as array
        $dataTable3->addRow(array(
            
            array('v' => 2, 'f' => '2 trucks'),
            array('v' => 4, 'f' => '4 bikes')
        ));
        //simple cell (not an array)
        $dataTable3->addRow(array(5, 1));
        //mixed
        $dataTable3->addRow(array( array('v' => 2), 10));
        $dataTable3->addRow(array(array('v' => 2), 10));
        
        $dataTable4 = new DataTable\DataTable();
        $dataTable4->addColumnObject(new DataTable\DataColumn('id11', 'x', 'number'));
        $dataTable4->addColumnObject(new DataTable\DataColumn('id22', 'label 1', 'number'));
        $dataTable4->addColumnObject(new DataTable\DataColumn('id33', 'label 2', 'number'));
        
        //test cells as array
        $dataTable4->addRow(array(2,4,3));
        //simple cell (not an array)
        $dataTable4->addRow(array(4, 5, 1));
        //mixed
        $dataTable4->addRow(array(6,3,4));
        $dataTable4->addRow(array(8,8,3));
        
        $dataTable5 = DataTable\DataTable::fromSimpleMatrix(
                array(
                    array('col1', 'col2', 'col3'),
                    array('row1', 1, 2),
                    array('row2', 3, 4),
                    array('row3', 4, 5),
                ),
                true
        );
        $dataTable6 = DataTable\DataTable::fromSimpleMatrix(
                array(
                    array('row1', 1, 2),
                    array('row2', 3, 4),
                    array('row3', 4, 5),
                ),
                false
        );
        
        
        
        $myArray[0]['idMonth'] = 'January';
$myArray[0]['idOne'] = 1;
$myArray[0]['idTwo'] = 2;
$myArray[1]['idMonth'] = 'February';
$myArray[1]['idThree'] = 33;
$myArray[2]['idMonth'] = 'March';
$myArray[2]['idTwo'] = 2;
$myArray[2]['idOne'] = 1;
$myArray[2]['idThree'] = 33;
//------------
$dt = new DataTable\DataTable();
$dt->addColumn('idMonth', 'Months', 'string');
$dt->addColumn('idOne', 'One', 'number');
$dt->addColumn('idTwo', 'Two', 'number');
$dt->addColumn('idThree', 'Three', 'number');
//------------
$dt->addRows($myArray);
        
        
        return $this->render(
                    'GChartBundle:Demo:demo.html.twig', 
                    array(
                        'dt' => $dt->toStrictArray(),
                        'dataTable1' => $dataTable1->toArray(),
                        'rawDataTable1' => $dataTable1,
                        'dataTable2' => $dataTable2->toArray(),
                        'dataTable3' => $dataTable3->toArray(),
                        'dataTable4' => $dataTable4->toArray(),
                        'dataTable5' => $dataTable5->toArray(),
                        'dataTable6' => $dataTable6->toArray()
                    )
                );
        
    }
    
    public function demo2Action() {
        $myArray[0]['idMonth'] = 'January';
        $myArray[0]['idOne'] = 1;
        $myArray[0]['idTwo'] = 2;
        $myArray[1]['idMonth'] = 'February';
        $myArray[1]['idThree'] = 33;
        $myArray[2]['idMonth'] = 'March';
        $myArray[2]['idTwo'] = 2;
        $myArray[2]['idOne'] = 1;
        $myArray[2]['idThree'] = 33;
        //------------
        $dt = new DataTable\DataTable();
        $dt->addColumn('idMonth', 'Months', 'string');
        $dt->addColumn('idOne', 'One', 'number');
        $dt->addColumn('idTwo', 'Two', 'number');
        $dt->addColumn('idThree', 'Three', 'number');
        //------------
        $dt->addRows($myArray);
        return $this->render(
                    'GChartBundle:Demo:demo2.html.twig', 
                    array(
                        'dt' => $dt->toStrictArray(false)
                    )
                );
        
    }

}
