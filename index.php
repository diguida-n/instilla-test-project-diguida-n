<?php

 function findAndCompare($firstLink, $secondLink)
{
	// acquisizione html primo link
	$html1 = file_get_contents($firstLink);
	$dom1 = new DOMDocument;
	$dom1->loadHTML($html1);
	$anchorsLink1=[];
	$j=0;
	echo "primo link"."<br>";
	foreach ($dom1->getElementsByTagName('a') as $node) {
		if ($node->hasAttribute( 'href' ) ){
			$anchorsLink1[] = $node->getAttribute( 'href' ); 
			echo $anchorsLink1[$j] ."<br>" ;
			$j++;
		}
	}
	// acquisizione html secondo link
	$html2 = file_get_contents($secondLink);
	$dom2 = new DOMDocument;
	$dom2->loadHTML($html2);
	$anchorsLink2=[];
	$i = 0;
	echo "secondo link"."<br>";
	foreach ($dom2->getElementsByTagName('a') as $node) {
		if ($node->hasAttribute( 'href' ) ){
			$anchorsLink2[] = $node->getAttribute( 'href' ); 
			echo $anchorsLink2[$i] ."<br>" ;
			$i++;
		}
	}
	$length1 = strlen ( $firstLink ) ;
	$length2 = strlen ( $secondLink ) ;
	echo "Somiglianza <br>"; 
	
   	if ( $length1 > $length2 ) {
   		similar_text($length1, $length2,$perc); 
   		echo  $perc . "%";
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


