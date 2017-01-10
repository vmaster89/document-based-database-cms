<?php 
	$username = $_POST['username']; 
	$password = $_POST['password']; 
    $ID = $_GET['ID']; 
	$array = json_decode(rawurldecode(file_get_contents('../data/config.json', FILE_USE_INCLUDE_PATH)), TRUE); 

    $cookie = $_COOKIE['superkey']; 
    $token = $array['adminLogin']['token']; 
    
    if ($token == $cookie) { 
	    $array = json_decode(rawurldecode(file_get_contents('../data/blog.json', FILE_USE_INCLUDE_PATH)), TRUE); 
        foreach ($array as $key => $arr) {
            unset($array[$key][$ID]);
            $array[$key] = array_values($array[$key]); 
        } 
        // var_dump($array); 
        // echo "<br />"; 
        for ($i = 0; $i < sizeof($array['ID']); $i++ ) { 
            $array['ID'][$i] = intval($i); 
            // echo "value #" . $i . " Ausgabe: " . $array['ID'][$i] . "<br />"; 
        }
        //$array = array_values($array); 
        $file = __DIR__ ."/../data/blog.json"; 
	    $myfile = fopen($file, 'w+'); 
	    $txt = json_encode($array);  
	    fwrite($myfile, $txt); 
	    fclose($myfile);  
        echo "<a href='../?q=blog'>zur&umll;ck</a>";  
   } else { echo "error"; }
?> 