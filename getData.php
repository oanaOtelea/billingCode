<?php 
require 'Customer.php';

$cust = new Customer();
$customers = $cust->findCustomersAndTheirOrders();

//the constants
const ITEM_ID = '460000000027017';
const NAME = 'Print Services';
const UNIT = 'Nos';
const TAX_ID = '460000000027005';
const NOTES = 'Thanks for your business.';
const QUANTITY = 1.00;
$item_order = 1;

foreach ($customers as $customer) {
	$customer->date = "2013-08-05";
	$customer->line_items = array('item_id' => ITEM_ID, 'project_id' => "", 'expense_id' => "", 'name' => NAME, 'description' => $customer->description, 'item_order' => $item_order, 'rate' => $customer->rate, 'unit' => UNIT, 'quantity' => QUANTITY, 'discount' => 0.00, 'tax_id' => TAX_ID);
	$customer->notes = NOTES;
	unset($customer->description, $customer->rate);
	$item_order++;
}

//get the objects, customers and their orders
print_r($customers);
