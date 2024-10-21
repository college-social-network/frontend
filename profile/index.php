<?php
//echo 'Hello ' . htmlspecialchars($_GET["u"]) . '!';

$username = htmlspecialchars($_GET["u"]);

echo "username: " . $username . "<br>";

$url = "http://127.0.0.1:5000/schedule/full/" . $username;
 
// Initialize a CURL session.
$ch = curl_init(); 
 
// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);
echo "<br> Schedule: " . $result . "<br>";



$url = "http://127.0.0.1:5000/userdata/" . $username;
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);

$result = curl_exec($ch);
//echo $result;

$userdata = json_decode($result);
echo "Name: " . $userdata->name . "<br>";
echo "Major: " . $userdata->major . "<br>";
echo "Minor: " . $userdata->minor . "<br>";
echo "Year: " . $userdata->year . "<br>";




?>