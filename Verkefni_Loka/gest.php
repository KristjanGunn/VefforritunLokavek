<!doctype html>
<html lang="is">
    <head>
        <title>Gestabók</title>
        <link href="http://fonts.googleapis.com/css?family=Audiowide%7CRoboto" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="Verkefni_4_SnorriAgustSnorrason.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 1100px)" href="breakPoint_1.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 800px)" href="breakPoint_2.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 600px)" href="breakPoint_3.css">
        <link rel="stylesheet" type="text/css" media="screen and (max-width: 400px)" href="breakPoint_4.css">
        <meta charset="UTF-8">
    </head>
    <main class="main-wrap">
      <header>
          <div id="headerStuff">
            <ul>
              <a href="https://notendur.hi.is/sas55/Lokaverkefni/verkefni_4_SnorriAgustSnorrason.html"><li class="button">HOME</li></a>
              <a href="https://notendur.hi.is/sas55/Lokaverkefni/APIStuff"><li class="button">GAMES</li></a>
            </ul>
          </div>
      </header>

      <body>
        <div>
          <div class='story-box'>
              <form action="" method="post" enctype="multipart/form-data" name="gestabok" class="contactform" title="Gestabok">
                  <p>&nbsp;</p>
                  <label id="label">Name:   </label>
                  <input name="name" type="text" size="40" maxlength="80" id="input1" />
                  <br /><br />


                  <div class="field">
                    <label for="text">Comment:  </label>
                    <textarea name="comment" type="text" size="1100px" id="input2" maxlength="400" /> </textarea>
                  </div>   
          
                  <p>&nbsp;</p>
          
                  <input name="submit" type="submit" value="Submit" id="button1" class="button" onClick="history.go(0)" VALUE="Refresh" />                  
                  <input name="reset" type="reset" value="Reset" id="button2" class="button" />
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
            echo "<div class='main-wrap'>";

                    $file = fopen("gestabok.dat", "r", 81);
                    while (!feof($file)) {
                       $line1 = fgets($file);
                       $line2 = fgets($file);
                       $line3 = fgets($file);

 
            echo "<div class='story-box'>";

              echo  "<div class='story-header'>";
                echo "<h2>" . $line2 . "</h2>";
              echo "</div>";

              echo  "<article class='story-article'>";
                echo '<h3>' . $line3 . '</h3>';
                echo '</br>';
                echo  '<p>' . $line1 . '</p>';
              echo "</article>";

              echo "</div>";
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


    </main> 
  </body>
</html>