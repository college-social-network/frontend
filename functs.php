<?php
//$fname = "QUICKFINANCE";
//$startTime = time();
//$dttime = date("Y-m-d H:i:s",$startTime);

$userID = "default_no_data";
//$endTime = time();
//$fsucc = "fail";
function recordUse($fname, $dttime, $startTime, $endTime, $userid, $fsucc) {
    global $dbname;
    global $servername;
    global $password;
    global $username;
    $remote =$_SERVER['REMOTE_ADDR'];
if ($remote =="") {$remote="EMPTY";}
$forward =$_SERVER['HTTP_X_FORWARDED_FOR'];
if ($forward =="") {$forward="EMPTY";}
include './config.php';
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO function_usage (functName, startMills, endMills, startTime, userid, typesucc, remote_addr, forwarded_for)
  VALUES ('$fname', '$startTime', '$endTime', '$dttime', '$userid', '$fsucc', '$remote', '$forward')";
  // use exec() because no results are returned
  $conn->exec($sql);
  //echo "New record created successfully";
} catch(PDOException $e) {
  //echo $sql . "<br>" . $e->getMessage();
}

//  echo "$fname Refsnes.<br>";
//  echo "$dttime Refsnes.<br>";
//  echo "$startTime Refsnes.<br>";
//  echo "$endTime Refsnes.<br>";
//  echo "$userid Refsnes.<br>";
}
//recordUse($fname, $dttime, $startTime, $endTime, $userid, $fsucc);

class api {
    public $base_server_url;

    function __construct($base_server_url)
    {
        $this->base_server_url = $base_server_url;

    }
    function fetchFollowersByUsername($username)
    {#TODO this
        //create url to endpoint
        $url = $this->base_server_url . "/following/username/" . $username;

        //initialize curl session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        //execute
        $fetchedUsernames = curl_exec($ch);

        //turn string into list of usernames
        $usernamesList = explode('|', $fetchedUsernames);


        return $usernamesList;
    }

}
$api = new api($base_server_url);

?>