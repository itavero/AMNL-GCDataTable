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
class ColumnTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Column
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Column(new T\String(), 'label', 123456);
    }

    /**
     * @covers AMNL\Google\Chart\Column::getType
     */
    public function testGetType()
    {
        $this->assertInstanceOf('AMNL\Google\Chart\Type\String', $this->object->getType());
    }

    /**
     * @covers AMNL\Google\Chart\Column::getId
     */
    public function testGetId()
    {
        $actual = $this->object->getId();
        $this->assertTrue(is_string($actual));
        $this->assertEquals(123456, $actual);
    }

    /**
     * @covers AMNL\Google\Chart\Column::getLabel
     */
    public function testGetLabel()
    {
        $actual = $this->object->getLabel();
        $this->assertTrue(is_string($actual));
        $this->assertEquals('label', $actual);
    }

    /**
     * @covers AMNL\Google\Chart\Column::toDefinitionObject
     */
    public function testToDefinitionObject()
    {
        $actual = $this->object->toDefinitionObject();
        $this->assertTrue(is_object($actual));
        $this->assertObjectHasAttribute('id', $actual);
        $this->assertObjectHasAttribute('label', $actual);
        $this->assertObjectHasAttribute('type', $actual);
        $this->assertEquals('123456', $actual->id);
        $this->assertEquals('label', $actual->label);
    }

}