<?php require_once 'view/_header.php'; ?>

<?php

echo '<h2>' . $productName . '</h2>';

foreach ($reviewList as $review) {
	echo '<div>';
	echo '<p class="user">' . $review->user . '</p>';
	for($i = 0; $i<$review->rating; $i++){
		echo '<img src="view/full.png" width="20" height="20">';
	}
	for($i = $review->rating; $i<5;$i++){
		echo '<img src="view/empty.png" width="20" height="20">';
	}
	echo '<p class="review">' . $review->tekst . '</p>';
	echo '</div>';
	echo '<br/>';
}
//ispis forme za dodavanje recenzije
?>
<br/>
<div>
	<br/>
	<form action='index.php?rt=reviews/addReview' method='post'>
		<label for="user">Username:</label>
		<input type="text" name="user" required>
		<br/>
		<br/>
		<label for="ocijena">Ocjena: </label>
		<select id="ocijena" name="ocijena">
			<option value="5">5</option>
			<option value="4">4</option>
			<option value="3">3</option>
			<option value="2">2</option>
			<option value="1">1</option>
		</select>
		<br/>
		<br/>
		Recenzija:
		<br/>
		<small>(barem 10 znakova, smije sadržavati samo slova, brojke i osnovne interpunkcijske znakove)</small>
		<textarea name="review" cols="30" rows="10" required></textarea>
		<br/>
		<input type="hidden" name="id" value=<?php echo '"' . $_GET['id'] . '"'; ?> >
		<input type="submit" value="Pošalji">		
		<br/>
		<br/>
	</form>
</div>
<br/>
<a href="index.php" id="back">Vrati se na početnu stranicu</a>
<br/>

<?php require_once 'view/_footer.php'; ?>