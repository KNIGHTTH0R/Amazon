<?php

class DB{
	private static $db = null;

	private function __construct() {}
	private function __clone() {}

	public static function getConnection(){
		
		//fill these variables with appropriate values
		$hostname = '';
		$dbUsername = '';
		$dbPassword = '';
		
		if(DB::$db === null){
			try{
				DB::$db = new PDO("mysql: host=$hostname; dbname=amazon; charset=utf8", $dbUsername, $dbPassword);
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
