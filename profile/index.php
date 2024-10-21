<?php
//echo 'Hello ' . htmlspecialchars($_GET["u"]) . '!';

$username = htmlspecialchars($_GET["u"]);

echo "username: " . $username . "<br>";



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

$url = "http://127.0.0.1:5000/schedule/full/" . $username;
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
echo "<br> Schedule: " . "<br><br>";

$ex = explode("+", $result);

foreach( $ex as $e) {
	//echo $e . "<br>";
	$a = explode("?", $e);
	if($a[1] != "N") {
		echo $a[0] . "<br>";
		$s = explode(".", $a[1]);
		foreach($s as $p) {
			$r = explode("@",$p);
			foreach($r as $o) {
				echo '&nbsp'.'&nbsp' . $o;}
		echo "<br>";
}


	}



}


?>