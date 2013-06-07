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
 * Unit test for Boolean type
 *
 * @author Arno Moonen <info@arnom.nl>
 */
class BooleanTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Boolean
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new Boolean;
    }

    /**
     * @covers AMNL\Google\Chart\Type\Boolean::convertToCellValue
     */
    public function testConvertToCellValue()
    {
        // True
        $this->assertEquals('true', $this->object->convertToCellValue(true));
        $this->assertEquals('true', $this->object->convertToCellValue('true'));
        $this->assertEquals('true', $this->object->convertToCellValue(1));

        // False
        $this->assertEquals('false', $this->object->convertToCellValue(false));
        $this->assertEquals('false', $this->object->convertToCellValue('false'));
        $this->assertEquals('false', $this->object->convertToCellValue(0));
    }

    /**
     * @covers AMNL\Google\Chart\Type\Boolean::convertToStringVersion
     */
    public function testConvertToStringVersion()
    {
        // True
        $this->assertEquals('true', $this->object->convertToStringVersion(true));
        $this->assertEquals('true', $this->object->convertToStringVersion('true'));
        $this->assertEquals('true', $this->object->convertToStringVersion(1));

        // False
        $this->assertEquals('false', $this->object->convertToStringVersion(false));
        $this->assertEquals('false', $this->object->convertToStringVersion('false'));
        $this->assertEquals('false', $this->object->convertToStringVersion(0));
    }

    /**
     * @covers AMNL\Google\Chart\Type\Boolean::getName
     */
    public function testGetName()
    {
        $this->assertEquals('boolean', $this->object->getName());
    }

    /**
     * @covers AMNL\Google\Chart\Type\Boolean::validate
     */
    public function testValidate()
    {
        $this->assertFalse($this->object->validate('abc'), 'Do not accept strings that are not "true" or "false".');
        $this->assertTrue($this->object->validate(true), 'Accept booleans.');
        $this->assertTrue($this->object->validate(false), 'Accept booleans.');
        $this->assertTrue($this->object->validate(1), 'Accept numeric 1.');
        $this->assertTrue($this->object->validate(0), 'Accept numeric 0.');
        $this->assertTrue($this->object->validate('true'), 'Accept string "true".');
        $this->assertTrue($this->object->validate('false'), 'Accept string "false".');
    }

}