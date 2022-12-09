<?php

require ('./../config.php');
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}

// RETRIEVING IDs
$INSTR_ID = $_REQUEST['INSTR_ID'];
$STU_ID = $_REQUEST['STU_ID'];
$CRS_ID = $_REQUEST['CRS_ID'];
$ENRL_ID = $_REQUEST['ENRL_ID'];


// INSTRUCTOR FUNCTIONALITIES // 


// Delete (Instructor)
if (isset($_REQUEST['removeInstr'])) {
    echo "<h1>Remove Instructor</h1>";

    $sql = "DELETE FROM school.instructor WHERE INSTR_ID = $INSTR_ID";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record ($INSTR_ID) deleted successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}
// Add (Instructor)
elseif (isset($_REQUEST['addInstr'])) {
    echo "<h1>Add Instructor</h1>";

    // INSTR INIT
    $INSTR_FNAME = $_REQUEST['INSTR_FNAME'];
    $INSTR_MI = $_REQUEST['INSTR_MI'];
    $INSTR_LNAME = $_REQUEST['INSTR_LNAME'];
    $INSTR_GENDER = $_REQUEST['INSTR_GENDER'];
    $INSTR_BDAY = $_REQUEST['INSTR_BDAY'];
    $INSTR_PASSWORD = "pw";
    $INSTR_ADDRESS = $_REQUEST['INSTR_ADDRESS'];
    $INSTR_CONTACT = $_REQUEST['INSTR_CONTACT'];
    $INSTR_EMAIL = $_REQUEST['INSTR_EMAIL'];

    $sql = "INSERT INTO school.instructor 
                (INSTR_FNAME, INSTR_MI, INSTR_LNAME, INSTR_GENDER, INSTR_BDAY, INSTR_PASSWORD,
                 INSTR_ADDRESS, INSTR_CONTACT, INSTR_EMAIL)
            VALUES
                ('$INSTR_FNAME', '$INSTR_MI', '$INSTR_LNAME', '$INSTR_GENDER', '$INSTR_BDAY', '$INSTR_PASSWORD',
                 '$INSTR_ADDRESS', '$INSTR_CONTACT', '$INSTR_EMAIL')";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record stored successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}


// STUDENT FUNCTIONALITIES //


// Delete (Student)
if (isset($_REQUEST['removeStu'])) {
    echo "<h1>Remove Student</h1>";

    $sql = "DELETE FROM school.student WHERE STU_ID = $STU_ID";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record ($STU_ID) deleted successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}
// Add (Student)
elseif (isset($_REQUEST['addStu'])) {
    echo "<h1>Add Student</h1>";

    // STU INIT
    $STU_FNAME = $_REQUEST['STU_FNAME'];
    $STU_MI = $_REQUEST['STU_MI'];
    $STU_LNAME = $_REQUEST['STU_LNAME'];
    $STU_GENDER = $_REQUEST['STU_GENDER'];
    $STU_BDAY = $_REQUEST['STU_BDAY'];
    $STU_PASSWORD = "pw";
    $STU_ADDRESS = $_REQUEST['STU_ADDRESS'];
    $STU_CONTACT = $_REQUEST['STU_CONTACT'];
    $STU_EMAIL = $_REQUEST['STU_EMAIL'];

    $sql = "INSERT INTO school.student 
                (STU_FNAME, STU_MI, STU_LNAME, STU_GENDER, STU_BDAY, STU_PASSWORD,
                 STU_ADDRESS, STU_CONTACT, STU_EMAIL)
            VALUES
                ('$STU_FNAME', '$STU_MI', '$STU_LNAME', '$STU_GENDER', '$STU_BDAY', '$STU_PASSWORD',
                 '$STU_ADDRESS', '$STU_CONTACT', '$STU_EMAIL')";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record stored successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}


// COURSE FUNCTIONALITIES //


// Delete (Course)
if (isset($_REQUEST['removeCrs'])) {
    echo "<h1>Remove Course</h1>";

    $sql = "DELETE FROM school.course WHERE CRS_ID = $CRS_ID";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record ($CRS_ID) deleted successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}
// Add (Course)
elseif (isset($_REQUEST['addCrs'])) {
    echo "<h1>Add Course</h1>";

    // INSTRUCTOR //
    $CRS_NAME = $_REQUEST['CRS_NAME'];
    $CRS_UNIT = $_REQUEST['CRS_UNIT'];
    $INSTR_ID = $_REQUEST['INSTR_ID'];

    $sql = "INSERT INTO school.course 
                (CRS_NAME, CRS_UNIT, INSTR_ID)
            VALUES
                ('$CRS_NAME', $CRS_UNIT, $INSTR_ID)";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record stored successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}


// ENROLLMENT FUNCTIONALITIES //


// Delete (Enrollment)
if (isset($_REQUEST['removeEnrl'])) {
    echo "<h1>Remove Enrollment</h1>";
    
    $sql = "DELETE FROM school.enrollment WHERE ENRL_ID = $ENRL_ID";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record ($ENRL_ID) deleted successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}
// Add (Enrollment)
elseif (isset($_REQUEST['addEnrl'])) {
    echo "<h1>Add Course</h1>";

    // INSTRUCTOR //
    $STU_ID = $_REQUEST['STU_ID'];
    $CRS_ID = $_REQUEST['CRS_ID'];

    $sql = "INSERT INTO school.enrollment 
                (STU_ID, CRS_ID)
            VALUES
                ('$STU_ID', $CRS_ID)";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record stored successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}

// CLOSING CONNECTION
$conn->close();

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record</title>
    <link rel="stylesheet" href="./../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="mainsection">
        <h3>I am a temporary page.</h3>

        <form action="DatabaseAdministration.php">
            <button class="enrollcrs-btn">Return to Admin Page</button>
        </form>
    </div>
</body>
</html>