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


// ADD (INSTRUCTOR)
if (isset($_REQUEST['addInstr'])) {
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
// UPDATE (INSTRUCTOR)
elseif (isset($_POST['updateInstr'])) {
    echo "<h1>Update Instructor</h1>";

    // INSTR INIT
    $INSTR_FNAME = $_REQUEST['INSTR_FNAME'];
    $INSTR_MI = $_REQUEST['INSTR_MI'];
    $INSTR_LNAME = $_REQUEST['INSTR_LNAME'];
    $INSTR_GENDER = $_REQUEST['INSTR_GENDER'];
    $INSTR_BDAY = $_REQUEST['INSTR_BDAY'];
    $INSTR_ADDRESS = $_REQUEST['INSTR_ADDRESS'];
    $INSTR_CONTACT = $_REQUEST['INSTR_CONTACT'];
    $INSTR_EMAIL = $_REQUEST['INSTR_EMAIL'];

    $origin = "SELECT * FROM school.instructor WHERE INSTR_ID = $INSTR_ID";
    $result = $conn -> query($origin);      // requests record
    $rows = $result -> fetch_assoc();       // retrieves record
    
    // VERIFYING NAME
    if ($INSTR_FNAME != "" and $INSTR_FNAME != $rows['INSTR_FNAME']) {        // FNAME
        $INSTR_FNAME = $INSTR_FNAME;
    }
    else {
        $INSTR_FNAME = $rows['INSTR_FNAME'];
    }
    
    if ($INSTR_MI != "" and $INSTR_MI != $rows['INSTR_MI']) {                 // MI
        $INSTR_MI = $INSTR_MI;
    }
    else {
        $INSTR_MI = $rows['INSTR_MI'];
    }

    if ($INSTR_LNAME != "" and $INSTR_LNAME != $rows['INSTR_LNAME']) {        // LNAME
        $INSTR_LNAME = $INSTR_LNAME;
    }
    else {
        $INSTR_LNAME = $rows['INSTR_LNAME'];
    }

    // VERIFYING DETAILS
    if ($INSTR_GENDER != "" and $INSTR_GENDER != $rows['INSTR_GENDER']) {      // GENDER
        $INSTR_GENDER = $INSTR_GENDER;
    }
    else {
        $INSTR_GENDER = $rows['INSTR_GENDER'];
    }

    if ($INSTR_BDAY != "" and $INSTR_BDAY != $rows['INSTR_BDAY']) {              // BIRTHDAY
        $INSTR_BDAY = $INSTR_BDAY;
    }
    else {
        $INSTR_BDAY = $rows['INSTR_BDAY'];
    }

    if ($INSTR_ADDRESS != "" and $INSTR_ADDRESS != $rows['INSTR_ADDRESS']) {     // ADDRESS
        $INSTR_ADDRESS = $INSTR_ADDRESS;
    }
    else {
        $INSTR_ADDRESS = $rows['INSTR_ADDRESS'];
    }

    if ($INSTR_CONTACT != "" and $INSTR_CONTACT != $rows['INSTR_CONTACT']) {    // CONTACT
        $INSTR_CONTACT = $INSTR_CONTACT;
    }
    else {
        $INSTR_CONTACT = $rows['INSTR_CONTACT'];
    }

    if ($INSTR_EMAIL != "" and $INSTR_EMAIL != $rows['INSTR_EMAIL']) {         // EMAIL
        $INSTR_EMAIL = $INSTR_EMAIL;
    }
    else {
        $INSTR_EMAIL = $rows['INSTR_EMAIL'];
    }

    $sql = "UPDATE 
                school.instructor 
            SET 
                INSTR_FNAME = '$INSTR_FNAME',
                INSTR_MI = '$INSTR_MI',
                INSTR_LNAME = '$INSTR_LNAME',
                INSTR_GENDER = '$INSTR_GENDER',
                INSTR_BDAY = '$INSTR_BDAY',
                INSTR_ADDRESS = '$INSTR_ADDRESS',
                INSTR_CONTACT = '$INSTR_CONTACT',
                INSTR_EMAIL = '$INSTR_EMAIL'
            WHERE 
                INSTR_ID = $INSTR_ID";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record ($INSTR_ID) updated successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}
// DELETE (INSTRUCTOR)
elseif (isset($_REQUEST['removeInstr'])) {
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


// STUDENT FUNCTIONALITIES //


// ADD (STUDENT)
if (isset($_REQUEST['addStu'])) {
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
// UPDATE (STUDENT)
elseif (isset($_POST['updateStu'])) {
    echo "<h1>Update Student</h1>";

    // STU INIT
    $STU_FNAME = $_REQUEST['STU_FNAME'];
    $STU_MI = $_REQUEST['STU_MI'];
    $STU_LNAME = $_REQUEST['STU_LNAME'];
    $STU_GENDER = $_REQUEST['STU_GENDER'];
    $STU_BDAY = $_REQUEST['STU_BDAY'];
    $STU_ADDRESS = $_REQUEST['STU_ADDRESS'];
    $STU_CONTACT = $_REQUEST['STU_CONTACT'];
    $STU_TYPE = $_REQUEST['STU_TYPE'];
    $STU_EMAIL = $_REQUEST['STU_EMAIL'];

    $origin = "SELECT * FROM school.student WHERE STU_ID = $STU_ID";
    $result = $conn -> query($origin);      // requests record
    $rows = $result -> fetch_assoc();       // retrieves record
    
    // VERIFYING NAME
    if ($STU_FNAME != "" and $STU_FNAME != $rows['STU_FNAME']) {        // FNAME
        $STU_FNAME = $STU_FNAME;
    }
    else {
        $STU_FNAME = $rows['STU_FNAME'];
    }
    
    if ($STU_MI != "" and $STU_MI != $rows['STU_MI']) {                 // MI
        $STU_MI = $STU_MI;
    }
    else {
        $STU_MI = $rows['STU_MI'];
    }

    if ($STU_LNAME != "" and $STU_LNAME != $rows['STU_LNAME']) {        // LNAME
        $STU_LNAME = $STU_LNAME;
    }
    else {
        $STU_LNAME = $rows['STU_LNAME'];
    }

    // VERIFYING DETAILS
    if ($STU_GENDER != "" and $STU_GENDER != $rows['STU_GENDER']) {      // GENDER
        $STU_GENDER = $STU_GENDER;
    }
    else {
        $STU_GENDER = $rows['STU_GENDER'];
    }

    if ($STU_BDAY != "" and $STU_BDAY != $rows['STU_BDAY']) {              // BIRTHDAY
        $STU_BDAY = $STU_BDAY;
    }
    else {
        $STU_BDAY = $rows['STU_BDAY'];
    }

    if ($STU_ADDRESS != "" and $STU_ADDRESS != $rows['STU_ADDRESS']) {     // ADDRESS
        $STU_ADDRESS = $STU_ADDRESS;
    }
    else {
        $STU_ADDRESS = $rows['STU_ADDRESS'];
    }

    if ($STU_CONTACT != "" and $STU_CONTACT != $rows['STU_CONTACT']) {    // CONTACT
        $STU_CONTACT = $STU_CONTACT;
    }
    else {
        $STU_CONTACT = $rows['STU_CONTACT'];
    }

    if ($STU_TYPE != "" and $STU_TYPE != $rows['STU_TYPE']) {    // TYPE
        $STU_TYPE = $STU_TYPE;
    }
    else {
        $STU_TYPE = $rows['STU_TYPE'];
    }

    if ($STU_EMAIL != "" and $STU_EMAIL != $rows['STU_EMAIL']) {         // EMAIL
        $STU_EMAIL = $STU_EMAIL;
    }
    else {
        $STU_EMAIL = $rows['STU_EMAIL'];
    }

    $sql = "UPDATE 
                school.student 
            SET 
                STU_FNAME = '$STU_FNAME',
                STU_MI = '$STU_MI',
                STU_LNAME = '$STU_LNAME',
                STU_GENDER = '$STU_GENDER',
                STU_BDAY = '$STU_BDAY',
                STU_ADDRESS = '$STU_ADDRESS',
                STU_CONTACT = '$STU_CONTACT',
                STU_TYPE = '$STU_TYPE',
                STU_EMAIL = '$STU_EMAIL'
            WHERE 
                STU_ID = $STU_ID";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record ($STU_ID) updated successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}
// DELETE (STUDENT)
elseif (isset($_REQUEST['removeStu'])) {
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


// COURSE FUNCTIONALITIES //


// ADD (COURSE)
if (isset($_REQUEST['addCrs'])) {
    echo "<h1>Add Course</h1>";

    // COURSE INIT //
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
// UPDATE (COURSE)
elseif (isset($_POST['updateCrs'])) {
    echo "<h1>Update Course</h1>";

    // COURSE INIT //
    $CRS_NAME = $_REQUEST['CRS_NAME'];
    $CRS_UNIT = $_REQUEST['CRS_UNIT'];
    $INSTR_ID = $_REQUEST['INSTR_ID'];

    $origin = "SELECT * FROM school.course WHERE CRS_ID = $CRS_ID";
    $result = $conn -> query($origin);      // requests record
    $rows = $result -> fetch_assoc();       // retrieves record
    
    // VERIFYING COURSE DETAILS
    if ($CRS_NAME != "" and $CRS_NAME != $rows['CRS_NAME']) {        // COURSE NAME
        $CRS_NAME = $CRS_NAME;
    }
    else {
        $CRS_NAME = $rows['CRS_NAME'];
    }
    
    if ($CRS_UNIT != "" and $CRS_UNIT != $rows['CRS_UNIT']) {        // COURSE UNIT
        $CRS_UNIT = $CRS_UNIT;
    }
    else {
        $CRS_UNIT = $rows['CRS_UNIT'];
    }

    // VERIFYING INSTRUCTOR ID
    if ($INSTR_ID != "" and $INSTR_ID != $rows['INSTR_ID']) {        // INSTRUCTOR ID
        $INSTR_ID = $INSTR_ID;
    }
    else {
        $INSTR_ID = $rows['INSTR_ID'];
    }

    $sql = "UPDATE 
                school.course 
            SET 
                CRS_NAME = '$CRS_NAME',
                CRS_UNIT = $CRS_UNIT,
                INSTR_ID = $INSTR_ID
            WHERE 
                CRS_ID = $CRS_ID";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record ($CRS_ID) updated successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}
// DELETE (COURSE)
elseif (isset($_REQUEST['removeCrs'])) {
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


// ENROLLMENT FUNCTIONALITIES //


// ADD (ENROLLMENT)
if (isset($_REQUEST['addEnrl'])) {
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
// UPDATE (ENROLLMENT)
elseif (isset($_POST['updateEnrl'])) {
    echo "<h1>Update Enrollment</h1>";

    // COURSE INIT //
    $STU_ID = $_REQUEST['STU_ID'];
    $CRS_ID = $_REQUEST['CRS_ID'];

    $origin = "SELECT * FROM school.enrollment WHERE ENRL_ID = $ENRL_ID";
    $result = $conn -> query($origin);      // requests record
    $rows = $result -> fetch_assoc();       // retrieves record
    
    // VERIFYING ENROLLMENT DETAILS
    if ($STU_ID != "" and $STU_ID != $rows['STU_ID']) {        // COURSE NAME
        $STU_ID = $STU_ID;
    }
    else {
        $STU_ID = $rows['STU_ID'];
    }
    
    if ($CRS_ID != "" and $CRS_ID != $rows['CRS_ID']) {        // COURSE UNIT
        $CRS_ID = $CRS_ID;
    }
    else {
        $CRS_ID = $rows['CRS_ID'];
    }

    $sql = "UPDATE 
                school.enrollment 
            SET 
                STU_ID = $STU_ID,
                CRS_ID = $CRS_ID
            WHERE 
                ENRL_ID = $ENRL_ID";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "<h3 style='color: white';>Data record ($ENRL_ID) updated successfully...</h3>";
    }
    else {
        echo "<h3 style='color: white;'>" . mysqli_error($conn) . "</h3>";
    }
}
// DELETE (ENROLLMENT)
elseif (isset($_REQUEST['removeEnrl'])) {
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
        <form action="DatabaseAdministration.php">
            <button class="enrollcrs-btn">Return to Admin Page</button>
        </form>
    </div>
</body>
</html>