<?php
$conn = new mysqli("localhost:3310", "root", "0413", "schoolenrollment");
if($conn -> connect_error) {
    die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
}
$sql = "SELECT * FROM schoolenrollment.Courses";
$result = $conn -> query($sql);

// ID Automatically Generated in SQL 
$FNAME = $_REQUEST["FNAME"];
$MI = $_REQUEST["MI"];
$LNAME = $_REQUEST["LNAME"];

$sql = "INSERT INTO schoolenrollment.Students VALUES (Null, '$FNAME', '$MI', '$LNAME', 2, 'CS', 'A', True, 'Regular')";

if (mysqli_query($conn, $sql) ) 
{
    echo "Data stored successfully";
} 
else 
{
    echo "Data storage failed";
}

$conn -> close();
?>