<!doctype html>
<html lang="is">
	<head>
		<meta charset="utf-8">
		<title>Tónleikar</title>
		<link rel="stylesheet" href="verkefni10.css">
		<link rel="stylesheet" type="text/css" media="screen and (max-width: 1500px)" href="breakpoint1500.css">
		<link rel="stylesheet" type="text/css" media="screen and (max-width: 800px)" href="breakpoint800.css">
		<link rel="stylesheet" type="text/css" media="screen and (max-width: 600px)" href="breakpoint600.css">
	</head>
	<body>
		<h1>Tónleikar</h1>

			<div id="tracker">
				<input type="search" name="searchCompany" id="inputSearch" class="search">
			</div>	

		<?php


//check if you have curl loaded
if(!function_exists("curl_init")) die("cURL extension is not installed");
$query = "elder scrolls";

$url = 'http://www.giantbomb.com/api/search/?api_key=4cd2262e2399bb08f1507d97726ad8b5d34cebbc&format=json&query=' . $query . 'resources=game&field_list=name,description,image';
//$url = 'http://www.giantbomb.com/api/search/?api_key=4cd2262e2399bb08f1507d97726ad8b5d34cebbc&format=json&query=batman';
$ch=curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$r=curl_exec($ch);
curl_close($ch);

$arr = json_decode($r,true);	

    //    var games = data.game;
    //    $.each(games, function(index, game) {	
    //        $('body').append('<h1>' + game.name + '</h1>');
		foreach($arr['results'] as $val)

		{
			echo "<div class='main-wrap'>"; 
			echo "<div class='story-box'>";
			echo  "<h2>" . $val['name'] . "</h2>";
			$a = $val['image']['screen_url'];
			echo '<br>';
				echo "<div class='images'>";
			echo "<img src=\"".$a."\">";
			echo "</div>";
			echo "</div>";
			echo "</div>";  

		}

?>		
	</body>
</html>



