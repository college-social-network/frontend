<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="../style.css">
  </head>


<?php
include "../config.php";
include "../functs.php";

$result = $api->fetchFollowersByUsername("all");


echo "<div id='mainUserList'>";
foreach ($result as $name) {
	echo "<a class='userLink' href='../profile?u=".$name."'>".  $name .  "<br>"; 
}
//echo $result; 
echo "</div>";
?>


</html>