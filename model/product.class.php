<?php

class Product{
	protected $id, $name, $description, $price, $rating;

	function __construct($id, $name, $description, $price, $rating){
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->price = $price;
		$this->rating = $rating;
	}

	function __get($prop){
		return $this->$prop;
	}

	function __set($prop, $val){
		$this->$prop = $val;
		return $this;
	}
}

?>