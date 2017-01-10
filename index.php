<?php 
require_once('./MVC/controller.php'); 
// Layout is defined in layout.php. Model is defined in model.php. Controller is defined in controller.php. 

$constructor = new constructor(); 
$constructor->init(); 

class constructor {	
	function init() { 
		$controller = new controller(); 
		$controller->createWebpage($_GET, $_POST); 
	} 
} 
?> 