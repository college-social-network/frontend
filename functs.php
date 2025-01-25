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

    function __construct($base_server_url) {
        $this->base_server_url = $base_server_url;
    }
    
    public function fetchFollowingByUsername($username) {
        //call the server to return the data
        $fetchedUsernames = $this->directCurlCall("/following/username/". $username);
        //separate and turn into list
        $usernamesList = explode('|', $fetchedUsernames);
        return $usernamesList;
    }

    public function fetchFollowersByUsername($username) {
        $fetchedUsernames = $this->directCurlCall("/followers/username/". $username);
        $usernamesList = explode('|', $fetchedUsernames);
        return $usernamesList;
    }

    public function fetchUserDataByUsername($username) {
        $fetchedData = $this->directCurlCall("/userdata/". $username);
        $decodedData = json_decode($fetchedData);
        return $decodedData;

    }

    public function fetchScheduleByUsername($username) {
        $fetchedData = $this->directCurlCall("/schedule/full/". $username);

        return $fetchedData;

    }

    public function getAllUsers() {
        $fetchedUsers = $this->directCurlCall("/getallusers");
        $usernameList = explode('|', $fetchedUsers);
        return $usernameList;
    }

    public function fetchScheduleByUsernameDay($username, $daynum) {
        $fetchedData = $this->directCurlCall("/schedule/day/". $username. "/". $daynum);

        return $fetchedData;
    }

    public function recordFunctionUse($fname, $dttime, $startTime, $endTime, $userid, $fsucc, $remote_addr, $forwarded_for) {
        $remote =$_SERVER['REMOTE_ADDR'];
        if ($remote =="") {$remote="EMPTY";}
        $forward =$_SERVER['HTTP_X_FORWARDED_FOR'];
        if ($forward =="") {$forward="EMPTY";}

        $url = "/recordfunctionuse/" . $fname . "/" . $dttime . "/" . $startTime . "/" . $endTime . "/" . $userid . "/" . $fsucc . "/" . $remote_addr . "/" . $forwarded_for;
    }


    private function directCurlCall($endpoint) {
        //url to endpoint
        $url = $this->base_server_url . $endpoint;
        //init session
        $ch = curl_init();
        //config
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        //execute
        $fetchedData = curl_exec($ch);
        return $fetchedData;
    }
}
$api = new api($base_server_url);

?>