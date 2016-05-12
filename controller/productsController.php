<?php

require_once 'model/shopservice.class.php';

class ProductsController{

	public function index(){
		$ss = new ShopService();

		$productList = $ss->getAllProducts();
		$title = "Popis svih proizvoda";

		require_once 'view/products_index.php';
	}
}

?>