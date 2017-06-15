<?php 
	$username = $_POST['username']; 
	$password = $_POST['password']; 
	$headline = $_POST['headline']; 
	$textblock = $_POST['textblock']; 
	
    $array = json_decode(rawurldecode(file_get_contents('../data/config.json', FILE_USE_INCLUDE_PATH)), TRUE); 

    $cookie = $_COOKIE['superkey']; 
    $token = $array['adminLogin']['token']; 

    if ($token == $cookie) { 
	    $array = json_decode(rawurldecode(file_get_contents('../data/blog.json', FILE_USE_INCLUDE_PATH)), TRUE); 
	    array_push($array['ID'], sizeof($array['ID'])); 
        array_push($array['date'], date("d.m.Y",time())); 
        array_push($array['headline'], htmlentities($headline)); 
        array_push($array['content'], htmlentities($textblock)); 
         for ($i = 0; $i < sizeof($array); $i++ ) { 
            $array['ID'][$i] = $i; 
            $array['ID'] = array_values($array['ID']); 
            $array['headline'] = array_values($array['headline']); 
            $array['content'] = array_values($array['content']); 
            $array['date'] = array_values($array['date']); 
        }
        for ($i = 0; $i < sizeof($array['ID']); $i++ ) { 
            $array['ID'][$i] = intval($i); 
        }
        $file = __DIR__ ."/../data/blog.json"; 
	    $myfile = fopen($file, 'w+'); 
	    $txt = json_encode($array);  
	    fwrite($myfile, $txt); 
	    fclose($myfile);  
        echo "<a href='../?q=blog'>zur&umll;ck</a>";  
    } else { echo "error"; }
?> 