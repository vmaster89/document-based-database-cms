<?php 
	$username = $_POST['username']; 
	$password = $_POST['password']; 
    $label = $_GET['Label']; 
	$array = json_decode(rawurldecode(file_get_contents('../data/config.json', FILE_USE_INCLUDE_PATH)), TRUE); 

    $cookie = $_COOKIE['superkey']; 
    $token = $array['adminLogin']['token']; 
    
    if ($token == $cookie) { 
	    $array = json_decode(rawurldecode(file_get_contents('../data/page.json', FILE_USE_INCLUDE_PATH)), TRUE); 
        unset($array[$label]);
        // var_dump($array); 
        // echo "<br />";
        //$array = array_values($array); 
        $file = __DIR__ ."/../data/page.json"; 
	    $myfile = fopen($file, 'w+'); 
	    $txt = json_encode($array);  
	    fwrite($myfile, $txt); 
	    fclose($myfile);  

        unset($array); 
        $array = json_decode(rawurldecode(file_get_contents('../data/navigation.json', FILE_USE_INCLUDE_PATH)), TRUE); 
        var_dump($array); 
        foreach ($array as $key => $value) { 
            for ($i = 0; $i < sizeof($key); $i++ ) { 
                if ( $array[$key]['Label'] == $label ) { 
                    unset( $array[$key] ); 
                }
            }
        } 
        $file = __DIR__ ."/../data/navigation.json"; 
	    $myfile = fopen($file, 'w+'); 
	    $txt = json_encode($array);  
	    fwrite($myfile, $txt); 
	    fclose($myfile);  

        echo "<a href='../?q=blog'>zur&umll;ck</a>";  
   } else { echo "error"; }
?> 