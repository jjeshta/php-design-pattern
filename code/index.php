<?php
class DataBaseConnecter { 
				
	private static $obj; 
				
	private final function __construct() { 
		echo __CLASS__ . " initialize only once "; 
	} 
	
	public static function getConnect() { 
		if (!isset(self::$obj)) { 
			self::$obj = new DataBaseConnecter(); 
		} 
		
		return self::$obj; 
	} 
} 

$obj1 = DataBaseConnecter::getConnect(); 
$obj2 = DataBaseConnecter::getConnect(); 

var_dump($obj1 == $obj2); 


