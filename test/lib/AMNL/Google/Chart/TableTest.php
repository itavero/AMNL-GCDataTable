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

use AMNL\Google\Chart\Type as T;

/**
 * Test for Column class
 *
 * @author Arno Moonen <info@arnom.nl>
 */
class TableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Table
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Table(new Column(new T\String()), new Column(new T\String()));
        $this->object->addRow(array('a', 'b'));
    }

    protected function tearDown()
    {
        $this->object = null;
    }

    /**
     * @covers AMNL\Google\Chart\Table::__construct
     */
    public function testVerifyColumnIdentifier()
    {
        $this->setExpectedException('RuntimeException');
        $obj = new Table(
                new Column(new T\String(), 'First', 'same-id'), new Column(new T\String(), 'Second', 'same-id')
        );
        $this->fail('Exception should have been thrown');
    }

    /**
     * @covers AMNL\Google\Chart\Table::getColumns
     */
    public function testGetColumns()
    {
        $actual = $this->object->getColumns();
        $this->assertTrue(is_array($actual));
        $this->assertCount(2, $actual);
        $this->assertContainsOnlyInstancesOf('AMNL\Google\Chart\Column', $actual);
    }

    /**
     * @covers AMNL\Google\Chart\Table::addRow
     */
    public function testAddRow()
    {
        $this->object->addRow(new Row('abc', 'def'));
        // No exception means the test passed!
    }

    /**
     * @covers AMNL\Google\Chart\Table::addRow
     */
    public function testAddRowArray()
    {
        $this->object->addRow(array('abc', 'def'));
        // No exception means the test passed!
    }

    /**
     * @covers AMNL\Google\Chart\Table::addRow
     */
    public function testAddRowFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->object->addRow(new Row(new \DateTime(), 'def'));
    }

    /**
     * @covers AMNL\Google\Chart\Table::addRow
     */
    public function testAddRowArrayFail()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->object->addRow(array('abc', new \DateTime()));
    }

    /**
     * @covers AMNL\Google\Chart\Table::toObject
     */
    public function testToObject()
    {
        $actual = $this->object->toObject();

        $this->assertTrue(is_object($actual));

        // Columns
        $this->assertObjectHasAttribute('cols', $actual);
        $this->assertCount(2, $actual->cols);
        $this->assertContainsOnly('object', $actual->cols);

        // Rows
        $this->assertObjectHasAttribute('rows', $actual);
        $this->assertCount(1, $actual->rows);
        $this->assertContainsOnly('object', $actual->rows);

        // First row
        $this->assertObjectHasAttribute('c', $actual->rows[0]);
        $this->assertTrue(is_array($actual->rows[0]->c));
        foreach ($actual->rows[0]->c as $item) {
            if ($item == null) {
                continue;
            }
            $this->assertTrue(is_object($item));
            $this->assertObjectHasAttribute('v', $item);
        }
    }

    /**
     * @covers AMNL\Google\Chart\Table::toJson
     */
    public function testToJson()
    {
        $actualJson = $this->object->toJson();
        $expectedObj = $this->object->toObject();
        $actualObj = json_decode($actualJson, false);

        $this->assertTrue(is_object($actualObj));
        $this->assertEquals($expectedObj, $actualObj);
    }

    /**
     * @covers AMNL\Google\Chart\Table::jsonSerialize
     * @see JsonSerializable::jsonSerialize
     */
    public function testJsonSerialize()
    {

        // Ensure that the interface exists
        $this->assertTrue(interface_exists('\JsonSerializable'), 'JsonSerializable interface should exist.');

        $expectedObj = $this->object->toObject();
        $actualObj = $this->object->jsonSerialize();
        $this->assertEquals($expectedObj, $actualObj);

        // PHP 5.4 or higher uses the JsonSerializable interface
        if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
            echo '[Test JsonSerialize]';
            $expectedJson = $this->object->toJson();
            $actualJson = json_encode($this->object);
            $this->assertEquals($expectedJson, $actualJson);
        }
    }

}