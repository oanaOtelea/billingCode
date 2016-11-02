<?php
require 'DB.php';

class Customer extends DB {
    private $_tableCustomers = 'customer_to_invoice';
    private $_tableOrders = 'lines_to_invoice';

    public function findCustomersAndTheirOrders() {
        return $this->findCustomersAndOrders($this->_tableCustomers, $this->_tableOrders);
    }

}