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
class Table
{

    /**
     * @var array A list of Column-instances
     */
    protected $columns;

    /**
     * @var array A list of Row-instances
     */
    protected $rows;

    public function __construct()
    {
        $args = func_get_args();
        if (count($args) < 1) {
            throw new \InvalidArgumentException('A table should have at least one column.');
        }

        $columns = array();
        foreach ($args as $c) {
            if (!($c instanceof Column)) {
                throw new \InvalidArgumentException('All arguments passed to the constructor of Table must be an instance of Column.');
            }

            $columns[] = $c;
        }

        $this->columns = $columns;
        $this->rows = array();
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function addRow(\AMNL\Google\Chart\Row $row)
    {
        $cells = $row->getCells();

        if (count($cells) != count($this->columns)) {
            throw new \InvalidArgumentException('Number of Cells in Row does not match the number of Columns in Table.');
        }

        foreach ($cells as $i => $cell) {
            if ($cell != null && !$this->columns[$i]->getType()->validate($cell)) {
                throw new \InvalidArgumentException('Cell #' . ($i + 1) . ' does not comply with the column definition.');
            }
        }

        $this->rows[] = $row;
    }

    public function toJson()
    {
        $output = array('cols' => array(), 'rows' => array());

        // Column Definitions
        foreach ($this->columns as $inputColumn) {
            $output['cols'][] = $inputColumn->toDefinitionObject();
        }

        // Rows
        foreach ($this->rows as $inputRow) {
            $row = array('c' => array());
            foreach ($inputRow->getCells() as $i => $cell) {
                if (null === $cell) {
                    $row['c'][] = null;
                } else {
                    $colType = $this->columns[$i]->getType();
                    $outputCell = array('v' => $colType->convertToCellValue($cell));
                    $stringVal = $colType->convertToStringVersion($cell);
                    if ($stringVal != null) {
                        $outputCell['f'] = trim($stringVal);
                    }
                    $row['c'][] = (object) $outputCell;
                }
            }

            $output['rows'][] = (object) $row;
        }

        return json_encode((object) $output);
    }

}
