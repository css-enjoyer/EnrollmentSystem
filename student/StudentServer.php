<?php
require_once('./../config.php');
session_start();

// initialize variable in case of duplication
$STU_EMAIL = "";
$errors = array();

$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

// ---------- REGISTER STUDENT ----------
if (isset($_POST['reg_stu'])) {
    // Receive all inputs from form
    $STU_EMAIL = mysqli_real_escape_string($db, $_POST['STU_EMAIL']);
    $STU_FNAME = mysqli_real_escape_string($db, $_POST['STU_FNAME']);
    $STU_MI = mysqli_real_escape_string($db, $_POST['STU_MI']);
    $STU_LNAME = mysqli_real_escape_string($db, $_POST['STU_LNAME']);
    $STU_GENDER = mysqli_real_escape_string($db, $_POST['STU_GENDER']);
    $STU_BDAY = mysqli_real_escape_string($db, $_POST['STU_BDAY']);
    $STU_ADDRESS = mysqli_real_escape_string($db, $_POST['STU_ADDRESS']);
    $STU_CONTACT = mysqli_real_escape_string($db, $_POST['STU_CONTACT']);
    $STU_PASSWORD_1 = mysqli_real_escape_string($db, $_POST['STU_PASSWORD_1']);
    $STU_PASSWORD_2 = mysqli_real_escape_string($db, $_POST['STU_PASSWORD_2']);

    if ($STU_PASSWORD_1 != $STU_PASSWORD_2) {
        array_push($errors, "The two passwords do not match");
    }

    // Check if student email already exists
    $stu_email_check_query = "SELECT * FROM student WHERE STU_EMAIL ='$STU_EMAIL' LIMIT 1";
    $result = mysqli_query($db, $stu_email_check_query);
    $stu_email = mysqli_fetch_assoc($result);

    if ($stu_email) {
        if ($stu_email['STU_EMAIL'] === $STU_EMAIL) {
            array_push($errors, "Student email already exists");
        }
    }

    // Finally, register student if there are no errors in the form
    if (count($errors) == 0) {
        // $STU_PASSWORD_1 = md5($STU_PASSWORD_1); // encrypt the password before saving in the database (optional)

        $query = "INSERT INTO 
        student (STU_FNAME, STU_MI, STU_LNAME, STU_GENDER, STU_BDAY, STU_PASSWORD,
                 STU_ADDRESS, STU_CONTACT, STU_EMAIL) VALUES ('$STU_FNAME', '$STU_MI', '$STU_LNAME', '$STU_GENDER', '$STU_BDAY', '$STU_PASSWORD_1',
                 '$STU_ADDRESS', '$STU_CONTACT', '$STU_EMAIL');";
        mysqli_query($db, $query);
        // Unique key passed to the session used to determine id
        $_SESSION['STU_EMAIL'] = $STU_EMAIL;
        $_SESSION['success'] = "You are now logged in";
        header('location: StudentHomepage.php');
    }
}

// ----------- LOGIN STUDENT ----------
if (isset($_POST['login_stu'])) {
    $STU_EMAIL = mysqli_real_escape_string($db, $_POST['STU_EMAIL']);
    $STU_PASSWORD = mysqli_real_escape_string($db, $_POST['STU_PASSWORD']);

    if (count($errors) == 0) {
        // $STU_PASSWORD = md5($STU_PASSWORD); // for encryption
        $query = "SELECT * FROM student WHERE STU_EMAIL='$STU_EMAIL' AND STU_PASSWORD='$STU_PASSWORD'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['STU_EMAIL'] = $STU_EMAIL;
            $_SESSION['success'] = "You are now logged in";
            header('location: StudentHomepage.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
