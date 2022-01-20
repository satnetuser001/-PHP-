<?php

/*
Если в файле объявленно namespace(см. three.php), то к коду
этого файла можно обратится (из one.php) только через
пространство имен или псевдоним присвоенный namespace.
Плюс namespace - возможность использования одинаковых имен
в разных файлах подключенных вместе. 
*/

require_once 'folderTwo/two.php';
require_once 'folderThree/three.php';

use folderThree\three;
use folderThree\three as fileThree;

function oneFunc(){
	echo "one\n";
}

oneFunc();
twoFunc();
folderThree\three\threeFunc();
three\threeFunc();
fileThree\threeFunc();
three\oneFunc();

?>
