<?php

declare(strict_types=1);

class ShopProduct
{
	protected $title;
	protected $producerMainName;
	protected $producerFirstName;
	protected $price;
	private $discount = 0;

	public function __construct
	(
		string $title,
		string $firstName,
		string $mainName,
		float $price,
	)
	{
		$this->title = $title;
		$this->producerMainName = $mainName;
		$this->producerFirstName = $firstName;
		$this->price = $price;
	}

	public function getProducerFirstName()
	{
		return $this->producerFirstName;
	}

	public function getProducerMainName()
	{
		return $this->producerMainName;
	}

	public function setDiscount($num)
	{
		$this->discount = $num;
	}

	public function getDiscount()
	{
		return $this->discount;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getPrice()
	{
		return ($this->price - $this->discount);
	}

	public function getProducer()
	{
		return $this->producerFirstName . " " . $this->producerMainName;
	}

	public function getSummaryLine()
	{
		$base = "{$this->title} ( {$this->producerMainName}, ";
		$base .= "{$this->producerFirstName} )";
		return $base;
	}
}

class CdProduct extends ShopProduct
{
	private $playLength;

	public function __construct
	(
		string $title,
		string $firstName,
		string $mainName,
		float $price,
		float $playLength,
	)
	{
		parent::__construct
		(
			$title,
			$firstName,
			$mainName,
			$price,
		);
		$this->playLength = $playLength;
	}	

	public function getPlayLength()
	{
		return $this->playLength;
	}

	public function getSummaryLine()
	{
		$base = "{$this->title} ( {$this->producerMainName}, ";
		$base .= "{$this->producerFirstName} )";
		$base .= ": Время звучания - {$this->playLength}\n";
		return $base;
	}
}

class BookProduct extends ShopProduct
{
	private $numPages;

	public function __construct
	(
		string $title,
		string $firstName,
		string $mainName,
		float $price,
		int $numPages,
	)
	{
		parent::__construct
		(
			$title,
			$firstName,
			$mainName,
			$price,
		);
		$this->numPages = $numPages;
	}

	public function getNumberOfPages()
	{
		return $this->numPages;
	}

	public function getSummaryLine()
	{
		$base = parent::getSummaryLine();
		$base .= ": {$this->numPages} стр.\n";
		return $base;
	}

	public function getPrice()
	{
		return $this->price;
	}
}

class ShopProductWriter
{
	private $products = [];

	public function addProduct(ShopProduct $shopProduct)
	{
		$this->products[] = $shopProduct;
	}

	public function write()
	{		
		$str = "";
		foreach ($this->products as $shopProduct)
		{
			$str .= "{$shopProduct->getTitle()}: ";
			$str .= $shopProduct->getProducer();
			$str .= " ({$shopProduct->getPrice()})\n";
		}
		print $str;
	}
}

$writer = new ShopProductWriter();

$product1 = new ShopProduct("Собачье сердце", "Михаил", "Булгаков", 5.99);
$writer->addProduct($product1);
print "Автор: {$product1->getProducer()}\n";
print "{$product1->getSummaryLine()}\n";

$product2 = new CdProduct ("Классическая музыка. Лучшее", "Антонио", "Вивальди", 10.99, 60.33);
$writer->addProduct($product2);
print "Исполнитель: {$product2->getProducer()}\n";
print $product2->getSummaryLine();

$product3 = new BookProduct ("php объекты, шаблоны и методики программирования", "Мэтт", "Зандстр", 980.00, 720);
$writer->addProduct($product3);
print "Автор: {$product3->getProducer()}\n";
print $product3->getSummaryLine();

$writer->write();

?>
