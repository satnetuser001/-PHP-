<?php

function test(){
	static $var = 0;
	echo '$var = ' . $var . "\n";
	$var++;
	sleep(2);
	test();
}

test();

?>