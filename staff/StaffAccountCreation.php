<?php
require('./../config.php');
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}
$sql = "SELECT * FROM school.course";
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="./../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
</head>
<!-- <script>
    function showDiv(select) {
        if (select.value == "1") {
            document.getElementById('CS-Tracks').style.display = "block";
            document.getElementById('IS-Tracks').style.display = "none";
            document.getElementById('IT-Tracks').style.display = "none";
        } else if (select.value == "2") {
            document.getElementById('CS-Tracks').style.display = "none";
            document.getElementById('IS-Tracks').style.display = "block";
            document.getElementById('IT-Tracks').style.display = "none";
        } else if (select.value == "3") {
            document.getElementById('CS-Tracks').style.display = "none";
            document.getElementById('IS-Tracks').style.display = "none";
            document.getElementById('IT-Tracks').style.display = "block";
        } else if (select.value == "") {
            document.getElementById('CS-Tracks').style.display = "none";
            document.getElementById('IS-Tracks').style.display = "none";
            document.getElementById('IT-Tracks').style.display = "none";
        }
    }
</script> -->

<body>
    <div class="navsection">
        <div class="logo-container">
            <img src="./../images/ustseal.png" width="50px">
        </div>
    </div>
    <div class="mainsection">
        <h1>Join the thomasian team!</h1>
        <form action="StaffServer.php" method="POST">
            <?php include('StaffErrors.php'); ?>
            <fieldset>
                <legend>Enter your personal information: </legend>
                <label>Personal Email: <input type="email" name="INSTR_EMAIL" required></label>
                <label>First Name: <input type="text" name="INSTR_FNAME" required></label>
                <label>Middle Initial: <input type="text" name="INSTR_MI" required></label>
                <label>Last Name: <input type="text" name="INSTR_LNAME" required></label>
                <label>Gender: <select name="INSTR_GENDER" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select></label>
                <label>Date of Birth: <input type="date" name="INSTR_BDAY" required></label>
                <label>Address: <input type="text" name="INSTR_ADDRESS" required></label>
                <label>Contact: <input type="text" name="INSTR_CONTACT" required maxlength="11"></label>
            </fieldset>
            <!-- <fieldset>
                <legend>Select your assigned department: </legend>
                <label>Department of: <select type="number" name="DEPT_ID" onchange="showDiv(this)" required>
                        <option value="">--Choose--</option>
                        <option id="CS" value="1">Computer Science</option>
                        <option id="IT" value="2">Information Technology</option>
                        <option id="IS" value="3">Information Systems</option>
                    </select></label>
            </fieldset> -->
            <fieldset>
                <legend>Enter your desired password:</legend>
                <label>Password: <input type="password" name="INSTR_PASSWORD_1" required></label>
                <label>Confirm Password: <input type="password" name="INSTR_PASSWORD_2" required></label>
            </fieldset>
            <!-- whut para san to haha design? -->
            <p class="staff-notif">After registration, kindly wait for our system administrators to validate your account.</p>
            <input type="submit" value="Proceed &#8594" class="btn" name="reg-instr">
        </form>
    </div>
</body>

</html>