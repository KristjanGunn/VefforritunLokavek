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
				    	<a href="https://notendur.hi.is/sas55/Lokaverkefni/verkefni_4_SnorriAgustSnorrason.html">
				    		<li class="button">HOME</li></a>
				    	<a href="https://notendur.hi.is/sas55/Lokaverkefni/API">
				    		<li class="button">GAMES</li></a>
				    	<a href="https://notendur.hi.is/~sas55/Lokaverkefni/guestbook/gest.php">
				    		<li class="button">GUESTBOOK</li></a>
				    </ul>
			    </div>
			</header>

			<div class="bannerS">
				<div class="story-boxS">
					<div class="story-header">
						<h2>Game Search</h2>
					</div>
					<form method="get">
					    <p class="gameSearchText">Input search: </p> 
					    <input type="text" name="query" id="query"></input>
					        <br></br>
					</form>
				</div>
			</div>

			<div id="disabled">

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
				if (!empty($_GET['query'])) {
					$query = $_GET['query'];
				}
				error_reporting (E_ALL ^ E_NOTICE);
				$url = 'http://www.giantbomb.com/api/search/?api_key=4cd2262e2399bb08f1507d97726ad8b5d34cebbc&format=json&limit=10&query=' . $query . '/game';
				$ch=curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$r=curl_exec($ch);
				curl_close($ch);

				$arr = json_decode($r,true);

				$i = 0;
				foreach($arr['results'] as $val) {	

					if(empty($val['description']))  {
						continue;
					}
					$i++;
					if ($i>10) {break;}
					echo "<div class='story-boxS'>";
						echo  "<div class='story-headerS'>";
							echo "<h2>" . $val['name'] . "</h2>";
						echo "</div>";

						echo "<div class='wrapperImagesS'>";
							echo "<div class='imagesS'>";
								echo "<div class='imagesS'>";
									$img =  $val['image']['small_url'];
									echo "<img src=\"$img\" title=\"Concert\" alt=\"Concert picture\" />";
								echo "</div>";
							echo "</div>"; 
						echo "</div>";

						echo  "<article class='story-articleS'";
							echo "<a href='link.html' class='disabled'>";
								echo  "<p>" . $val['description'] . "</p>";
							echo "</a>";
							$date = $val['original_release_date'];
							$newDate = new DateTime($date);
							echo "<p>" . "Release date: " . $newDate->format('Y-m-d') . "</p>";
						echo "</article>";
					echo "</div>";
				}
				?>
			</div>

			<script src="https://notendur.hi.is/sas55/Lokaverkefni/jquery-1.11.1.js"></script>
	    	<script type="text/javascript" src="https://notendur.hi.is/sas55/Lokaverkefni/header.js"></script>
	    	<script src="https://notendur.hi.is/sas55/Lokaverkefni/hideShowStories.js"></script>
		</main>	
	</body>
</html>



