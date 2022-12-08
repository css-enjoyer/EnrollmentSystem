<?php
// require_once('./student/StudentServer.php');
// require ('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
</head>
<script>
    function openStudentForm() {
        document.getElementById("stuform").style.display = "flex";
    }

    function closeStudentForm() {
        document.getElementById("stuform").style.display = "none";
    }

    function openStaffForm() {
        document.getElementById("stafform").style.display = "flex";
    }

    function closeStaffForm() {
        document.getElementById("stafform").style.display = "none";
    }
</script>

<body>
    <div class="navsection">
        <div class="logo-container">
            <img src="images/ustseal.png" width="50px">
        </div>
        <ul>
            <li>Notifications</li>
            <li>Messages</li>
            <li><button onclick="openStudentForm()" class="loginbtn">Student Login</button></li>
            <li><button onclick="openStaffForm()" class="loginbtn">Staff Login</button></li>
        </ul>
    </div>
    <div class="mainsection">
        <!-- this should show errors -->
        <?php $errors = array();
        include('student/StudentErrors.php'); ?>
        <a href="student/StudentAccountCreation.php" class="enroll-btn">Enroll_Now</a>
        <p class="staffcrt-btn">Staff member? Click <a href="staff/StaffAccountCreation.php">here</a> for the staff portal.</p>

        <form method="POST" name="myForm" id="stuform" class="loginform">
            <h2>Student Login</h2>
            <?php // $errors = array("error lul"); include('student/StudentErrors.php'); 
            ?>
            <label>Student Email: <input type="text" id="userName" name="STU_EMAIL" required></label>
            <label>Password: <input type="password" id="passWord" name="STU_PASSWORD" required></label>
            <div class="formBtns">
                <button onClick="closeStudentForm()">Cancel</button>
                <input formaction="student/StudentHomepage.php" type="submit" name="login_stu">
            </div>
        </form>

        <form method="POST" name="myForm" id="stafform" class="loginform">
            <h2>Staff Login</h2>
            <label>Username: <input type="text" id="userName" name="userName" required></label>
            <label>Password: <input type="password" id="passWord" name="passWord" required></label>
            <div class="formBtns">
                <button onClick="closeStaffForm()">Cancel</button>
                <input formaction="staff/StaffManagement.php" type="submit">
            </div>
        </form>

    </div>
</body>

</html>