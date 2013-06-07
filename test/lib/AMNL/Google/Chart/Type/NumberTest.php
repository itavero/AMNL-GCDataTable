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
 * Unit test for Number type
 *
 * @author Arno Moonen <info@arnom.nl>
 */
class NumberTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Number
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Number;
    }

    /**
     * @covers AMNL\Google\Chart\Type\Number::convertToCellValue
     */
    public function testConvertToCellValue()
    {
        $this->assertEquals(123, $this->object->convertToCellValue(123));
        $this->assertEquals(123, $this->object->convertToCellValue('123'));
        $this->assertEquals(123.0, $this->object->convertToCellValue(123.0));
        $this->assertEquals(123.0, $this->object->convertToCellValue('123.0'));
        $this->assertEquals(123.45, $this->object->convertToCellValue(123.45));
        $this->assertEquals(123.45, $this->object->convertToCellValue('123.45'));
    }

    /**
     * @covers AMNL\Google\Chart\Type\Number::getName
     */
    public function testGetName()
    {
        $this->assertEquals('number', $this->object->getName());
    }

    /**
     * @covers AMNL\Google\Chart\Type\Number::validate
     */
    public function testValidate()
    {
        $this->assertFalse($this->object->validate(new \DateTime()), 'Object can not be a Number.');
        $this->assertFalse($this->object->validate(''), 'Empty string can not be a Number.');
        $this->assertFalse($this->object->validate('abc'), 'String without numeric characters can not be a Number.');
        $this->assertFalse($this->object->validate('abc123'), 'String with letters can not be a Number.');

        $this->assertTrue($this->object->validate(123), 'Accept integer.');
        $this->assertTrue($this->object->validate(123.45), 'Accept float.');
        $this->assertTrue($this->object->validate('123'), 'Accept integer as string.');
        $this->assertTrue($this->object->validate('123.45'), 'Accept float as string.');
    }

}