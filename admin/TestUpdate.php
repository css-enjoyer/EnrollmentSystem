<?php

require ('./../config.php');
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}

// RETRIEVING ID
$INSTR_ID = $_REQUEST['INSTR_ID'];
$INSTR_PW = "pw";


// INSTRUCTOR //


// Delete
if (isset($_REQUEST['removeInstr'])) {
    echo "<h1>Delete</h1>";

    $sql = "DELETE FROM school.instructor WHERE INSTR_ID = $INSTR_ID";

    // CHECKER
    if (mysqli_query($conn, $sql)) {
        echo "Data record ($INSTR_ID) deleted successfully...";
    }
    else {
        echo mysqli_error($conn);
    }
}
elseif (isset($_REQUEST['addInstr'])) {
    echo "<h1>Add</h1>";

    $sql = "INSERT INTO school.instructor 
                (INSTR_FNAME, INSTR_MI, INSTR_LNAME, INSTR_GENDER, INSTR_BDAY, INSTR_PASSWORD,
                 INSTR_ADDRESS, INSTR_CONTACT, INSTR_EMAIL)
                VALUES
                    ('$INSTR_FNAME', '$INSTR_MI', '$INSTR_LNAME', '$INSTR_GENDER', '$INSTR_BDAY',, '$INSTR_PASSWORD',
                     '$INSTR_ADDRESS', '$INSTR_CONTACT', '$INSTR_EMAIL',)";

    // Checks whether or not input was successfully placed into database.
    if (mysqli_query($conn, $sql)) {
        echo "Data stored into database successfully...";
    }
    else {
        echo mysqli_error($conn);
    }
}

// CLOSING CONNECTION
$conn->close();

?>

<html>
    <body>
        <h3>I am a temporary page.</h3>
    </body>
</html>