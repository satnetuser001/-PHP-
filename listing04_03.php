<?php

declare(strict_types=1);

class ShopProduct{
	protected $title;
	protected $producerMainName;
	protected $producerFirstName;
	protected $price;
	private $discount = 0;

	public function __construct(
		string $title,
		string $firstName,
		string $mainName,
		float $price
		){
		$this->title = $title;
		$this->producerMainName = $mainName;
		$this->producerFirstName = $firstName;
		$this->price = $price;
	}

	public function getProducerFirstName(){
		return $this->producerFirstName;
	}

	public function getProducerMainName(){
		return $this->producerMainName;
	}

	public function setDiscount($num){
		$this->discount = $num;
	}

	public function getDiscount(){
		return $this->discount;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getPrice(){
		return ($this->price - $this->discount);
	}

	public function getProducer(){
		return $this->producerFirstName . " " . $this->producerMainName;
	}

	public function getSummaryLine(){
		$base = "{$this->title} ( {$this->producerMainName}, ";
		$base .= "{$this->producerFirstName} )";
		return $base;
	}
}

class CdProduct extends ShopProduct{
	private $playLength;

	public function __construct(
		string $title,
		string $firstName,
		string $mainName,
		float $price,
		float $playLength
		){
		parent::__construct(
			$title,
			$firstName,
			$mainName,
			$price
		);
		$this->playLength = $playLength;
	}	

	public function getPlayLength(){
		return $this->playLength;
	}

	public function getSummaryLine(){
		$base = "{$this->title} ( {$this->producerMainName}, ";
		$base .= "{$this->producerFirstName} )";
		$base .= ": Время звучания - {$this->playLength}\n";
		return $base;
	}
}

class BookProduct extends ShopProduct{
	private $numPages;

	public function __construct(
		string $title,
		string $firstName,
		string $mainName,
		float $price,
		int $numPages
		){
		parent::__construct(
			$title,
			$firstName,
			$mainName,
			$price
		);
		$this->numPages = $numPages;
	}

	public function getNumberOfPages(){
		return $this->numPages;
	}

	public function getSummaryLine(){
		$base = parent::getSummaryLine();
		$base .= ": {$this->numPages} стр.\n";
		return $base;
	}

	public function getPrice(){
		return $this->price;
	}
}

class ShopProductWriter{
	private $products = [];

	public function addProduct(ShopProduct $shopProduct){
		$this->products[] = $shopProduct;
	}

	public function write(){		
		$str = "";
		foreach ($this->products as $shopProduct){
			$str .= "{$shopProduct->getTitle()}: ";
			$str .= $shopProduct->getProducer();
			$str .= " ({$shopProduct->getPrice()})\n";
		}
		print $str;
	}
}

class DBrequest{

	//protected const HOST = '127.0.0.1';
	static protected $host = '127.0.0.1';
	static protected $db   = 'PHPstudy';
	static protected $user = 'admin';
	static protected $pass = '2108';
	static protected $charset = 'utf8';
	static protected $tableName = 'shopProduct';

	static public function request(int $id){
		$pdo = new pdo("mysql:host=" . self::$host . ";dbname=" . self::$db . ";charset=" . self::$charset, self::$user, self::$pass);
		$sql = "SELECT * FROM " . self::$tableName . " WHERE id=$id";
		$result = $pdo->query($sql);
		//var_dump($result);
		return $result;
	}		

	static public function setAccessPar(//именованные аргументы работают с PHP 8
		$host = NULL,
		$db = NULL,
		$user = NULL,
		$pass = NULL,
		$charset = NULL,
		$tableName = NULL
		){
		if ($host != NULL){
			self::$host=$host;
		}
		elseif ($db != NULL){
			self::$db=$db;
		}
		elseif ($user != NULL){
			self::$user=$user;
		}
		elseif ($pass != NULL){
			self::$pass=$pass;
		}
		elseif ($pass != NULL){
			self::$charset=$charset;
		}
		elseif ($tableName != NULL){
			self::$tableName=$tableName;
		}		
	}

	static public function getAccessPar(){
		echo '$host = ' . self::$host . ', $db = ' . self::$db . ', $user = ' . self::$user . ', $pass = ' . self::$pass . ', $charset = ' . self::$charset . ', $tableName = ' . self::$tableName;
	}
}

class ProductSelector{
	protected $DBrequest;
	protected $product;

	public function DBrequest(int $id){
		$result = DBrequest::request($id);
		$this->DBrequest = $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function CreatProduct(){
		if ($this->DBrequest[0]['type'] == "book"){
			$this->product = new BookProduct(
				$this->DBrequest[0]['title'],
				$this->DBrequest[0]['producerFirstName'],
				$this->DBrequest[0]['producerMainName'],
				(float) $this->DBrequest[0]['price'],
				(int) $this->DBrequest[0]['otherCharacteristic']
			);
		}

		elseif ($this->DBrequest[0]['type'] == "cd"){
			$this->product = new CdProduct(
				$this->DBrequest[0]['title'],
				$this->DBrequest[0]['producerFirstName'],
				$this->DBrequest[0]['producerMainName'],
				(float) $this->DBrequest[0]['price'],
				(int) $this->DBrequest[0]['otherCharacteristic']
			);
		}

		elseif ($this->DBrequest[0]['type'] == NULL){
			$this->product = new ShopProduct(
				$this->DBrequest[0]['title'],
				$this->DBrequest[0]['producerFirstName'],
				$this->DBrequest[0]['producerMainName'],
				(float) $this->DBrequest[0]['price']
			);
		}
		var_dump($this->product);
	}
}

/*DBrequest::setAccessPar(db: 'tosha');
DBrequest::getAccessPar();
echo "\n";*/

$objProductSelector = new ProductSelector();
$objProductSelector->DBrequest(3);
$objProductSelector->CreatProduct();

?>
