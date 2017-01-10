<?php 

/** $return = realpath('../MVC/model.php');
echo $return; **/ 

$input_json = file_get_contents("../data/blog.json", FILE_USE_INCLUDE_PATH); 
$input_json = utf8_encode($input_json); 
$array_output = json_decode($input_json, true); 
$wsdl = $_GET['wsdl']; 
$n = $_GET['n']; 

if (isset($wsdl)) { 
    echo '{"return":"FALSE"}'; 
} else if (isset($n)) { 
    $count = sizeof($array_output['ID'])-1; 
    if ( $n == '0' ) { 
        echo '{{"ID":"' . $array_output['ID'][0] . '", "headline":"' . $array_output['headline'][0] . '", "content" : "' . $array_output['content'][0] . '", "date": "' . $array_output['date'][0] . '"}}'; 
    } else { 
        echo "{"; 
        for ($i = $start; $i < $count; $i++) { 
            // echo 'compare: ' . $i . ' ' . $count . '<br />'; 
            if ( $i+1 != $count ) {
                echo '{"ID":"' . $array_output['ID'][$i] . '", "headline":"' . $array_output['headline'][$i] . '", "content" : "' . $array_output['content'][$i] . '", "date": "' . $array_output['date'][$i] . '"},'; 
            } else if ( $i+1 == $count ) {
                echo '{"ID":"' . $array_output['ID'][$i] . '", "headline":"' . $array_output['headline'][$i] . '", "content" : "' . $array_output['content'][$i] . '", "date": "' . $array_output['date'][$i] . '"}'; 
            }
        }
        echo "}"; 
    } 
} 
?>

<!-- else if (isset($n)) { 
    echo "{"; 
    for ($i = 0; $i < sizeof($article['ID'])) { 
        echo '{"ID":"' . $article['ID'] . '", "headline":"' . $article['headline'] . '", "content" : "' . $article['content'] . '", "date": "' . $article['date'] . '"}"'; 
    }
    echo "}"; 
} -->