<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="../style.css">
  </head>

WHY NO GIT/// I NEED TO CLONE INSTEAD OF DOWNLOADING ZIP

<?php
 
// From URL to get webpage contents.
$url = "http://127.0.0.1:5000/following/username/all";
 
// Initialize a CURL session.
$ch = curl_init(); 
 
// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);
 
$result = curl_exec($ch);
//$result = "test|toaeuth";
$result2 = explode('|', $result);
echo "<div id='mainUserList'>";
foreach ($result2 as $name) {
	echo "<a class='userLink' href='../profile?u=".$name."'>".  $name .  "<br>"; 
}
//echo $result; 
echo "</div>";
?>


</html>