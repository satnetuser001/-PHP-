<?php
namespace down;
$downVar = "request from down";

function downf($e = "non arg"){
	echo "echo from down dir, $e\n";
}

downf($downVar);
\upf($downVar);
?>
