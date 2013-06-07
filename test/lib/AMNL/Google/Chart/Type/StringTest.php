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

namespace AMNL\Google\Chart\Type;

/**
 * Unit test for String type
 *
 * @author Arno Moonen <info@arnom.nl>
 */
class StringTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var String
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new String;
    }

    /**
     * @covers AMNL\Google\Chart\Type\String::convertToCellValue
     */
    public function testConvertToCellValue()
    {
        $value = 123456;
        $expected = strval($value);
        $actual = $this->object->convertToCellValue($value);
        $this->assertTrue(is_string($actual));
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers AMNL\Google\Chart\Type\String::getName
     */
    public function testGetName()
    {
        $this->assertEquals('string', $this->object->getName());
    }

    /**
     * @covers AMNL\Google\Chart\Type\String::validate
     */
    public function testValidate()
    {
        $this->assertFalse($this->object->validate(new \DateTime()));
        $this->assertTrue($this->object->validate(123456));
        $this->assertTrue($this->object->validate(123.45));
        $this->assertTrue($this->object->validate('abcd'));
    }

}