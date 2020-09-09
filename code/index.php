<?php
//Example of singleton class
class DataBaseConnecter { 
	// Hold the class instance.			
	private static $obj; 
  
  // The constructor is private
  // to prevent initiation with outer code.
	private final function __construct() { 
    // The expensive process (e.g.,db connection) goes here.
		echo __CLASS__ . " initialize only once "; 
	} 
  
  // The object is created from within the class itself
  // only if the class has no instance.
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


