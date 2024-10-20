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

foreach ($result2 as $name) {
	echo "<a href='../profile?u=".$name."'>".  $name .  "<br>"; 
}
//echo $result; 
 
?>