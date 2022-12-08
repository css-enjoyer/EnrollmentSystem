<?php
require('./../config.php');
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_Errorno . ') ' . $conn->connect_error);
}

$sql = "SELECT * FROM school.student";
$result = $conn->query($sql);

$STU_ID = substr($_POST["STU_ID"], 4);
$ENRL_YEAR = (int)substr($_POST["STU_ID"], 0, 4);
$userName = (int) $ENRL_YEAR . $STU_ID;


// CHECK
if (isset($_POST['UPDATE-STU'])) {
    // $STU_ID = $_REQUEST['stuID'];
    // $ENRL_YEAR = $_REQUEST['enrlYear'];
    $STU_FNAME = $_REQUEST['FNAME'];
    $STU_MI = $_REQUEST['MI'];
    $STU_LNAME = $_REQUEST['LNAME'];
    $STU_GENDER = $_REQUEST['GENDER'];
    $STU_BDAY = $_REQUEST['BDAY'];

    echo "<br />UPDATE";

    $origin = "SELECT * FROM school.student 
                WHERE STU_ID = $STU_ID AND ENRL_YEAR = '$ENRL_YEAR'";

    $result = $conn->query($origin);
    $rows = $result->fetch_assoc();

    // Update fname
    if ($STU_FNAME != "" and $STU_FNAME != $rows['STU_FNAME']) {
        $STU_FNAME = $STU_FNAME;
    } else {
        $STU_FNAME = $rows['STU_FNAME'];
    }

    // Update mi
    if ($STU_MI != "" and $STU_MI != $rows['STU_MI']) {
        $STU_MI = $STU_MI;
    } else {
        $STU_MI = $rows['STU_MI'];
    }

    // Update lname
    if ($STU_LNAME != "" and $STU_LNAME != $rows['STU_LNAME']) {
        $STU_LNAME = $STU_LNAME;
    } else {
        $STU_LNAME = $rows['STU_LNAME'];
    }

    // Update gender
    if ($STU_GENDER != "" and $STU_GENDER != $rows['STU_GENDER']) {
        $STU_GENDER = $STU_GENDER;
    } else {
        $STU_GENDER = $rows['STU_GENDER'];
    }

    // Update birthday
    if ($STU_BDAY != "" and $STU_BDAY != $rows['STU_BDAY']) {
        $STU_BDAY = $STU_BDAY;
    } else {
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
    } else {
        echo mysqli_error($conn);
    }
}


// Add course

if (isset($_POST['addCourse'])) {
    $CRS_IDs = $_POST['Courses'];
    foreach ($CRS_IDs as $CRS_ID) {
        $CLASS_ID = (int)$CRS_ID + 1000;
        $add_enrollment_query = "INSERT INTO enrollment(STU_ID, ENRL_YEAR, CLASS_ID) VALUES ($STU_ID, $ENRL_YEAR, $CLASS_ID)";
        mysqli_query($conn, $add_enrollment_query);
        // echo $add_enrollment_query . "<br><br><br>";

    }
}

// Delete course
// DELETE FROM `school`.`ENROLLMENT` WHERE (`ENRL_ID` = '10014');
if (isset($_POST['deleteCourse'])) {
    echo $_POST['deleteCourse'];
}

$conn->close();

?>

<html>

<body>
    <form action="StudentHomepage.php" method="POST">
        <h1>Success!</h1>
        <input type="hidden" name="userName" value="<?= $userName ?>">
        <input type="submit" value="Return">
    </form>
</body>

</html>