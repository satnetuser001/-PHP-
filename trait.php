<?php
trait One {
	function say(){
		echo "trait one";
	}
}

trait Two {
	function say(){
		echo "trait two";
	}
}

class Taker {
	use One, Two{
		One::say insteadof Two;
		// One::say as sayOne;
		Two::say as sayTwo;
	}
}

$objTaker = new Taker();
$objTaker->say();
echo "\n";
/*$objTaker->sayOne();
echo "\n";*/
$objTaker->sayTwo();
echo "\n";
?>