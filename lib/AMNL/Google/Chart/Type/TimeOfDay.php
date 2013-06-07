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
class TimeOfDay implements Type
{

    public function convertToCellValue($object)
    {
        return array(
            intval($object->format('G')),
            intval($object->format('i')),
            intval($object->format('s')),
            intval($object->format('u'))
        );
    }

    public function convertToStringVersion($object)
    {
        return $object->format('H:i:s');
    }

    public function getName()
    {
        return 'timeofday';
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