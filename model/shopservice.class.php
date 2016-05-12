<?php

require_once 'db.class.php';
require_once 'product.class.php';
require_once 'review.class.php';

class ShopService{
	//klasa za komunikaciju s bazom

	function getAllProducts(){
		//vraca niz koji sadrzi sve proizvode
		try{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id, name, description, price FROM products ORDER BY name');
			$st->execute();
		}
		catch (PDOException $e){
			exit("PDO error " . $e->getMessage());
		}

		$arr = array();
		while($row = $st->fetch()){
			try{
				$st2 = $db->prepare('SELECT AVG(rating) FROM reviews WHERE idProizvoda=:idProizvoda');
				$st2->execute(array('idProizvoda' => $row['id']));
			}
			catch(PDOException $e){
				exit("PDO error " . $e->getMessage());
			}

			$row2 = $st2->fetch();
			if($row2 === false)
				$productRating = 0;
			else
				$productRating = $row2['AVG(rating)'];

			$arr[] = new Product($row['id'], $row['name'], $row['description'], $row['price'], $productRating); 
		}

		return $arr;
	}


	function getAllProductReviewsById($idProizvoda){
		//vraca sve reviews za odabrani product

		try{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id, idProizvoda, user, rating, tekst FROM reviews WHERE idProizvoda=:idProizvoda ORDER BY id DESC');
			$st->execute(array('idProizvoda' => $idProizvoda));
		}
		catch(PDOException $e){
			exit('PDO error ' . $e->getMessage());
		}

		$arr = array();
		while($row = $st->fetch()){
			$arr[] = new Review($row['id'], $row['idProizvoda'], $row['user'], $row['rating'], $row['tekst']);
		}

		return $arr;
	}

	function getProductNameById($idProizvoda){
		try{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT name FROM products WHERE id=:id');

			$st->execute(array('id' => $idProizvoda));
		}
		catch(PDOException $e){
			exit('PDO error ' . $e->getMessage());
		}
		
		$row = $st->fetch();
		if($row === false){
			return null;
		}
		return $row['name'];
		
	}


	function getNumberOfReviews($idProizvoda){
		try{
			$db = DB::getConnection();
			$st = $db->prepare('SELECT id FROM reviews WHERE idProizvoda=:idProizvoda');
			$st->execute(array('idProizvoda' => $idProizvoda));
		}
		catch(PDOException $e){
			exit('PDO error ' . $e->getMessage());
		}

		return $st->rowCount();
	}

	function insertReview($idProizvoda, $user, $ocijena, $review){
		try{
			$db = DB::getConnection();
			$st = $db->prepare('INSERT INTO reviews(idProizvoda, user, rating, tekst) VALUES (:idProizvoda, :user, :rating, :tekst)' );
			$st->execute(array('idProizvoda' => $idProizvoda, 'user' => $user, 'rating' => (int)$ocijena, 'tekst' => $review));
		}
		catch(PDOException $e){
			exit('PDO error ' . $e->getMessage());
		}
	}
}

?>