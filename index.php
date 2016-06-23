<?php

 function findAndCompare($firstLink, $secondLink)
{
	// acquisizione html primo link
	$html1 = file_get_contents($firstLink);
	$dom1 = new DOMDocument;
	$dom1->loadHTML($html1);
	$anchorsLink1=[];
	$j=0;
	foreach ($dom1->getElementsByTagName('a') as $node) {
		if ($node->hasAttribute( 'href' ) ){
			$anchorsLink1[] = $node->getAttribute( 'href' ); 
			$j++;
		}
	}
	// acquisizione html secondo link
	$html2 = file_get_contents($secondLink);
	$dom2 = new DOMDocument;
	$dom2->loadHTML($html2);
	$anchorsLink2=[];
	$i = 0;
	foreach ($dom2->getElementsByTagName('a') as $node) {
		if ($node->hasAttribute( 'href' ) ){
			$anchorsLink2[] = $node->getAttribute( 'href' ); 
			$i++;
		}
	}

	$length1 = count($anchorsLink1) ;
	$length2 = count($anchorsLink2) ;
	
	$mergedAnchors=[];
	for ($i=0; $i <$length1 ; $i++) { 
		$maxSimilarity=-1;
		$index=-1;
		for ($j=0; $j <$length2 ; $j++) { 
			similar_text($anchorsLink1[$i], $anchorsLink2[$j],$percent);
			if($percent>=$maxSimilarity){
				$maxSimilarity = $percent;
				$index = $j;		
			}
		}
				$mergedAnchors[] = [$anchorsLink1[$i] , $anchorsLink2[$index], number_format($maxSimilarity, 2, '.', '')];
	}
		//stampa array
	foreach ($mergedAnchors as $anchor) {
    		foreach ($anchor as $piece) {
    			echo $piece." , ";
    		}
    		echo "<br>";
	} 
	

	echo "Somiglianza <br>"; 
	
   	if ( $length1 > $length2 ) {
   		similar_text($length1, $length2,$percent); 
   		echo  $percent . "%";
   	}
   	else {
   		similar_text($length2, $length1,$percent);
   		echo  $percent . "%";
   	}
}

?>
<?php 

	if( isset( $_POST[ 'firstlink' ] ) && isset( $_POST [ 'secondlink' ] ) ) {
		findAndCompare($_POST['firstlink'],$_POST['secondlink' ] ) ; 

	} 

?>

<form action="/" method="POST">
  First link:<br>
  <input type="text" name="firstlink"><br>
  Second link:<br>
  <input type="text" name="secondlink">
<button type="submit">findAndCompare</button>
</form>


