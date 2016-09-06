<?php


class Base{
	public function getId(){
		return $this->id;
	}
};


class Derived extends Base{
	private $id = 1;
	public function id(){
		return $this->id;
	}
};

$d1 = new Derived();

echo $d1->id();//echo 1
echo $d1->getId();//Cannot access private property Derived::$id






?>