<?php
 require 'helpers.php';


error_reporting(E_ALL ^ E_WARNING);
 function findAndCompare($firstLink, $secondLink)
{
	// acquisizione html primo link
	$html1 = file_get_contents($firstLink);
	$anchorsLink1 =[];
	putHrefInArray($anchorsLink1, $html1);

	
	// acquisizione html secondo link
	$html2 = file_get_contents($secondLink);
	$anchorsLink2 =[];
	putHrefInArray($anchorsLink2, $html2);

	
	//acquisizione html prima anchor del link 1
	$firstAnchorFirstSite = file_get_contents($anchorsLink1[0]);
	putHrefInArray($anchorsLink1, $firstAnchorFirstSite);
	
	//acquisizione html prima anchor del link 2
	$firstAnchorSecondSite = file_get_contents($anchorsLink2[0]);
	putHrefInArray($anchorsLink2, $firstAnchorSecondSite);
	//acquisizione title from link 1
	$titlesFirstLink = [];
	foreach ($anchorsLink1 as $anchor ) {
		$titlesFirstLink [$anchor] = getTitle($anchor);
	}
	//acquisizione title from link 2

	$titlesSecondLink = [];
		foreach ($anchorsLink2 as $anchor ) {
		$titlesSecondLink [$anchor] = getTitle($anchor);
	}



	//unione degli array per somiglianza dell'href
	$length1 = count($anchorsLink1) ;
	$length2 = count($anchorsLink2) ;
	


	for ($i=0; $i <length1 ; $i++) { 
		
	}
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
		
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=percSimilarityNDG.csv');

	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');

	// output the column headings
	fputcsv($output, array('Link 1', 'Link 2', '%'));


	// loop over the rows, outputting them
	foreach ($mergedAnchors as $row) {
		fputcsv($output, $row);
	}
	
}

	

} 

	if( isset( $_POST[ 'firstlink' ] ) && isset( $_POST [ 'secondlink' ] ) ) {
		findAndCompare($_POST['firstlink'],$_POST['secondlink' ] ) ; 
		die();
	} 

?>
<html>
	<head></head>
	<body>
	
<form action="/" method="POST">
  First link:<br>
  <input type="text" name="firstlink"><br>
  Second link:<br>
  <input type="text" name="secondlink">
<button type="submit">findAndCompare</button>
</form>


	
	</body>
</html>