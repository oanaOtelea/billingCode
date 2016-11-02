<?php 

class DB {
	
	//write your own database config
	private $_config = array(
		'username' => 'root',
		'password' => '',
		'database' => 'billing_test_db'
	);

	public $connectionErr = false;
	protected $connection = null;

	public function __construct() {
		$this->connect($this->_config);
	}

	//connect to DB
	public function connect($config) 
	{
		try {
			$conn = new PDO('mysql:host=localhost;dbname=' . $config['database'], 
							$config['username'], 
							$config['password']);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection = $conn;

		} catch(Exception $e) {
			$this->connectionErr = $e->getMessage();
		}
	}	

	//find customers and their orders
  	public function findCustomersAndOrders($tableCustomers, $tableOrders) {
  		$query = "SELECT customers.zoho_books_contact_id, orders.description, orders.rate FROM $tableCustomers customers LEFT JOIN $tableOrders orders ON customers.zoho_books_contact_id = orders.zoho_books_contact_id GROUP BY customers.zoho_books_contact_id";
  		try
          {
              $stmt = $this->connection->prepare($query);
              $stmt->execute();
              $result = $stmt->fetchAll(PDO::FETCH_OBJ);
          }
          catch(PDOException $e)
          {
              throw new Exception($e->getMessage());
          }
          return $result;
  	}
	
}