<?php
    $conn = new mysqli("localhost:3310", "root", "0413", "school");
    if($conn -> connect_error) {
        die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
    }
    $sql = "SELECT * FROM school.course";
    $result = $conn -> query($sql);
    $conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign up</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    </head>
    <script>
    function showDiv(select) {
        if(select.value == "CS") {
            document.getElementById('CS-Tracks').style.display = "block";
            document.getElementById('IS-Tracks').style.display = "none";
            document.getElementById('IT-Tracks').style.display = "none";
        } else if(select.value == "IS") {
            document.getElementById('CS-Tracks').style.display = "none";
            document.getElementById('IS-Tracks').style.display = "block";
            document.getElementById('IT-Tracks').style.display = "none";
        } else if(select.value == "IT") {
            document.getElementById('CS-Tracks').style.display = "none";
            document.getElementById('IS-Tracks').style.display = "none";
            document.getElementById('IT-Tracks').style.display = "block";
        } else if(select.value == "None") {
            document.getElementById('CS-Tracks').style.display = "none";
            document.getElementById('IS-Tracks').style.display = "none";
            document.getElementById('IT-Tracks').style.display = "none";
        }
    } 
    </script>
    <body>
        <div class="navsection">
            <div class="logo-container">
                <img src="images/ustseal.png" width="50px">
            </div>
        </div>
        <div class="mainsection">
            <form action="CreateAccount.php">
                <fieldset>
                    <legend>Enter your personal information: </legend>
                    <label>First Name: <input type="text" name="FNAME" required></label>
                    <label>Middle Initial: <input type="text" name="MI" required></label>
                    <label>Last Name: <input type="text" name="LNAME" required></label>
                    <label>Gender: <select name="GENDER" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select></label>
                    <label>Date of Birth: <input type="date" name="BDAY" required></label>
                </fieldset>
                <fieldset>
                    <legend>Choose a department: </legend>
                    <label>Department of: <select name="DEPT_ID" onchange="showDiv(this)">
                        <option value="None">--Choose--</option>
                        <option id="CS" value="CS">Computer Science</option>
                        <option id="IT" value="IT">Information Technology</option>
                        <option id="IS" value="IS">Information Systems</option>
                    </select></label>
                </fieldset>
                <fieldset>
                    <legend>Choose a specialization track: </legend>
                    <div id="CS-Tracks">
                        <label>Specialize in: <select name="SPEC_ID">
                            <option value="1">Core Computer Science</option>
                            <option value="2">Game Development</option>
                            <option value="3">Data Science</option>
                        </select></label>
                    </div>
                    <div id="IS-Tracks">
                        <label>Specialize in: <select name="SPEC_ID">
                            <option value="1">Business Analytics</option>
                            <option value="2">Service Management</option>
                        </select></label>
                    </div>
                    <div id="IT-Tracks">
                        <label>Specialize in: <select name="SPEC_ID">
                            <option value="1">Network and Security</option>
                            <option value="2">Web and Mobile App Development</option>
                            <option value="3">IT Automation</option>
                        </select></label>
                    </div>
                    
                </fieldset>
                
            </form>
        </div>
    </body>
</html>
