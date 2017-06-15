<?php 
	$headline = $_POST['headline']; 
    $ID = $_POST['ID']; 
    $date = $_POST['date']; 
	$textblock = $_POST['textblock']; 
	
    $array = json_decode(rawurldecode(file_get_contents('../data/config.json', FILE_USE_INCLUDE_PATH)), TRUE); 

    $cookie = $_COOKIE['superkey']; 
    $token = $array['adminLogin']['token']; 

    if ($token == $cookie) { 
	    $array = json_decode(rawurldecode(file_get_contents('../data/blog.json', FILE_USE_INCLUDE_PATH)), TRUE); 
        $array['date'][intval($ID)] = htmlentities(date($date)); 
        $array['headline'][intval($ID)] = htmlentities($headline); 
        $array['content'][intval($ID)] = utf8_encode(htmlentities($textblock)); 
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
	    fwrite($myfile, (string)$txt); 
	    fclose($myfile);  
        echo "<a href='../?q=blog'>zur&umll;ck</a>";  
    } else { echo "error"; }
?> 