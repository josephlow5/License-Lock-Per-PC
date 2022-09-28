<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dc_new_user_dm_bot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['Create'])){
  $MachineCode = $_GET['Create'];
  if(isset($_GET['Key'])){
    $SecurityKey = $_GET['Key'];
    if($SecurityKey=="dclicense"){
      $sql = "INSERT INTO machine_license (MachineCode, Status) VALUES ('".$MachineCode."', 1)";

      if ($conn->query($sql) === TRUE) {
        echo "已成功授权机器:".$MachineCode;
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
      die();
    }
  }
}
if(isset($_GET['Delete'])){
  $MachineCode = $_GET['Delete'];
  if(isset($_GET['Key'])){
    $SecurityKey = $_GET['Key'];
    if($SecurityKey=="dclicense"){
      $sql = "INSERT INTO machine_license (MachineCode, Status) VALUES ('".$MachineCode."', 1)";

      if ($conn->query($sql) === TRUE) {
        echo "已成功删除机器:".$MachineCode;
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
      die();
    }
  }
}

if(isset($_GET['MachineCode'])){
  $MachineCode = $_GET['MachineCode'];
}else{
  $MachineCode = "Empty";
}

$sql = "SELECT Status FROM machine_license WHERE MachineCode = '".$MachineCode."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    if($row["Status"]==1){
      echo "Valid!";
    }else{
      echo "Invalid";
    }
  }
} else {
  echo "Invalid";
}
$conn->close();
?>