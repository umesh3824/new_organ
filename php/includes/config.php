<?php
//error_reporting(0);

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "organ_donation";

$servername = "localhost";
$username = "epiz_29810514";
$password = "Ouf3u0AWjb7";
$dbname = "epiz_29810514_organ";
// Create connection
session_start();
$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$returnData = array("status"=>"false", "message"=>" ", "data"=>[]);

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function isChecked($data){
    return $data=="YES"?"checked":"";
}
function cmpData($data1,$data2){
  return $data1==$data2?"selected":"";
}

class Record{
  public $DBObj;
  public $recordS="selected records are......";
  public $recordF="Record not found.";
  public function showAlert($text){
    echo "<script> alert('".$text."'); </script>";
  }
}
?>