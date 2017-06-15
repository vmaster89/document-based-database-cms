<?php 
	$username = $_POST['username']; 
	$password = $_POST['password']; 

    $array = json_decode(rawurldecode(file_get_contents('../data/config.json', FILE_USE_INCLUDE_PATH)), TRUE); 

    $correctUser = $array['adminLogin']['username']; 
    $correctPass = $array['adminLogin']['password']; 

    if ($username == $correctUser && $password=$correctPass) { 
       setcookie('superkey', $array['adminLogin']['token'], time()+3600, '/', '.vmaster.de');
       header("Location: ../?q=admin_panel"); 
       exit; 
    } else { 
        echo "Es hat einen Fehler gegeben."; 
        echo "<a href='../?q=blog'>zur&umll;ck</a>";  
    } 
?> 