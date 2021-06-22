<?php

//echo file_get_contents('helloWorld.txt') . "\n";

try {
  if (! file_exists('helloWorld.txt')) {
    throw new Exception("Файл не найден", 404);
  }
  echo file_get_contents('helloWorld.txt') . "\n";
} catch (Exception $e) {
  echo 'Примеры методов класса Exception' . "\n";
  echo '$e->getMessage: ' . $e->getMessage() . "\n";
  echo '$e->getCode: ' . $e->getCode() . "\n";
  echo '$e->getFile: ' . $e->getFile() . "\n";
  echo '$e->getLine: ' . $e->getLine() . "\n";
  echo '$e->getTrace: ';
  var_dump($e->getTrace());//Непонятно почему массив получается пустой
  echo '$e->getTraceAsString: ' . $e->getTraceAsString() . "\n" . "\n";//Метод представляет предыдущий массив в строку, поэтому строка тоже пуста
  echo '$e->__toString: ' . $e->__toString() . "\n";
}

?>