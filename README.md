# GC DataTable
[![Build Status](https://travis-ci.org/itavero/AMNL-GCDataTable.png)](https://travis-ci.org/itavero/AMNL-GCDataTable)
[![Latest Stable Version](https://poser.pugx.org/amnl/gc-datatable/v/stable.png)](https://packagist.org/packages/amnl/gc-datatable)
[![Total Downloads](https://poser.pugx.org/amnl/gc-datatable/downloads.png)](https://packagist.org/packages/amnl/gc-datatable)

This library is meant to simplify the dynamic generation of a JSON-representation of a DataTable when using PHP. DataTables are used by the Google Visualization API / Chart Tools, see [this reference on developers.google.com](https://developers.google.com/chart/interactive/docs/reference#dataparam) for more info.

## Problems? Suggestions?
Create a new issue to tell me about your suggestions and/or problems. I'd love to hear your opinion!

## Example
For the time being you can have a look at ["Populating Data Using Server Side Code"](https://developers.google.com/chart/interactive/docs/php_example).
The code below basically replaces getData.php and sampleData.json and allows you to dynamically change the output.
```php
<?php

/*
 * A bunch of use-statements
 * (assuming you have some kind of autoloading mechanism)
 */
use AMNL\Google\Chart\Table;
use AMNL\Google\Chart\Column;
use AMNL\Google\Chart\Row;
use AMNL\Google\Chart\Type as T;

/* The actual code */
$pizzaTable = new Table(
    new Column(new T\String(), 'Topping'),
    new Column(new T\Number(), 'Slices')
);

$pizzaTable->addRow(new Row('Mushrooms', 3));
$pizzaTable->addRow(new Row('Onions', 1));
$pizzaTable->addRow(new Row('Olives', 1));
$pizzaTable->addRow(new Row('Zucchini', 1));
$pizzaTable->addRow(new Row('Pepperoni', 2));

/* JSON Output */
header('Content-Type: application/json');
echo $pizzaTable->toJson();
```
