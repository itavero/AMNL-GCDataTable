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
class Row
{

    /**
     * @var array An array containing the objects/values for each cell
     */
    protected $cells;

    public function __construct()
    {
        $this->cells = func_get_args();
        if (count($this->cells) < 1) {
            throw new \InvalidArgumentException('Each row should have at least one column (just like a table).');
        }
    }

    public function getCells()
    {
        return $this->cells;
    }

}
