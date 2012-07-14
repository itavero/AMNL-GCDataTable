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
class Number implements Type
{

    public function convertToCellValue($object)
    {
        if (is_float($object) || filter_var($object, FILTER_VALIDATE_FLOAT)) {
            return floatval($object);
        } else {
            return intval($object);
        }
    }

    public function convertToStringVersion($object)
    {
        return null;
    }

    public function getName()
    {
        return 'number';
    }

    public function validate($object)
    {
        return is_int($object) || is_float($object) || filter_var($object, FILTER_VALIDATE_INT) || filter_var($object, FILTER_VALIDATE_FLOAT);
    }

    public function __toString()
    {
        return $this->getName();
    }

}
