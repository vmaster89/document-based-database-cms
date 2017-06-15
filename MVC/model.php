<?php 
	class model { 
		public function jsonArray($file) { 
			$input_json = file_get_contents("./data/".$file, FILE_USE_INCLUDE_PATH); 
			$input_json = utf8_encode($input_json); 
			$array_output = json_decode($input_json, true); 
			return $array_output; 
		}
		function getArticle() { 
			return $this->jsonArray("blog.json"); 
		}  
		function getNavigation() { 
			return $this->jsonArray("navigation.json");  
		} 
        function getCustompage() { 
			return $this->jsonArray("page.json");  
		} 
        function getConfig() { 
			return $this->jsonArray("config.json");  
		} 
        function getPage($page) {
            $output = file_get_contents('./layout/'.$page.'.php', FILE_USE_INCLUDE_PATH); 
            return $output; 
        } 
        function getCustomcontent() {
            $output = file_get_contents('./layout/custompage.php', FILE_USE_INCLUDE_PATH); 
            return $output; 
        } 
        function getLayout() { 
            $layout = file_get_contents('./layout/layout.php', FILE_USE_INCLUDE_PATH); 
            return $layout; 
        }
	} 
?> 