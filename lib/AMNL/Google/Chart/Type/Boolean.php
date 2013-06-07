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
class Boolean implements Type
{

    public function convertToCellValue($object)
    {
        if (is_string($object)) {
            $cmp = strtolower(trim($object));
            if ($cmp === 'true') {
                return 'true';
            } elseif ($cmp === 'false') {
                return 'false';
            }
        }
        if (!function_exists('boolval')) {
            return ((bool) $object) ? 'true' : 'false';
        } else {
            return (boolval($object)) ? 'true' : 'false';
        }
    }

    public function convertToStringVersion($object)
    {
        return $this->convertToCellValue($object);
    }

    public function getName()
    {
        return 'boolean';
    }

    public function validate($object)
    {
        return is_bool($object) || filter_var($object, FILTER_VALIDATE_BOOLEAN) || $object === 0 || $object === 1 || $object === 'true' || $object === 'false';
    }

    public function __toString()
    {
        return $this->getName();
    }

}
