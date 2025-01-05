<?php
//echo 'Hello ' . htmlspecialchars($_GET["u"]) . '!';

include "../config.php";
include "../functs.php";

$username = htmlspecialchars($_GET["u"]);
echo "<div id='username'>";
echo "username: " . $username . "<br>";
echo "</div>";



//echo $result;

$userdata = $api->fetchUserDataByUsername($username);


echo "Name: " . $userdata->name . "<br>";
echo "Major: " . $userdata->major . "<br>";
echo "Minor: " . $userdata->minor . "<br>";
echo "Year: " . $userdata->year . "<br>";

echo "<br> Schedule: " . "<br><br>";

$uncompressedSchedule = $api->fetchScheduleByUsername($username);
$ex = explode("+", $uncompressedSchedule);

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