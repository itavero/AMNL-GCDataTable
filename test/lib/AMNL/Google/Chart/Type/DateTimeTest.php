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
 * Unit test for DateTime type
 *
 * @author Arno Moonen <info@arnom.nl>
 */
class DateTimeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var DateTime
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new DateTime;
    }

    /**
     * @covers AMNL\Google\Chart\Type\DateTime::convertToCellValue
     */
    public function testConvertToCellValue()
    {
        // Note: October is '9' cause JavaScript starts counting at 0.
        $expected = 'Date(1989,9,16,13,14,15)';
        $actual = $this->object->convertToCellValue(new \DateTime('Oct 16, 1989 13:14:15'));
        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers AMNL\Google\Chart\Type\DateTime::getName
     */
    public function testGetName()
    {
        $this->assertEquals('datetime', $this->object->getName());
    }

    /**
     * @covers AMNL\Google\Chart\Type\DateTime::validate
     */
    public function testValidate()
    {
        $this->assertFalse($this->object->validate('Oct 16, 1989'));
        $this->assertTrue($this->object->validate(new \DateTime('Oct 16, 1989')));
    }

}
