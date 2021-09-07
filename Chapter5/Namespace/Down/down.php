<?php
namespace down;
$downVar = "request from down";

function downf($e = "no arg"){
	echo "echo from down dir, $e\n";
}

downf($downVar);
\upf($downVar);
?>
