<?php 
	$username = $_POST['username']; 
	$password = $_POST['password']; 
	$headline = $_POST['headline']; 
	$textblock = $_POST['textblock']; 
    $label = $_POST['label']; 
	
    $array = json_decode(rawurldecode(file_get_contents('../data/config.json', FILE_USE_INCLUDE_PATH)), TRUE); 

    $cookie = $_COOKIE['superkey']; 
    $token = $array['adminLogin']['token']; 
    if ($token == $cookie) { 
	    $array = json_decode(rawurldecode(file_get_contents('../data/page.json', FILE_USE_INCLUDE_PATH)), TRUE); 
        if ( !(array_key_exists($label, $array)) ) { 
            $array[$label] = array('headline', 'date', 'content', 'status'); 
            var_dump($array);  
            foreach ($array as $key => $value ) { 
                if ($key == $label) { 
                    echo $key; 
                    $array[$key]['headline'] = htmlentities($headline); 
                    $array[$key]['date'] = htmlentities('11.11.1111'); 
                    $array[$key]['content'] = htmlentities($textblock);   
                    $array[$key]['status'] = htmlentities($textblock);   
                } 
            } 
            $file = __DIR__ ."/../data/page.json"; 
	        $myfile = fopen($file, 'w+'); 
	        $txt = json_encode($array);  
	        fwrite($myfile, $txt); 
	        fclose($myfile); 
            unset($array); 
            $array = json_decode(rawurldecode(file_get_contents('../data/navigation.json', FILE_USE_INCLUDE_PATH)), TRUE); 
            $elem = "elem" . sizeof($array);
            $array[$elem]['Label'] = $label; 
            $array[$elem]['URL'] = utf8_encode('?c=' . $label);  
            unset($file); 
            unset($myfile); 
            unset($txt); 
            var_dump($array); 
            $file = __DIR__ ."/../data/navigation.json"; 
	        $myfile = fopen($file, 'w+'); 
	        $txt = json_encode($array);  
	        fwrite($myfile, $txt); 
	        fclose($myfile); 
            echo "<a href='../?q=blog'>zur&umll;ck</a>";   
        } else { echo "Page already exists in json."; }

    } else { echo "error"; }
?> 