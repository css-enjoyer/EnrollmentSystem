<?php
// require('./../config.php');
require_once('StudentServer.php');
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
        <h1>Your journey starts here!</h1>
        <form action="StudentAccountCreation.php" method="POST">
            <?php include('StudentErrors.php'); ?>
            <fieldset>
                <legend>Enter your personal information: </legend>
                <label>Personal Email: <input type="email" name="STU_EMAIL" required></label>
                <label>First Name: <input type="text" name="STU_FNAME" required></label>
                <label>Middle Initial: <input type="text" name="STU_MI" required></label>
                <label>Last Name: <input type="text" name="STU_LNAME" required></label>
                <label>Gender: <select name="STU_GENDER" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select></label>
                <label>Date of Birth: <input type="date" name="STU_BDAY" required></label>
                <label>Address: <input type="text" name="STU_ADDRESS" required></label>
                <label>Contact: <input type="text" name="STU_CONTACT" required maxlength="11"></label>
            </fieldset>
            <!-- <fieldset>
                <legend>Choose a department: </legend>
                <label>Department of: <select type="number" name="DEPT_ID" onchange="showDiv(this)" required>
                        <option value="">--Choose--</option>
                        <option id="CS" value="1">Computer Science</option>
                        <option id="IT" value="2">Information Technology</option>
                        <option id="IS" value="3">Information Systems</option>
                    </select></label>
            </fieldset>
            <fieldset>
                <legend>Choose a specialization track: </legend>
                <div id="CS-Tracks">
                    <label>Specialize in: <select type="number" name="SPEC_ID">
                            <option value="50">Core Computer Science</option>
                            <option value="51">Game Development</option>
                            <option value="52">Data Science</option>
                        </select></label>
                </div>
                <div id="IS-Tracks">
                    <label>Specialize in: <select type="number" name="SPEC_ID">
                            <option value="53">Business Analytics</option>
                            <option value="54">Service Management</option>
                        </select></label>
                </div>
                <div id="IT-Tracks">
                    <label>Specialize in: <select type="number" name="SPEC_ID">
                            <option value="55">Network and Security</option>
                            <option value="56">Web and Mobile App Development</option>
                            <option value="57">IT Automation</option>
                        </select></label>
                </div>
            </fieldset> -->
            <fieldset>
                <legend>Enter your desired password:</legend>
                <label>Password: <input type="password" name="STU_PASSWORD_1" required></label>
                <label>Confirm Password: <input type="password" name="STU_PASSWORD_2" required></label>
            </fieldset>
            <input type="submit" value="Proceed &#8594" class="btn" name="reg_stu">
        </form>
    </div>
</body>

</html>