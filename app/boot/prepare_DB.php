<?php

require_once '../../model/db.class.php';

$db = DB::getConnection();

try{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS products ' .
		'(id int NOT NULL PRIMARY KEY AUTO_INCREMENT,'.	'name varchar(255) NOT NULL,' . 
		'description varchar(1000) NOT NULL,' . 
		'price double NOT NULL)'
	);

	$st->execute();
}
catch(PDOException $e){
	exit('PDO error ' . $e->getMessage());
}

echo "Napravio sam tablicu products. <br/>";

try{
	$st = $db->prepare(
		'CREATE TABLE IF NOT EXISTS reviews ' .
		'(id int NOT NULL PRIMARY KEY AUTO_INCREMENT,'. 
		'idProizvoda int NOT NULL,' .
		'user varchar(20) NOT NULL,' .
		'rating int NOT NULL,' . 
		'tekst varchar(1000) NOT NULL)'
	);

	$st->execute();
}
catch(PDOException $e){
	exit('PDO error ' . $e->getMessage());
}

echo "Napravio sam tablicu reviews.<br/>";


//ubaci nekoliko productsa
try{
	$st = $db->prepare('INSERT INTO products(name, description, price) VALUES (:name, :description, :price)');

	$st->execute(array('name' => 'Dumbledorov štapić', 'description' => 'Replika štapića profesora Dumbledora, sad već pokojnog ravnatelja Škole vještičarenja i čarobnjaštva Hogwarts. Štapić je duljine 38cm, u odličnom stanju.', 'price' => 1234.99));

	$st->execute(array('name' => 'Nimbus 2000', 'description' => 'Originalna metla Nimbus 2000, proizvod tvrtke Nimbus Racing Brooms. Jedna od najprodavanijih metli tvrtke Nimbus. Počela se proizvoditi 1991. i tada je bila najbrža metla na tržištu. Drška od mahagonija. Harry Potter je bio jedan od vlasnika ove metle. ', 'price' => 20000));

	$st->execute(array('name' => 'Nimbus 2001', 'description' => 'Originalna metla Nimbus 2001, proizvod tvrtke Nimbus Racing Brooms. Zamijenila je metlu Nimbus 2000, dotadašnju perjanicu tvrtke. Početak proizvodnje 1992. Poznata kao metla Slytherin metloboj tima.', 'price' => 23000));

	$st->execute(array('name' => 'Obična bijela majica', 'description' => 'Obična bijela majica, veličina XL, sastav 100% pamuk. Pranje na 40 stupnjeva. Može se nositi u školu, na fakultet ili posao. Odlično stoji kao dio sportske kombinacije ili ispod neke svečanije odjeće. ', 'price' => 39.99));

	$st->execute(array('name' => 'Uredski stol', 'description' => 'Uredski stol od punog drva. Gornja ploha od tikovine, noge od bukve, te stražnja strana od trešnje. Stol vrhunske kvalitete, talijanske obrade. Uz stol dobijete i sredstvo za lakiranje stola uz koje će stol trajati godinama.', 'price' => 1999.99));

	$st->execute(array('name' => 'Mediteranski zrak', 'description' => 'Tegla čistog mediteranskog zraka. Prikupljenog na području otoka Korčula, između Blata i Prigradice. U zraku se mogu osjetiti note raznog bilja i drveća koje rastu po otoku Korčuli. Od autohtone masline drobnice, preko lavande, ružmarina, metvice pa sve do smilja i bora.', 'price' => 1000000 ));
}
catch(PDOException $e){
	exit('PDO error ' . $e->getMessage());
}

echo "Popunio tablicu proizvoda.<br/>";

try{
	$st = $db->prepare('INSERT INTO reviews(idProizvoda, user, rating, tekst) VALUES (:idProizvoda, :user, :rating, :tekst)');

	$st->execute(array('idProizvoda' => 1, 'user' => 'porin', 'rating' => 1,'tekst' => 'Kupio sam ga i jedva dočekao da mi dodje. Kad je štapić došao nisam mogao sakriti razočarenje kad sam shvatio da štapić uopće ne radi. Bezveze.'));

	$st->execute(array('idProizvoda' => 1, 'user' => 'ivo', 'rating' => 2,'tekst' => 'Ni meni nije radio ali nemam pojma, dobar mi je za mišati juhu.'));

	$st->execute(array('idProizvoda' => 2, 'user' => 'porin', 'rating' => 5,'tekst' => 'Ovo je najbolja metla ikad! Cijeli stan sam pomeo u dvi minute!'));

	$st->execute(array('idProizvoda' => 2, 'user' => 'vojko', 'rating' => 5,'tekst' => 'Metla je ludnica. Dont drink and drive, take metla and fly.'));

	$st->execute(array('idProizvoda' => 2, 'user' => 'sasaIzTBFa', 'rating' => 4,'tekst' => 'Dobra je metla, letan na sve strane ali malo žulja kad sidiš dugo.'));

	$st->execute(array('idProizvoda' => 3, 'user' => 'vojko', 'rating' => 2,'tekst' => 'Kupio sam ovu metlu i prijašnji model i ova metla je koma. Spora, stalno se zaustavlja. Nista ne valja.'));

	$st->execute(array('idProizvoda' => 3, 'user' => 'batman', 'rating' => 5,'tekst' => 'Metla je super, ne moram više pucati sa onim glupim pištoljima pa skakati po zgradama.'));

	$st->execute(array('idProizvoda' => 4, 'user' => 'porin', 'rating' => 3,'tekst' => 'First!'));

	$st->execute(array('idProizvoda' => 4, 'user' => 'marko popovic', 'rating' => 3,'tekst' => 'Nista posebno, dobro mi dodje za trening.'));

	$st->execute(array('idProizvoda' => 5, 'user' => 'tornadoZadar', 'rating' => 3,'tekst' => 'Kupili smo stol jer nam treba za nove prostore ali jako je težak a vrlo brzo se rasklimao.'));

	$st->execute(array('idProizvoda' => 5, 'user' => 'boroPostar', 'rating' => 1,'tekst' => 'Ovo nista ne valja.'));

	$st->execute(array('idProizvoda' => 6, 'user' => 'sasaIzTBFa', 'rating' => 5,'tekst' => 'Ovo je prava stvar! Kad oden u zagreb na koncert onda si ponesen cili kombi ovoga da mogu pravi zrak udisati.'));

	$st->execute(array('idProizvoda' => 6, 'user' => 'porin', 'rating' => 5,'tekst' => 'Uff, milina!'));

	$st->execute(array('idProizvoda' => 6, 'user' => 'ivo', 'rating' => 5,'tekst' => 'polako dišem s otokom, smiren s protokom misli kroz mozak normalne brzine, bez gužve i buke, bez želučane kiseline, daleko od prašine splita, ovdi je more prozirnije nego vitar.'));
}
catch(PDOException $e){
	exit('PDO error ' . $e->getMessage());
}

echo 'Popunio tablicu reviews.';
?>