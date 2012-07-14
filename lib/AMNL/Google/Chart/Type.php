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

namespace AMNL\Google\Chart;

/**
 *
 *
 * @author Arno Moonen <info@arnom.nl>
 */
interface Type
{

    /**
     * @return string Name/ID of data type
     */
    public function getName();

    /**
     * @return string Name/ID of data type
     */
    public function __toString();

    /**
     * @return boolean True if the given object complies with this type, false otherwise
     */
    public function validate($object);

    /**
     * @return mixed Convert the object so it can be used as a cell value
     */
    public function convertToCellValue($object);

    /**
     * @return string Returns the string/textual representation of the given object
     */
    public function convertToStringVersion($object);
}
