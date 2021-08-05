<?php
//ссылка объекта и клон

class ageHolder {
	private $age = 18;

	public function setAge(int $age){
		$this->age = $age;
	}

	public function getAge(){
		return $this->age;
	}
}

$one = new ageHolder();
$two = $one;
$three = clone $one;

echo "созданы объекты:\n" . '$one = new ageHolder()' . "\n" . '$two = $one;' . "\n" . '$three = clone $one' . "\n";
echo 'значения свойства "private $age" =' . "\n";
echo "one " . $one->getAge() . "\n";
echo "two " . $two->getAge() . "\n";
echo "three " . $three->getAge() . "\n";

$one->setAge(20);
echo 'установили $one->setAge(20)' . "\n";
echo "one " . $one->getAge() . "\n";
echo "two " . $two->getAge() . "\n";
echo "three " . $three->getAge() . "\n";

$two->setAge(22);
echo 'установили $two->setAge(22)' . "\n";
echo "one " . $one->getAge() . "\n";
echo "two " . $two->getAge() . "\n";
echo "three " . $three->getAge() . "\n";

$three->setAge(33);
echo 'установили $three->setAge(33)' . "\n";
echo "one " . $one->getAge() . "\n";
echo "two " . $two->getAge() . "\n";
echo "three " . $three->getAge() . "\n";
?>