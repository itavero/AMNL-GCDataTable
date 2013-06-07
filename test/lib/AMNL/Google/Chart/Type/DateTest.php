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
 * Unit test for Date type
 *
 * @author Arno Moonen <info@arnom.nl>
 */
class DateTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Date
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Date;
    }

    /**
     * @covers AMNL\Google\Chart\Type\Date::convertToCellValue
     */
    public function testConvertToCellValue()
    {
        // Note: October is '9' cause JavaScript starts counting at 0.
        $expected = 'Date(1989,9,16)';
        $actual = $this->object->convertToCellValue(new \DateTime('Oct 16, 1989'));
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers AMNL\Google\Chart\Type\Date::getName
     */
    public function testGetName()
    {
        $this->assertEquals('date', $this->object->getName());
    }

    /**
     * @covers AMNL\Google\Chart\Type\Date::validate
     */
    public function testValidate()
    {
        $this->assertFalse($this->object->validate('Oct 16, 1989'));
        $this->assertTrue($this->object->validate(new \DateTime('Oct 16, 1989')));
    }

}