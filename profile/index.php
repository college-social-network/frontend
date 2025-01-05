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

$compressedSchedule = $api->fetchScheduleByUsername($username);
$dayAndDayInfo = explode("+", $compressedSchedule);

foreach( $dayAndDayInfo as $singleDayInfo) {

    $a = explode("?", $singleDayInfo);

    $day = $a[0];
	$classesCompressed = $a[1];

    if($classesCompressed != "N") {
		echo $day . "<br>";
		$classCompressed = explode(".", $classesCompressed);

        foreach($classCompressed as $class) {
			$uncompressedIndividualClassInfo = explode("@",$class);

            foreach($uncompressedIndividualClassInfo as $data) {
				echo '&nbsp'.'&nbsp' . $data;}
		echo "<br>";
        }
	}
}


?>