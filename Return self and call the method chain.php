<?php

class ReturnSelf
{
	static protected $var;

	static public function one(){
		self::$var = 'one';
		echo self::$var . "\n";
		//return ReturnSelf::class;
		return new ReturnSelf();
	}

	static public function two(){
		self::$var = 'two';
		echo self::$var . "\n";
		//return ReturnSelf::class;
		return new ReturnSelf();
	}

	static public function three(){
		self::$var = 'three';
		echo self::$var . "\n";
		//return ReturnSelf::class;
		return new ReturnSelf();
	}
}

//$obj = ReturnSelf::one()::two()::three()::one();
ReturnSelf::one()->two()->three()->one();

?>