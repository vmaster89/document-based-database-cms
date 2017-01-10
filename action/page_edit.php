<?php 
    $headline = $_POST['headline']; 
    $label = $_POST['Label']; 
	$textblock = $_POST['textblock']; 
	
    $array = json_decode(rawurldecode(file_get_contents('../data/config.json', FILE_USE_INCLUDE_PATH)), TRUE); 

    $cookie = $_COOKIE['superkey']; 
    $token = $array['adminLogin']['token']; 
    echo $label; 
    if ($token == $cookie) { 
	    $array = json_decode(rawurldecode(file_get_contents('./data/page.json', FILE_USE_INCLUDE_PATH)), TRUE); 
        foreach ( $array as $key => $value ) { 
            if ( $key == $label ) { 
                $array[$key]['headline'] = $headline; 
                $array[$key]['content'] = $textblock; 
            } 
        } 
        $file = __DIR__ . "/./data/page.json"; 
        echo $file; 
	    $myfile = fopen($file, 'w+'); 
	    $txt = json_encode($array);  
	    fwrite($myfile, (string)$txt); 
	    fclose($myfile);  
        echo "<a href='../?q=blog'>zur&umll;ck</a>";  
    } else { echo "error"; }
?> 