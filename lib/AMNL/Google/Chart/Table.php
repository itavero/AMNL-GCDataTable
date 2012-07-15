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

    /**
     * The arguments for this constructor are Column-instances and
     * define the structure of your table.
     *
     * @throws \InvalidArgumentException When you haven't supplied a single column or when one of the arguments isn't a Column instance.
     */
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

    /**
     * @return array An array of Column instances, defining the structure of this table.
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Add a row to the bottom of the table
     *
     * @param \AMNL\Google\Chart\Row $row
     * @throws \InvalidArgumentException When the number of cells does not match the number of columns, or when one of the cells does not comply with the type of the corresponding column
     */
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

    /**
     * Generate an object representation of this DataTable.
     * This method is also used by Table::toJson.
     * You can use this method to combine multiple DataTables into
     * a single JSON output.
     *
     * @see Task::toJson()
     * @return object Object representation of this DataTable
     */
    public function toObject()
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

        return (object) $output;
    }

    /**
     * This method generates a JSON representation of this DataTable.
     * It uses Task::toObject and json_encode.
     *
     * @see Task::toObject()
     * @see json_encode()
     * @return string JSON representation of this DataTable
     */
    public function toJson()
    {
        return json_encode($this->toObject());
    }

}