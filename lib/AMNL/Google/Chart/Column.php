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
class Column
{

    /**
     * @var \AMNL\Google\Chart\Type Data type of the data in the column
     */
    protected $type;

    /**
     * @var string Optional string ID of the column. Must be unique in the table. Use basic alphanumeric characters.
     */
    protected $id;

    /**
     * @var string Optinal string value that some visualizations display for this column.
     */
    protected $label;

    /**
     *
     * @param \AMNL\Google\Chart\Type $type Data type of the data in the column
     * @param string $label Optinal string value that some visualizations display for this column.
     * @param string $id Optional string ID of the column. Must be unique in the table. Use basic alphanumeric characters.
     */
    public function __construct(\AMNL\Google\Chart\Type $type, $label = null, $id = null)
    {
        $this->type = $type;
        if ($label != null) {
            $this->label = strval($label);
        }
        if ($id != null) {
            $this->id = strval($id);
        }
    }

    public function getType()
    {
        return $this->type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get an object representation of this column definition
     */
    public function toDefinitionObject()
    {
        $definition = array('type' => $this->type->getName());
        if ($this->id != null) {
            $definition['id'] = $this->id;
        }
        if ($this->label != null) {
            $definition['label'] = $this->label;
        }

        return (object) $definition;
    }

}
