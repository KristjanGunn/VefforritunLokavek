<?php
// skilum UTF-8 til vafra með header
header('Content-Type: text/html; charset=utf-8');

// server superglobal er með REQUEST_METHOD sem er HTTP aðferð sem notuð var
$method = $_SERVER['REQUEST_METHOD'];

// er verið að post'a formi? Meðhöndlum þá gögn
if ($method === 'POST')
{
  $commentRequired = "";
  $nameRequired = "";

  if(empty($_POST['name'])) 
  {
    $nameRequired = "Reit vantar.";
	}
  if(empty($_POST['comment'])) 
  {
    $commentRequired = "Reit vantar.";
  }

}

// púslum saman viðmóti -- hér gæti þurft að hrista eitthvað upp í hlutunum
include('views/gest.php');