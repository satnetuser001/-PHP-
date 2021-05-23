<?php

/*
//PDO формирует свои Exceptions, их можно/нужно ловить
try {
    $PDO = new PDO( '...' );
}
catch( PDOException $Exception ) {
	echo $Exception->getMessage();
}
*/

//PDO settings
$host = '127.0.0.1';
$db   = 'PHPstudy';
$user = 'admin';
$pass = '2108';
$charset = 'utf8';

$pdo = new pdo("mysql:host=$host; dbname=$db; charset=$charset", $user, $pass);

//var_dump($pdo);
/*
результат var_dump:
class PDO#1 (0) {
}
Создался объект класса PDO, который подключился к db, объект не имеет информации в себе(т.к. запроса к db не было)
*/

$sql = "SELECT * FROM shopProduct";
$result = $pdo->query($sql);

/*foreach ($result as $row)//раскручиваем свойства объекта класса PDO как массим
{
	var_dump($row);
	echo ("<pre>");
	print_r($row);
	echo ("</pre>");
}*/


//PDOStatement::fetchAll возвращает массив ОДИН РАЗ
$arr = $result->fetchAll();//вернет ассоциативный и индексный массивы (продублирует)
//$arr = $result->fetchAll(PDO::FETCH_ASSOC);//вернет ассоциативный массив
//$arr = $result->fetchAll(PDO::FETCH_NUM);//вернет индексный массив
var_dump($arr);
echo ("<pre>");
print_r($arr);
echo ("</pre>");
?>