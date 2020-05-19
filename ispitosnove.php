<?php

$numbersJson = file_get_contents(__DIR__. '/words.json');
$numbers = json_decode($numbersJson, true);

if (isset($_POST["upišite_riječ"]) && !empty($_POST["upišite_riječ"])) {
	$samoglasnici = ['a','e','i','o','u'];
	$suglasnici = ['b','c','d','f','g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'z'];
	$word = $_POST['upišite_riječ'];
	$letterNumber = strlen($_POST["upišite_riječ"]);
	$vowels = 0;
	//$consonants = 0;
	for($i=0; $i<$letterNumber; $i++){
	    if(in_array($word[$i], $samoglasnici)) {
		$vowels++;
	    }
	   /* if(in_array($word[$i], $suglasnici)) {
		$consonants++;
	    }*/
	}
	$consonants = $letterNumber - $vowels;
	$num = ['word' => $word,
		'number_letters' => $letterNumber,
		'number_vowels' => $vowels,
		'consonants' => $consonants
	       ]; 
	$numbers[] = $num;
	$numJson = json_encode($numbers);
	$res = file_put_contents(__DIR__. '/words.json', $numJson);
}
?>

<!DOCTYPE html>
<head>
	<title>PHP OSNOVE ISPIT</title>
<head>
<body>
<h2>UPIŠITE ŽELJENU RIJEČ!</h2>


<form action = "ispitosnove.php" method="POST">
<label>Upišite riječ:</label><br><input type = "text" name = "upišite_riječ" /><br>
<input type = "submit" value = "Pošalji" /><br><br>

<table border = "1" cellpadding = "10">
	<tr>
		<th>Riječ</th>
		<th>Broj slova</th>
		<th>Broj suglasnika</th>
		<th>Broj samoglasnika</th>
	</tr>

<body>
<?php
	foreach($numbers as $number) {
		echo '<tr>';
			echo '<td>'. $number['word']. '</td>';
			echo '<td>'. $number['number_letters']. '</td>';
			echo '<td>'. $number['consonants']. '</td>';
			echo '<td>'. $number['number_vowels']. '</td>';
		echo '</tr>';
}

?>

		
</table>

</html>

