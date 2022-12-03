<?php
$conn = new mysqli("localhost:3310", "root", "mysql", "school2");
if($conn -> connect_error) {
    die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
}
$sql = "SELECT * FROM school2.course";
$result = $conn -> query($sql);

// ID Automatically Generated in SQL 
$STU_FNAME = $_REQUEST["FNAME"];
$STU_MI = $_REQUEST["MI"];
$STU_LNAME = $_REQUEST["LNAME"];
$STU_GENDER = $_REQUEST['GENDER'];
$STU_BDAY = $_REQUEST['BDAY'];
$DEPT_ID = $_REQUEST['DEPT_ID'];
$CRS_IDs = $_POST['Courses'];

// TO FIX: Hardcoded values
$STU_ID = 107;
$ENRL_YEAR = 2022;

$CLASS_SEC = "A"; // kailangan ata makuha specialization
$CLASS_LOCATION = "Laboratory"; // ito specific lng for prog and info man.

$INSTR_ID = 500; // ito kapag 2 or more prof per course ex. prog maam. sideno at maam. alberto. rand func nlng
$EMPL_YEAR = 2010;

$add_student_query = "INSERT INTO student(ENRL_YEAR, STU_FNAME, STU_MI, STU_LNAME, STU_BDAY, STU_GENDER, DEPT_ID)
VALUES ($ENRL_YEAR, '$STU_FNAME', '$STU_MI', '$STU_LNAME', '$STU_BDAY', '$STU_GENDER', $DEPT_ID)";



if (mysqli_query($conn, $sql) ) {
    echo "Data fetched successfully";
    mysqli_query($conn, $add_student_query);
    // echo $add_student_query . "<br> <hr>";
    foreach ($CRS_IDs as $CRS_ID) {
        $add_enrollment_query = "INSERT INTO enrollment(STU_ID, ENRL_YEAR, CRS_ID) VALUES ($STU_ID, $ENRL_YEAR, $CRS_ID)";
        $add_class_query = "INSERT INTO class(STU_ID, ENRL_YEAR, CLASS_SEC, CLASS_LOC, CRS_ID, INSTR_ID, EMPL_YEAR) VALUES ($STU_ID, $ENRL_YEAR, '$CLASS_SEC', '$CLASS_LOCATION', $CRS_ID, $INSTR_ID, $EMPL_YEAR)";
        mysqli_query($conn, $add_enrollment_query);
        mysqli_query($conn, $add_class_query);
        // echo $add_enrollment_query . "<br><br><br>" . $add_class_query . "<br><hr>";
    }
} 
else {
    echo "Data fetch failed";
}

$conn -> close();
?>