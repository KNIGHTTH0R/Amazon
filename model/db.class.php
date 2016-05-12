<?php

class DB{
	private static $db = null;

	private function __construct() {}
	private function __clone() {}

	public static function getConnection(){
	
		$hostname = 'rp2.studenti.math.hr';
		$dbUsername = 'student';
		$dbPassword = 'pass.mysql';
		
		if(DB::$db === null){
			try{
				DB::$db = new PDO("mysql: host=$hostname; dbname=custic; charset=utf8", $dbUsername, $dbPassword);
				DB::$db-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e){
				exit("PDO error " . $e->getMessage());
			}
		}
		return DB::$db;
	}
}

?>