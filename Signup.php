<?php
$conn = new mysqli("localhost:3310", "root", "0413", "school");
if($conn -> connect_error) {
    die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
}
$sql = "SELECT * FROM school.student";
$result = $conn -> query($sql);

// Store form values in variables
$ENRL_YEAR = 2018;
$STU_FNAME = $_REQUEST['FNAME'];
$STU_MI = $_REQUEST['MI'];
$STU_LNAME = $_REQUEST['LNAME'];
$STU_BDAY = $_REQUEST['BDAY'];
$STU_GENDER = $_POST['GENDER'];
$DEPT_ID = $_POST['DEPTID'];
$STU_TYPE = "REGULAR";

// $sql = "INSERT INTO school.student VALUES (Null, '$FNAME', '$MI', '$LNAME', 2, 'CS', 'A', True, 'Regular')";
// To be updated in docs


$conn -> close();

// echo "$ENRL_YEAR $STU_FNAME $STU_MI $STU_LNAME $STU_BDAY $STU_GENDER $DEPT_ID $STU_TYPE";
// Debugging line
?>