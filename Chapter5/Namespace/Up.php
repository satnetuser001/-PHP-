<?php
//Подразумевается, что имена функций будут одинаковые, но для наглядности - разные.
require_once('down/down.php');
$upVar = "request from up";

function upf($e = "no arg"){
	echo "echo from up dir, $e\n";
}
upf($upVar);
down\downf($upVar);
?>
