<?php
require_once('/./../config.php');
session_start();
// $INSTR_ID = $_SESSION['INSTR_ID'];

// initialize variable in case of duplication
$INSTR_EMAIL = "";
$errors = array();

$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

// ********** REGISTER STUDENT **********
if (isset($_POST['reg_instr'])) {
    // Receive all inputs from form
    $INSTR_EMAIL = mysqli_real_escape_string($db, $_POST['INSTR_EMAIL']);
    $INSTR_FNAME = mysqli_real_escape_string($db, $_POST['INSTR_FNAME']);
    $INSTR_MI = mysqli_real_escape_string($db, $_POST['INSTR_MI']);
    $INSTR_LNAME = mysqli_real_escape_string($db, $_POST['INSTR_LNAME']);
    $INSTR_GENDER = mysqli_real_escape_string($db, $_POST['INSTR_GENDER']);
    $INSTR_BDAY = mysqli_real_escape_string($db, $_POST['INSTR_BDAY']);
    $INSTR_ADDRESS = mysqli_real_escape_string($db, $_POST['INSTR_ADDRESS']);
    $INSTR_CONTACT = mysqli_real_escape_string($db, $_POST['INSTR_CONTACT']);
    $INSTR_PASSWORD_1 = mysqli_real_escape_string($db, $_POST['INSTR_PASSWORD_1']);
    $INSTR_PASSWORD_2 = mysqli_real_escape_string($db, $_POST['INSTR_PASSWORD_2']);

    if ($instr_PASSWORD_1 != $instr_PASSWORD_2) {
        array_push($errors, "The two passwords do not match");
    }

    // Check if instructor email already exists
    $instr_email_check_query = "SELECT * FROM instructor WHERE INSTR_EMAIL ='$INSTR_EMAIL' LIMIT 1";
    $result = mysqli_query($db, $instr_email_check_query);
    $instr_email = mysqli_fetch_assoc($result);

    if ($instr_email) {
        if ($instr_email['INSTR_EMAIL'] === $INSTR_EMAIL) {
            array_push($errors, "Instructor email already exists");
        }
    }

    // Finally, register instructor if there are no errors in the form
    if (count($errors) == 0) {
        // $INSTR_PASSWORD_1 = md5($INSTR_PASSWORD_1); // encrypt the password before saving in the database (optional)

        $query = "INSERT INTO 
        instructor (INSTR_FNAME, INSTR_MI, INSTR_LNAME, INSTR_GENDER, INSTR_BDAY, INSTR_PASSWORD,
                 INSTR_ADDRESS, INSTR_CONTACT, INSTR_EMAIL) VALUES ('$INSTR_FNAME', '$INSTR_MI', '$INSTR_LNAME', '$INSTR_GENDER', '$INSTR_BDAY', '$INSTR_PASSWORD_1',
                 '$INSTR_ADDRESS', '$INSTR_CONTACT', '$INSTR_EMAIL');";
        mysqli_query($db, $query);
        // Unique key passed to the session used to determine id
        $_SESSION['INSTR_EMAIL'] = $INSTR_EMAIL;
        $_SESSION['success'] = "You are now logged in";
        header('location: StaffManagement.php');
    }
}