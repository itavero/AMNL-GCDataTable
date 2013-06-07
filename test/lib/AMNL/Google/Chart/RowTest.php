<?php

/**
 * This file is part of AMNL-GCDataTable.
 *
 * (c) Arno Moonen <info@arnom.nl>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @author Arno Moonen <info@arnom.nl>
 * @copyright Copyright (c) 2013, Arno Moonen <info@arnom.nl>
 * @package AMNL-GCDataTable
 */

namespace AMNL\Google\Chart;

/**
 * Test for Column class
 *
 * @author Arno Moonen <info@arnom.nl>
 */
class RowTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers AMNL\Google\Chart\Row::getCells
     */
    public function testGetCellsConstructWithArgs()
    {
        $object = new Row('abc', 'def', 'ghi');
        $actual = $object->getCells();
        $this->assertTrue(is_array($actual));
        $this->assertCount(3, $actual);
        $this->assertEquals(array('abc', 'def', 'ghi'), $actual);
    }

    /**
     * @covers AMNL\Google\Chart\Row::getCells
     */
    public function testGetCellsConstructWithArray()
    {
        $cells = array('abc', 'def', 'ghi');
        $object = new Row($cells);
        $actual = $object->getCells();
        $this->assertTrue(is_array($actual));
        $this->assertCount(3, $actual);
        $this->assertEquals($cells, $actual);
    }

}