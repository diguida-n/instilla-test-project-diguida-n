<?php 
	function putHrefInArray(&$array, $html){
	$dom = new DOMDocument;
	$dom->loadHTML($html);
	foreach ($dom->getElementsByTagName('a') as $node) {
		if ($node->hasAttribute( 'href' ) ){
			$array[] = $node->getAttribute( 'href' ); 
		}
	}
	function getTitle($url){
		$title = '';
		$dom = new DOMDocument;

		if($dom->loadHTMLFile($url)) {
		    $list = $dom->getElementsByTagName("title");
		    if ($list->length > 0) {
		        $title = $list->item(0)->textContent;
			}
		}
                    return $title;
	}