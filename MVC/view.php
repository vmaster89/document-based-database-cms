<?php 
class view {  
    function loadNavigation($layout, $model) { 
		$pageHTML = rawurldecode(file_get_contents('./layout/navigation.php', FILE_USE_INCLUDE_PATH)); 
		$navigation_array = $model->getNavigation(); 
		for ($i = 0; $i < sizeof($navigation_array); $i++) { 
			$pageNewElement = str_replace('[label]', '[label' . $i . ']', $pageHTML); 
			$pageNewElement = str_replace('[url]', '[url' . $i . ']', $pageNewElement); 
			$pageNavigationElementAll = $pageNewElement . $pageNavigationElementAll; 
		} 
		$pageHTML = $pageNavigationElementAll; 
		for ($i = 0; $i < sizeof($navigation_array); $i++) { 
			$pageHTML = str_replace('[label' . $i . ']', $navigation_array['elem' . $i]["Label"], $pageHTML); 
			$pageHTML = str_replace('[url' . $i . ']', str_replace(' ', '', $navigation_array['elem' . $i]["URL"]), $pageHTML); 
		}  
		$layout = str_replace('[navibar]', $pageHTML, $layout);
		return $layout; 
	} 
	function generatePage($getParams, $page, $pageHTML, $pageData, $layout) { 
        if ( isset($getParams['ID']) and !empty($getParams['ID'])) { 
            $ID = $getParams['ID']; 
        } 
        $admin = json_decode(rawurldecode(file_get_contents('./data/config.json', FILE_USE_INCLUDE_PATH)), TRUE); 
        $cookie = $_COOKIE['superkey']; 
        $token = $admin['adminLogin']['token']; 
        if ($page == 'admin_panel' || $page == 'edit_article' ) { 
            // load article     
            if ($page = 'admin_panel' && ($cookie == $token)) { 
                $article_array = $pageData;  
                $pageHTML = str_replace('[ID]', $article_array["ID"][intval($ID)], $pageHTML); 
			    $pageHTML = str_replace('[headline]', $article_array["headline"][intval($ID)], $pageHTML); 
			    $pageHTML = str_replace('[date]', $article_array["date"][intval($ID)], $pageHTML); 
			    $pageHTML = str_replace('[content]', html_entity_decode($article_array["content"][intval($ID)]), $pageHTML); 
            } else { 
                $pageHTML = "Sorry, but you're not logged in [1]."; 
            }
            // end article 

        } else if ($page == 'blog' || ( $page == 'delete_article' && $cookie == $token ) ) { 
			$article_array = $pageData; 
            
            // shows a maximum of 10 articles 
            $x = sizeof($article_array['headline']) - 10; 
			for ($i = $x; $i < sizeof($article_array['headline']); $i++) { 
                $pageNewArticle = str_replace('[ID]', '[ID' . $i . ']', $pageHTML); 
				$pageNewArticle = str_replace('[headline]', '[headline' . $i . ']', $pageNewArticle); 
				$pageNewArticle = str_replace('[date]', '[date' . $i . ']', $pageNewArticle); 
				$pageNewArticle = str_replace('[content]', '[content' . $i . ']', $pageNewArticle); 
				$pageArticleAll = $pageNewArticle . $pageArticleAll; 
			}
            /** How often does i = 10 fit in maxcoun?  
            sei maxCount = 45 
            x = modulo(maxCount)10 = 5 
            y = maxCount - x 
            result = y / 10 = 4 
            
            **/            
			$pageHTML = $pageArticleAll; 
			for ($i = 0; $i < sizeof($article_array['headline']); $i++) { 
                $pageHTML = str_replace('[ID' . $i . ']', $article_array["ID"][$i], $pageHTML); 
				$pageHTML = str_replace('[headline' . $i . ']', $article_array["headline"][$i], $pageHTML); 
				$pageHTML = str_replace('[date' . $i . ']', $article_array["date"][$i], $pageHTML); 
				$pageHTML = str_replace('[content' . $i . ']', html_entity_decode($article_array["content"][$i]), $pageHTML); 
			}  
		} 
		
		$layout = str_replace('[content]', html_entity_decode($pageHTML), $layout); 
        // $layout = 'Hi'; 
		return $layout; 
	} 
    function generateCustompage($getParams, $page, $pageHTML, $pageData, $layout, $label) { 
        $admin = json_decode(rawurldecode(file_get_contents('./data/config.json', FILE_USE_INCLUDE_PATH)), TRUE); 
        $cookie = $_COOKIE['superkey']; 
        $token = $admin['adminLogin']['token']; 
        if ( ( $page == 'delete_page' || $page == 'edit_page' ) && $cookie == $token ) { 
			$article_array = $pageData; 

            $page == 'edit_page'? $size = 1: $size = sizeof($article_array);  
			for ($i = 0; $i < $size; $i++) { 
                $pageNewArticle = str_replace('[Label]', '[Label' . $i . ']', $pageHTML); 
				$pageNewArticle = str_replace('[headline]', '[headline' . $i . ']', $pageNewArticle); 
				$pageNewArticle = str_replace('[date]', '[date' . $i . ']', $pageNewArticle); 
				$pageNewArticle = str_replace('[content]', '[content' . $i . ']', $pageNewArticle); 
				$pageArticleAll = $pageNewArticle . $pageArticleAll; 
			} 
			$pageHTML = $pageArticleAll; 
            $i = 0; 
            $page == 'edit_page'? $size = 1: $size = sizeof($article_array);  
			foreach ( $article_array as $key => $value ) { 
                $page == 'edit_page'? $temp = $label: $temp = $key;  
                $pageHTML = str_replace('[Label' . $i . ']', $temp, $pageHTML); 
				$pageHTML = str_replace('[headline' . $i . ']', $article_array[$temp]["headline"], $pageHTML); 
				$pageHTML = str_replace('[date' . $i . ']', $article_array[$temp]["date"], $pageHTML); 
				$pageHTML = str_replace('[content' . $i . ']', html_entity_decode($article_array[$temp]["content"]), $pageHTML); 
                $i++; 
			} 
        } else { 
            $pageHTML = str_replace('[headline]', $pageData[$page]["headline"], $pageHTML); 
		    $pageHTML = str_replace('[date]', $pageData[$page]["date"], $pageHTML); 
		    $pageHTML = str_replace('[content]', html_entity_decode($pageData[$page]["content"]), $pageHTML); 
        } 
        echo $article_array[0]; 
        $layout = str_replace('[content]', html_entity_decode($pageHTML), $layout); 
        return $layout; 
    }
} 
?> 