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
 * Unit test for TimeOfDay type
 *
 * @author Arno Moonen <info@arnom.nl>
 */
class TimeOfDayTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var TimeOfDay
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new TimeOfDay;
    }

    /**
     * @covers AMNL\Google\Chart\Type\TimeOfDay::convertToCellValue
     */
    public function testConvertToCellValue()
    {
        $date = new \DateTime('Oct 16, 1989 13:14:15.123');
        $actual = $this->object->convertToCellValue($date);

        $this->assertTrue(is_array($actual));
        $this->assertCount(4, $actual);
        $this->assertContainsOnly('int', $actual);
        $this->assertEquals(13, $actual[0]);
        $this->assertEquals(14, $actual[1]);
        $this->assertEquals(15, $actual[2]);
        $this->assertStringStartsWith('123', strval($actual[3]));
    }

    /**
     * @covers AMNL\Google\Chart\Type\TimeOfDay::convertToStringVersion
     */
    public function testConvertToStringVersion()
    {
        $date = new \DateTime('Oct 16, 1989 13:14:15.123');
        $actual = $this->object->convertToStringVersion($date);

        $this->assertTrue(is_string($actual));
        $this->assertEquals('13:14:15', $actual);
    }

    /**
     * @covers AMNL\Google\Chart\Type\TimeOfDay::getName
     */
    public function testGetName()
    {
        $this->assertEquals('timeofday', $this->object->getName());
    }

    /**
     * @covers AMNL\Google\Chart\Type\TimeOfDay::validate
     * @todo   Implement testValidate().
     */
    public function testValidate()
    {
        $this->assertFalse($this->object->validate('Oct 16, 1989 13:14:15.123'));
        $this->assertTrue($this->object->validate(new \DateTime('Oct 16, 1989 13:14:15.123')));
    }

}