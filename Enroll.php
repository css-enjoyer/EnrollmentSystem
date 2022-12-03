<?php
$conn = new mysqli("localhost:3310", "root", "0413", "schoolenrollment");
if($conn -> connect_error) {
    die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
}
$sql = "SELECT * FROM schoolenrollment.Courses";
$result = $conn -> query($sql);

// ID Automatically Generated in SQL 
$STU_FNAME = $_REQUEST["FNAME"];
$STU_MI = $_REQUEST["MI"];
$STU_LNAME = $_REQUEST["LNAME"];
$STU_GENDER = $_REQUEST['GENDER'];
$STU_BDAY = $_REQUEST['BDAY'];
$DEPT_ID = $_REQUEST['DEPTID'];


if (mysqli_query($conn, $sql) ) {
    echo "Data fetched successfully";
    // $sql = "INSERT INTO schoolenrollment.Students VALUES (Null, '$FNAME', '$MI', '$LNAME', 2, 'CS', 'A', True, 'Regular')";
    // echo "$STU_FNAME $STU_MI $STU_LNAME $STU_GENDER $STU_BDAY $DEPT_ID";
} 
else {
    echo "Data fetch failed";
}

$conn -> close();
?>