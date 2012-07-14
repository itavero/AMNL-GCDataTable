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
 * @copyright Copyright (c) 2012, Arno Moonen <info@arnom.nl>
 * @package AMNL-GCDataTable
 */

namespace AMNL\Google\Chart\Type;

use AMNL\Google\Chart\Type;

/**
 *
 *
 * @author Arno Moonen <info@arnom.nl>
 */
class String implements Type
{

    public function convertToCellValue($object)
    {
        return strval($object);
    }

    public function convertToStringVersion($object)
    {
        return null;
    }

    public function getName()
    {
        return 'string';
    }

    public function validate($object)
    {
        return (is_string($object) || is_float($object) || is_int($object));
    }

    public function __toString()
    {
        return $this->getName();
    }

}
