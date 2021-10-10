<?php

$varPublicToAll = "varPublicToAll";

class HolderVar
{
	public $var = "class HolderVar public var";
	protected $_varProtected = "class Holder protected var";

	public function getVarProtected()
	{
		return $this->_varProtected . " возвращенная objHolderVar->getVarProtected()";
	}
}

class VarFuncStatic
{
	static public $varStaticPublic = "Статическое публичное свойство класса VarFuncStatic";
	static protected $varStaticProtected = "Статическое защищенное свойство VarFuncStatic";

	static public function staticFunc()
	{
		return self::$varStaticProtected . " вызванное публичным методом varStaticProtected";
	}
}

class Main
{
	protected $_var = "class Main protected var";

	public function getVarProtected()
	{
		return $this->_var;
	}

	/*	
	//1 don't work!!!
	public function getVarPublicToAll()
	{
		return $varPublicToAll;
	}
	*/
	public function getVarPublicToAll($varPublicToAllTransmitted)
	{
		return $varPublicToAllTransmitted;
	}

	/*
	//2 don't work!!!
	public function getVarHolder()
	{
		return $objHolderVar->var;
	}
	public function getVarHolderFunc()
	{
		return $objHolderVar->getVarProtected();
	}
	*/
	public function getVarHolder()
	{
		$objInsideFunction = new HolderVar();
		return $objInsideFunction->var;
	}

	public function getStaticVar()
	{
		return VarFuncStatic::$varStaticPublic . " вызванное из objMain->getStaticVar()";
	}
	public function getStaticFunc()
	{
		return VarFuncStatic::staticFunc() . " вызванный из objMain->getStaticFunc()";
	}
}

$objHolderVar = new HolderVar();
echo $objHolderVar->var . ", вызов свойства objHolderVar->var из основного кода" . "\n";

$objMain = new Main();
echo $objMain->getVarProtected() . ", вызов свойства из объекта objMain->getVarProtected" ."\n";

/*
//1 don't work!!!
$objMain->getVarPublicToAll();
*/
echo $objMain->getVarPublicToAll($varPublicToAll) . ", вызов переменной из objMain->getVarPublicToAll (с пердачей переменной в метод)" . "\n";

/*
//2 don't work!!!
echo $objMain->getVarHolder();
echo $objMain->getVarHolderFunc();
*/

echo $objMain->getVarHolder()  . " вызов переменной через метод objMain->getVarHolder в котором создается объект класса HolderVar". "\n";

//простой вызов статического свойства и статического метода класса VarFuncStatic
//echo VarFuncStatic::$varStaticPublic . "\n";
//echo VarFuncStatic::staticFunc() . "\n";

echo $objMain->getStaticVar() . "\n";
echo $objMain->getStaticFunc() . "\n";

?>
