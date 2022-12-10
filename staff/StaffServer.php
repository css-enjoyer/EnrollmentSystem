<?php
require_once(__DIR__ . '/./../config.php');
if (!isset($_SESSION)) {
    session_start();
}
// $INSTR_ID = $_SESSION['INSTR_ID'];

// initialize variable in case of duplication
$INSTR_EMAIL = "";
$errors = array();

$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

// ********** REGISTER INSTRUCTOR **********
if (isset($_POST['reg-instr'])) {
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

    if ($INSTR_PASSWORD_1 != $INSTR_PASSWORD_2) {
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

// ********** LOGIN INSTRUCTOR **********
if (isset($_POST['login-instr'])) {
    $INSTR_EMAIL = mysqli_real_escape_string($db, $_POST['INSTR_EMAIL']);
    $INSTR_PASSWORD = mysqli_real_escape_string($db, $_POST['INSTR_PASSWORD']);

    if (count($errors) == 0) {
        // $INSTR_PASSWORD = md5($INSTR_PASSWORD); // for encryption
        $query = "SELECT * FROM instructor WHERE INSTR_EMAIL='$INSTR_EMAIL' AND INSTR_PASSWORD='$INSTR_PASSWORD'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['INSTR_EMAIL'] = $INSTR_EMAIL;
            $_SESSION['success'] = "You are now logged in";
            header('location: StaffManagement.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}

// ********** UPDATE INSTRUCTOR INFO **********
if (isset($_POST['update-instr-info'])) {
    $INSTR_ID = $_SESSION['INSTR_ID'];
    $UPDATE_INSTR_ADDRESS = $_POST['UPDATE_INSTR_ADDRESS'];
    $UPDATE_INSTR_CONTACT = $_POST['UPDATE_INSTR_CONTACT'];

    // echo "<br />UPDATE";

    $origin = "SELECT * FROM school.instructor 
                WHERE INSTR_ID = $INSTR_ID";

    $result = $db->query($origin);
    $rows = $result->fetch_assoc();

    // Update instructor address and contact
    if ($UPDATE_INSTR_ADDRESS != $rows['INSTR_ADDRESS'] and $UPDATE_INSTR_CONTACT != $rows['INSTR_CONTACT']) {
        // Update table
        $sql = "UPDATE school.instructor
            SET 
                INSTR_ADDRESS = '$UPDATE_INSTR_ADDRESS',
                INSTR_CONTACT = '$UPDATE_INSTR_CONTACT'
            WHERE 
                INSTR_ID = $INSTR_ID";

        // checker
        if (mysqli_query($db, $sql)) {
            echo "Data stored into database successfully...";
        } else {
            echo mysqli_error($db);
        }
    }

    $_SESSION['message'] = "Address and contact updated!";
    header('location: StaffManagement.php');
}

// ********** ADD STUDENT TO INSTRUCTOR's COURSE **********
if (isset($_POST['add-stu-to-instr-course'])) {
    $INSTR_ID = $_SESSION['INSTR_ID'];
    // if instr has multiple courses assign a random course to stu
    $CRS_NUM_RESULTS = mysqli_query($db, "SELECT CRS_ID FROM course WHERE INSTR_ID = '$INSTR_ID'");
    if (mysqli_num_rows($CRS_NUM_RESULTS) == 0) {
        $_SESSION['message'] = "You don't have a course yet! Ask the admin to add you to one.";
        header('location: StaffManagement.php');
    } elseif (mysqli_num_rows($CRS_NUM_RESULTS) > 1) {
        $CRS_ID_RESULT = mysqli_query($db, "SELECT CRS_ID FROM course WHERE INSTR_ID = '$INSTR_ID' ORDER BY RAND() LIMIT 1;");
        $CRS_ID_ROW = mysqli_fetch_assoc($CRS_ID_RESULT);
        $CRS_ID = $CRS_ID_ROW['CRS_ID'];
    } else {
        // echo "BEFORE";
        $CRS_ID_RESULT = mysqli_query($db, "SELECT CRS_ID FROM course WHERE INSTR_ID = '$INSTR_ID';");
        $CRS_ID_ROW = mysqli_fetch_assoc($CRS_ID_RESULT);
        $CRS_ID = $CRS_ID_ROW['CRS_ID'];
        // echo "AFTER" . $CRS_ID;
    }

    $STU_IDs = $_POST['Students'];
    foreach ($STU_IDs as $STU_ID) {
        $add_enrollment_query = "INSERT INTO school.enrollment (STU_ID, CRS_ID) VALUES ($STU_ID, $CRS_ID);";
        mysqli_query($db, $add_enrollment_query);
        // echo $add_enrollment_query . "<br><br><br>";
    }
    $_SESSION['message'] = "Students enrolled!";
    header('location: StaffManagement.php');
}

// *********** DELETE STUDENT FROM INSTRUCTOR'S COURSE **********
if (isset($_POST['drop-handled-stu'])) {
    $ENRL_ID = $_POST['drop-handled-stu'];
    // echo $ENRL_ID;
    $del_enrollment_query = "DELETE FROM school.enrollment WHERE ENRL_ID = $ENRL_ID";
    mysqli_query($db, $del_enrollment_query);
    $_SESSION['message'] = "Student dropped!";
    header('location: StaffManagement.php');
}
