<?php

class Review{
	protected $id, $idProizvoda, $user, $rating, $tekst;

	function __construct($id, $idProizvoda, $user, $rating, $tekst){
		$this->id = $id;
		$this->idProizvoda = $idProizvoda;
		$this->user = $user;
		$this->rating = $rating;
		$this->tekst = $tekst;
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