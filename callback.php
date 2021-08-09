<?php

//Функции обратного вызова (анонимная, метод объекта, функция)

class Product{
  public $name;
  public $price;

  function __construct($name, $price){
    $this->name = $name;
    $this->price = $price;
  }
}

class ProcessSale{
  private $callbacks;

  function registerCallback($callback){
    if (! is_callable($callback)){
      throw new Exception("Функция обратного вызова - невызываемая!");
    }
    $this->callbacks[] = $callback;
  }

  function sale($product){
    print "{$product->name}: обрабатывается...\n";
    foreach ($this->callbacks as $callback){
      call_user_func($callback, $product);
    }
  }
}

class Mailer
{
  public function doMail(Product $product)
  {
    print "Класс Mailer, метод doMail: записываем ({$product->name})\n";
  }
}

$logger = function(Product $product) {
    print "Анонимная функция: записываем ({$product->name})\n";
};

function write(Product $product){
  print "функция write: записываем ({$product->name})\n";
}

$processor = new ProcessSale();

$processor->registerCallback($logger);
$processor->registerCallback([new Mailer(), 'doMail']);
$processor->registerCallback('write');

$processor->sale(new Product("Туфли", 6));
print "\n";
$processor->sale(new Product("Кофе", 6));

?>