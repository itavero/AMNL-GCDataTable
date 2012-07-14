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
class DateTime implements Type
{

    public function convertToCellValue($object)
    {
        $cellValue = 'Date(' . $object->format('Y') . ',' .
                ($object->format('n') - 1) . ',' .
                $object->format('j') . ',' .
                $object->format('G') . ',' .
                intval($object->format('i')) . ',' .
                intval($object->format('s')) . ')';

        return $cellValue;
    }

    public function convertToStringVersion($object)
    {
        return $object->format(\DateTime::RFC822);
    }

    public function getName()
    {
        return 'datetime';
    }

    public function validate($object)
    {
        return ($object instanceof \DateTime);
    }

    public function __toString()
    {
        return $this->getName();
    }

}