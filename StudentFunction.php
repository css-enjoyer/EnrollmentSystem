<?php
// Port, UName, Password, Database
$conn = new mysqli("localhost:3306",
                   "root",
                   "mysql123",
                   "school");

if ($conn->connect_error) {
    die('Connect Error ('.$conn -> connect_errno.') '.$conn->connect_error);
}

$sql = "SELECT * FROM school.student";
$result = $conn -> query($sql);

$STU_ID = $_REQUEST['stuID'];
$ENRL_YEAR = $_REQUEST['enrlYear'];
$STU_FNAME = $_REQUEST['FNAME'];
$STU_MI = $_REQUEST['MI'];
$STU_LNAME = $_REQUEST['LNAME'];
$STU_GENDER = $_REQUEST['GENDER'];
$STU_BDAY = $_REQUEST['BDAY'];

echo $ENRL_YEAR . $STU_ID;
echo $STU_FNAME;
echo $STU_MI;
echo $STU_LNAME;
echo $STU_GENDER;
echo $STU_BDAY;

// CHECK
if (isset($_POST['UPDATE-STU'])) {
    echo "<br />UPDATE";

    $origin = "SELECT * FROM school.student 
                WHERE STU_ID = $STU_ID AND ENRL_YEAR = '$ENRL_YEAR'";

    $result = $conn->query($origin);
    $rows = $result->fetch_assoc();

    // Update fname
    if ($STU_FNAME != "" and $STU_FNAME != $rows['STU_FNAME']) {
        $STU_FNAME = $STU_FNAME;
    }
    else {
        $STU_FNAME = $rows['STU_FNAME'];
    }

    // Update mi
    if ($STU_MI != "" and $STU_MI != $rows['STU_MI']) {
        $STU_MI = $STU_MI;
    }
    else {
        $STU_MI = $rows['STU_MI'];
    }

    // Update lname
    if ($STU_LNAME != "" and $STU_LNAME != $rows['STU_LNAME']) {
        $STU_LNAME = $STU_LNAME;
    }
    else {
        $STU_LNAME = $rows['STU_LNAME'];
    }

    // Update gender
    if ($STU_GENDER != "" and $STU_GENDER != $rows['STU_GENDER']) {
        $STU_GENDER = $STU_GENDER;
    }
    else {
        $STU_GENDER = $rows['STU_GENDER'];
    }

    // Update birthday
    if ($STU_BDAY != "" and $STU_BDAY != $rows['STU_BDAY']) {
        $STU_BDAY = $STU_BDAY;
    }
    else {
        $STU_BDAY = $rows['STU_BDAY'];
    }

    // Update table
    $sql = "UPDATE 
                school.student
            SET 
                STU_FNAME = '$STU_FNAME',
                STU_MI = '$STU_MI',
                STU_LNAME = '$STU_LNAME',
                STU_GENDER = '$STU_GENDER',
                STU_BDAY = '$STU_BDAY'
            WHERE 
                STU_ID = $STU_ID AND ENRL_YEAR = $ENRL_YEAR";

    // checker
    if (mysqli_query($conn, $sql)) {
        echo "Data stored into database successfully...";
    }
    else {
        echo mysqli_error($conn);
    }
}

$conn->close();

?>