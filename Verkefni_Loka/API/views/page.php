<!doctype html>
<html lang="is">
	<head>
		<meta charset="utf-8">
		<title>Game Search</title>
        <link rel="stylesheet" href="https://notendur.hi.is/sas55/Lokaverkefni/Verkefni_4_SnorriAgustSnorrason.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 1100px)" href="https://notendur.hi.is/sas55/Lokaverkefni/breakPoint_1.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 800px)" href="https://notendur.hi.is/sas55/Lokaverkefni/breakPoint_2.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 600px)" href="https://notendur.hi.is/sas55/Lokaverkefni/breakPoint_3.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 400px)" href="https://notendur.hi.is/sas55/Lokaverkefni/breakPoint_4.css">
        <meta charset="UTF-8">
	</head>
	<body>
		<main class="main-wrap">

			<header>
		    	<div id="headerStuff">
		    		<ul>
				    	<a href="https://notendur.hi.is/sas55/Lokaverkefni/verkefni_4_SnorriAgustSnorrason.html"><li class="button">HOME</li></a>
				    	<a href="https://notendur.hi.is/sas55/Lokaverkefni/APIStuff"><li class="button">GAMES</li></a>
				    </ul>
			    </div>
			</header>

			<div class="story-box">

				<h1>Game Search</h1>
				<form method="get">
				    Input search: 
				    <input type="text" name="query" id="query"></input>
				        <br></br>
				</form>
			</div>

			<?php
			if( isset($_GET['submit']))
			{
			    //be sure to validate and clean your variables
			    //then you can use them in a PHP function. 
			    $result = search();
			}

			if( isset($result) ) echo $result; //print the result above the form 

			//check if you have curl loaded
			if(!function_exists("curl_init")) die("cURL extension is not installed");
			$query = $_GET['query'];
			//$query = "batman";
			$url = 'http://www.giantbomb.com/api/search/?api_key=4cd2262e2399bb08f1507d97726ad8b5d34cebbc&format=json&limit=10&query=' . $query;
			$ch=curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$r=curl_exec($ch);
			curl_close($ch);

			$arr = json_decode($r,true);

			$i = 0;

			foreach($arr['results'] as $val)
				{
					echo "<div class='main-wrap'>"; 
						echo "<div class='story-box'>";
							echo  "<div class='story-header'>";
								echo "<h2>" . $val['name'] . "</h2>";
							echo "</div>";

							echo  "<article class='story-article'>";
								echo  "<p>" . $val['description'] . "</p>";
								echo  "<p>" . $val['original_game_rating'] . "</p>";
								echo  "<p>" . $val['original_release_date'] . "</p>";
							echo "</article>";

							echo  "<div class='images'>";
								$a = $val['image']['screen_url'];
								echo '<br>';
									echo "<div class='images'>";
								echo "<img src=\"".$a."\">";
							echo "</div>";
						echo "</div>";
					echo "</div>";  
				}
			?>

			<script src="https://notendur.hi.is/sas55/Lokaverkefni/jquery-1.11.1.js"></script>
	    	<script type="text/javascript" src="https://notendur.hi.is/sas55/Lokaverkefni/header.js"></script>
	    	<script src="https://notendur.hi.is/sas55/Lokaverkefni/hideShowStories.js"></script>
		</main>	
	</body>
</html>



