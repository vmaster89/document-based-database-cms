<?php 
require_once('./MVC/controller.php'); 
// Layout is defined in layout.php. Model is defined in model.php. Controller is defined in controller.php. 
class constructor {	
	function __construct() { 
		$controller = new controller(); 
		$controller->createWebpage($_GET, $_POST); 
	} 
} 
?> 