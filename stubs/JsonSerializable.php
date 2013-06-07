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

/**
 * Stub interface for PHP version < 5.4.0.
 *
 * Objects implementing JsonSerializable can customize their JSON representation
 * when encoded with json_encode() in PHP 5 >= 5.4.0.
 *
 * @author Arno Moonen <info@arnom.nl>
 * @link http://php.net/JsonSerializable
 * @see json_encode()
 */
interface JsonSerializable
{

	/**
	 * Serializes the object to a value that can be serialized natively by json_encode().
	 * 
	 * @return mixed Returns data which can be serialized by json_encode(), which is a value of any type other than a resource.
	 */
    public function jsonSerialize();
    
}