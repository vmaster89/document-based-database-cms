<?php 
require_once('./MVC/model.php'); 
require_once('./MVC/view.php'); 
class controller {  
	function createWebpage($getParams, $postParams) { 
        $view = new view(); 
        $model = new model(); 
		$layout = $this->loadLayout(); 
		$layout = $view->loadNavigation((string)$layout, $model); 
		$dom = new DOMDocument(); 
        foreach ($getParams as $key => $value) { 
            $getParams[$key] = htmlentities($getParams[$key]); 
        } 
        !(isset($getParams['Label'])) ? $label = 0: $label = $getParams['Label']; 
        $layout = utf8_decode( $this->switchPage($getParams, $layout, 10, $model, $view, $label) ); 
        @$dom->loadHTML($layout); 
		echo $dom->saveHTML(); 
	} 
	function loadLayout() { 
		$layout = file_get_contents('./layout/layout.php', FILE_USE_INCLUDE_PATH); 
		return $layout; 
	} 
	function switchpage($getParams, $layout, $maxArticleCount, $model, $view, $label) { 
        $article = $model->getArticle();
        if (isset($getParams['q']) && (array_key_exists('q', $getParams)=='1')) { 
            $pageHTML = $model->getPage((string)$getParams['q']); 
            $layout = $view->generatePage($getParams, (string)$getParams['q'], $pageHTML, $article, $layout); 
        } 
        if (isset($getParams['c']) && (array_key_exists('c', $getParams)=='1')) { 
            unset($pageHTML); 
            $pageHTML = $model->getCustomcontent(); 
            $custompage = $model->getCustompage(); 
            $layout = $view->generateCustompage($getParams, (string)$getParams['c'], $pageHTML, $custompage, $layout, $label); 
        } 
         if (isset($getParams['x']) && (array_key_exists('x', $getParams)=='1')) { 
            unset($pageHTML); 
            $pageHTML = $model->getPage((string)$getParams['x']); 
            $custompage = $model->getCustompage(); 
            $layout = $view->generateCustompage($getParams, (string)$getParams['x'], $pageHTML, $custompage, $layout, $label); 
        } 
		return $layout; 
	} 
} 
?> 