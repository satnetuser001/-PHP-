<?php

declare(strict_types=1);

class ShopProduct
{
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

class CdProduct extends ShopProduct
{
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

	public function __construct
	(
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

class Selector{

	//protected const HOST = '127.0.0.1';
	protected $host = '127.0.0.1';
	protected $db   = 'PHPstudy';
	protected $user = 'admin';
	protected $pass = '2108';
	protected $charset = 'utf8';
	protected $tableName = 'shopProduct';
	protected $arr =[];
	protected $product;

	public function setAccessPar(
		$host = NULL,
		$db = NULL,
		$user = NULL,
		$pass = NULL,
		$charset = NULL,
		$tableName = NULL
	){
		if ($host != NULL){
			$this->host=$host;
		}
		elseif ($db != NULL){
			$this->db=$db;
		}
		elseif ($user != NULL){
			$this->user=$user;
		}
		elseif ($pass != NULL){
			$this->pass=$pass;
		}
		elseif ($pass != NULL){
			$this->charset=$charset;
		}
		elseif ($tableName != NULL){
			$this->tableName=$tableName;
		}
		echo '$host = ' . $this->host . ', $db = ' . $this->db . ', $user = ' . $this->user . ', $pass = ' . $this->pass . ', $charset = ' . $this->charset . ', $tableName = ' . $this->tableName;
	}

	public function request(int $id){
		$pdo = new pdo("mysql:host=$this->host; dbname=$this->db; charset=$this->charset", $this->user, $this->pass);
		//$pdo = new pdo("mysql:host=" . self::HOST . "; dbname=$this->db; charset=$this->charset", $this->user, $this->pass);//если необходимо использовать константу в pdo запросе
		$sql = "SELECT * FROM $this->tableName WHERE id=$id";
		$result = $pdo->query($sql);
		$this->arr = $result->fetchAll(PDO::FETCH_ASSOC);
		print_r($this->arr);
		$this->objCreator();
	}

	protected function objCreator(){
		if ($this->arr[0]['type'] == "book"){
			$this->product = new BookProduct(
				$this->arr[0]['title'],
				$this->arr[0]['producerFirstName'],
				$this->arr[0]['producerMainName'],
				(float) $this->arr[0]['price'],
				(int) $this->arr[0]['otherCharacteristic']
			);
		}

		elseif ($this->arr[0]['type'] == "cd"){
			$this->product = new CdProduct(
				$this->arr[0]['title'],
				$this->arr[0]['producerFirstName'],
				$this->arr[0]['producerMainName'],
				(float) $this->arr[0]['price'],
				(int) $this->arr[0]['otherCharacteristic']
			);
		}

		elseif ($this->arr[0]['type'] == NULL){
			$this->product = new ShopProduct(
				$this->arr[0]['title'],
				$this->arr[0]['producerFirstName'],
				$this->arr[0]['producerMainName'],
				(float) $this->arr[0]['price']
			);
		}
		var_dump($this->product);
	}
}

$objSelector = new Selector();
//$objSelector->setAccessPar(db: 'tosha');//именованные аргументы работают с PHP 8
$objSelector->request(3);
?>
