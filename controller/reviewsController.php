<?php

require_once 'model/shopservice.class.php';

class ReviewsController{

	public function index(){

		$ss = new ShopService();

		if(!isset($_GET['id']) || !preg_match('/^[0-9]+$/', $_GET['id'])){
			header('Location: index.php');
			exit();
		}

		$title = "Popis recenzija";
		$productName = $ss->getProductNameById($_GET['id']);
		$reviewList = $ss->getAllProductReviewsById($_GET['id']);

		require_once 'view/review_index.php';
	}

	public function addReview(){

		$ss = new ShopService();

		if(!isset($_POST['user']) || !isset($_POST['review']) || !$_POST['id']){
			header('Location: index.php?rt=products');
			exit();
		}

		if(!preg_match('/^[a-zA-Zčćžđš ]{1,20}$/', $_POST['user'])
		 || !preg_match('/^[a-zA-z0-9.,!?:<>*čćžđš ]{10,1000}$/', $_POST['review'])){
			$title = "Recenzija nije poslana!";
			$productName = $ss->getProductNameById($_POST['id']);
			$reviewList = $ss->getAllProductReviewsById($_POST['id']);

			header('Location: index.php?id=' . $_POST['id']);
			exit();
		}


		$ss->insertReview($_POST['id'], $_POST['user'], $_POST['ocijena'], $_POST['review']);
		header('Location: index.php?id=' . $_POST['id']);
		exit();
	}
	
}

?>