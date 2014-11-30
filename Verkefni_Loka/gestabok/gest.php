<!doctype html>
<html lang="is">
    <head>
        <title>Gestabók</title>
        <link href="http://fonts.googleapis.com/css?family=Audiowide%7CRoboto" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://notendur.hi.is/~sas55/Lokaverkefni/Verkefni_4_SnorriAgustSnorrason.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 1100px)" href="https://notendur.hi.is/sas55/Lokaverkefni/CSS/breakPoint_1.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 800px)" href="https://notendur.hi.is/sas55/Lokaverkefni/CSS/breakPoint_2.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 600px)" href="https://notendur.hi.is/sas55/Lokaverkefni/CSS/breakPoint_3.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 400px)" href="https://notendur.hi.is/sas55/Lokaverkefni/CSS/breakPoint_4.css">
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
              <h2>Guestbook</h2>
            </div>
          </div>
        <div>
        <div class='story-boxS'>
            <form action="" method="post" enctype="multipart/form-data" name="gestabok" class="contactform" title="Gestabok">
                <p>&nbsp;</p>
                <div class="field">
                  <p>Name:</p>
                  <input name="name" type="text" maxlength="20" id="name" />
                </div>
                <div class="field">
                  <p>Comment:  </p>
                  <textarea name="comment" type="text" id="comment" maxlength="50" /> </textarea>
                </div>  
        
                <p>&nbsp;</p>
                <div class="buttonsGuestB">
                  <input name="submit" type="submit" value="Submit" id="button1" class="button" />                  
                  <input name="reset" type="reset" value="Reset" id="button2" class="button" />
                </div>
                <p>&nbsp;</p>
            </form>
        </div>
      </div>

      <?php

        $today = "";
        $month = "";
        $day = "";
        $year = "";
        $person = "" ;
        $comment = "" ;

        // Read from ("gestabok.dat");
        if (file_exists("gestabok.dat"))
        {

          $file = fopen("gestabok.dat", "r", 81);
          while (!feof($file)) {
             $line1 = fgets($file);
             $line2 = fgets($file);
             $line3 = fgets($file);


          echo "<div class='story-boxS'>";

            echo  "<div class='story-headerS'>";
              echo "<h2>" . $line2 . "</h2>";
            echo "</div>";

            echo  "<article class='story-articleS'>";
              echo '<h3>' . $line3 . '</h3>';
              echo  '<p>' . $line1 . '</p>';
            echo "</article>";

          echo "</div>";
          }
          fclose($file);
        }
        else
        {
        print "No Comments in gestabok";
        }
        print '</table>';

        // Check if file exists, then write to ("gestabok.dat");
        $today = getdate();
        $month = $today[mon];
        $day = $today[mday];
        $year = $today[year];
        $person = $_REQUEST['name'] ;
        $comment = $_REQUEST['comment'] ;
        
        if ($person !="")
        {
          if (file_exists("gestabok.dat"))
          {
            // Append to gestabok.dat if exist
            file_put_contents("gestabok.dat", "$day" . ".", FILE_APPEND );
            file_put_contents("gestabok.dat", "$month" . ".", FILE_APPEND);
            file_put_contents("gestabok.dat", "$year\n", FILE_APPEND );
            file_put_contents("gestabok.dat", "$person\n", FILE_APPEND);
            file_put_contents("gestabok.dat", "$comment\n", FILE_APPEND);

          }
          else 
          {
            // Create new gestabok.dat if !exist
            file_put_contents("gestabok.dat", "$day" . ".");
            file_put_contents("gestabok.dat", "$month" . ".");
            file_put_contents("gestabok.dat", "$year\n");
            file_put_contents("gestabok.dat", "$person\n");
            file_put_contents("gestabok.dat", "$comment\n");
          }
        }
      ?>
      <script src="https://notendur.hi.is/sas55/Lokaverkefni/jquery-1.11.1.js"></script>
      <script type="text/javascript" src="https://notendur.hi.is/sas55/Lokaverkefni/header.js"></script>
      <script src="https://notendur.hi.is/sas55/Lokaverkefni/hideShowStories.js"></script>
    </main> 
  </body>
</html>