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

    /**
     * The arguments of this constructor represent the cell values,
     * and should be given in the same order as the corresponding
     * columns in Table.
     *
     * If only 1 argument is supplied and this single argument is an
     * array, the values within this array will be used as cell
     * values. This can be useful when using functions like
     * mysqli_fetch_row.
     *
     * Note: Row is just a simple container, it does NOT validate
     * the cell values. This is done in Task::addRow.
     *
     * @see Task::addRow()
     * @throws \InvalidArgumentException When no arguments are supplied.
     */
    public function __construct()
    {
        $args = func_get_args();

        if (count($args) == 1 && is_array($args[0])) {
            $this->cells = array_values($args[0]);
        } else {
            $this->cells = $args;
        }

        if (count($this->cells) < 1) {
            throw new \InvalidArgumentException('Each row should have at least one cell.');
        }
    }

    /**
     * @return array Array with cell values
     */
    public function getCells()
    {
        return $this->cells;
    }

}