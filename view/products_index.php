<?php require_once 'view/_header.php'; ?>

<?php

foreach ($productList as $product) {
	echo '<div>';
	echo '<h2>' . $product->name . '</h2>';
	echo '<p class="price">Cijena: ' . $product->price . ' kn</p>';
	//ispisivanje zvjezdica
	for($i=0; $i<floor($product->rating);$i++){
		echo '<img src="view/full.png" width="20" height="20">';
	}

	if($product->rating - floor($product->rating) >=0.5){
		echo '<img src="view/half.png" width="20" height="20">';
	}

	for($i=ceil($product->rating);$i<5;$i++){
		echo '<img src="view/empty.png" width="20" height="20">';
	}

	echo ' (<a href="index.php?id=' . $product->id . 
			'">' . 'recenzije</a>)';
	echo '<p class="description">' . $product->description . '</p>';
	echo '</div>';
	echo '<br/>';
}

?>


<?php require_once 'view/_footer.php'; ?>