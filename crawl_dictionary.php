<?php
  include 'simple_html_dom.php';
// url to crawling : https://pdictionary.com/english/browse.php?bm=1&db=pd

$counter = 0;
$max = 636; //636
$domain = "https://pdictionary.com/";

// $myFile = fopen("data_dictionary.txt", "a+");
echo "<pre>";

for( $i=0; $i<=$max; )
{
	if($i==0)
	{
		$i == 'zero';
	}
  $url = "https://pdictionary.com/english/browse.php?bm=".$i."&db=pd";
  $html = file_get_html($url);

  $row_pic1 = $html->find('tr', 8);
	$row_word1 = $html->find('tr', 9);
  $row_pic2 = $html->find('tr', 10);
	$row_word2 = $html->find('tr', 11);
  //
  $row_pic1 = $row_pic1->find('td img');
  $row_word1 = $row_word1->find('td b');

  $row_pic2 = $row_pic2->find('td img');
  $row_word2 = $row_word2->find('td b');


  for($j=0; $j<3; $j++){
    // code...
    $pic1 = $domain.$row_pic1[$j]->src;
    $w1 = $row_word1[$j]->plaintext;
    addslashes($pic1);
    addslashes($w1);
    // echo $pic1."     ".$w1;

    $sql = "INSERT INTO vocabulary ('id', 'image', 'word') VALUES (NULL, '$pic1', '$w1');\n";
    // fwrite($myFile, $sql);
    echo $sql;
    echo '<br>';

    $pic2 =  $domain.$row_pic2[$j]->src;
    $w2 = $row_word2[$j]->plaintext;
    addslashes($pic2);
    addslashes($w2);
    // echo $pic2."     ".$w2;
    $sql = "INSERT INTO vocabulary ('id', 'image', 'word') VALUES (NULL, '$pic2', '$w2');\n";
    // fwrite($myFile, $sql);
    echo $sql;
    echo '<br>';
  }

	$i+=6;
  $counter+=6;
  // echo $counter;
}


// fclose($myFile);
echo "<br>";
echo $counter;
