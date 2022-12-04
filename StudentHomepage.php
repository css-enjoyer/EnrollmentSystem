<?php
// Connecting to mySQL
$conn = new mysqli("localhost:3310", "root", "mysql", "school");
if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}
$STU_ID = substr($_REQUEST["userName"], 4);
$ENRL_YEAR = substr($_REQUEST["userName"], 0, 4);

// Select from school.course table
$sql = "SELECT * FROM school.course";
$result = $conn->query($sql);

// Select from student table where $STU_ID and ENROL_YEAR = $ENRL_YEAR
$student_info_query = "SELECT * FROM student WHERE STU_ID = $STU_ID AND ENRL_YEAR = $ENRL_YEAR;";
$student_info_result = $conn->query($student_info_query);
$student_info_row = $student_info_result->fetch_assoc();

// Variable Instantiation
$STU_EMAIL = $student_info_row["STU_EMAIL"];
$STU_FNAME = $student_info_row["STU_FNAME"];
$STU_MI = $student_info_row["STU_MI"];
$STU_LNAME = $student_info_row["STU_LNAME"];
$STU_GENDER = $student_info_row["STU_GENDER"];
$STU_BDAY = $student_info_row["STU_BDAY"];
$DEPT_ID = $student_info_row["DEPT_ID"];
$SPEC_ID = $student_info_row["SPEC_ID"];

// Select from student information from student table (INNER JOIN)
$info_query = "SELECT * FROM student AS s
	INNER JOIN enrollment AS e
		ON s.STU_ID = e.STU_ID AND s.ENRL_YEAR = e.ENRL_YEAR
	INNER JOIN class AS c
		ON e.CLASS_ID = c.CLASS_ID
	INNER JOIN course AS co
		ON c.CRS_ID = co.CRS_ID
	INNER JOIN instructor AS i
		ON c.INSTR_ID = i.INSTR_ID
    INNER JOIN department AS d
		ON s.DEPT_ID = d.DEPT_ID
	INNER JOIN specialization AS sp
		ON s.SPEC_ID = sp.SPEC_ID
			WHERE s.STU_ID = $STU_ID AND e.ENRL_YEAR = $ENRL_YEAR;";

$info_query_result = $conn->query($info_query);
// $info_query_row = $info_query_result->fetch_assoc();

// Close the Database Connection
$conn->close();
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Metadata , dimension and scaling -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment</title>
	<!-- Link to external style sheet -->
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
</head>
<script>
	// consol.log
    console.log("========== LOG ==========")
    console.log(<?php echo $ENRL_YEAR . " " . $STU_ID ?>);

	// Functions to open/closeInforForm() and open/closeEnrollForm()
    function openInfoForm() {
        document.getElementById("updateinfoform").style.display = "flex";
    }

    function closeInfoForm() {
        document.getElementById("updateinfoform").style.display = "none";
    }

    function openEnrollForm() {
        document.getElementById("enrollform").style.display = "flex";
    }

    function closeEnrollForm() {
        document.getElementById("enrollform").style.display = "none";
    }
</script>

<body>
	<!-- Navigation section -->
    <div class="navsection">
        <div class="logo-container">
			<!-- Embedded the image ustseal.png -->
            <img src="images/ustseal.png" width="50px">
        </div>
        <ul>
            <li>Notifications</li>
            <li>Messages</li>
			<!-- Logout -->
            <li><a href="Landing.html">Logout</a></li>
        </ul>
    </div>
    <div class="mainsection">
		<!-- [Student Name]'s Profile -->
        <h1><?= $STU_FNAME ?>'s Profile</h1>
        <fieldset>
            <table>
				<!-- Prints the table column attributes -->
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Specialization</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
                <!-- Prints the student information from table -->
                <tr>
                    <td><?= $ENRL_YEAR . $STU_ID ?></td>
                    <td><?= $STU_FNAME . " " . $STU_LNAME ?></td>
                    <td><?= $STU_EMAIL ?></td>
                    <td><?= $DEPT_ID ?></td>
                    <td><?= $SPEC_ID ?></td>
                    <td><?= $STU_BDAY ?></td>
                    <td><?= $STU_GENDER ?></td>
                    <td>
						<!-- Update button | openInfoForm() function -->
                        <button onclick="openInfoForm()" class="updateinfo-btn">Update</button>
                    </td>
                    <!--  -->
                </tr>
            </table>
        </fieldset>

        <fieldset>
			<!-- Enrollment Courses -->
            <legend>Enrolled Courses</legend>
            <table>
				<!-- Prints the table column attributes -->
                <tr>
                    <th>Course Name</th>
                    <th>Course Description</th>
                    <th>Course Level</th>
                    <th>Course Department</th>
                    <th>Class Section</th>
                    <th>Course Units</th>
                    <th>Class Instructor</th>
                    <th>Actions</th>
                </tr>
                
                <?php while ($info_query_row = $info_query_result->fetch_assoc()) {            ?>
					<!-- Prints the course information from table -->
                    <tr>
                        <td><?php echo $info_query_row["CRS_NAME"]; ?></td>
                        <td><?php echo $info_query_row["CRS_DESC"]; ?></td>
                        <td><?php echo $info_query_row["CRS_LEVEL"]; ?></td>
                        <td><?php echo $info_query_row["DEPT_ID"]; ?></td>
                        <td><?php echo $info_query_row["CLASS_SECTION"]; ?></td>
                        <td><?php echo $info_query_row["CRS_UNIT"]; ?></td>
                        <td><?php echo $info_query_row["INSTR_FNAME"]; ?></td>
                        <td><button action="" class="removecrs-btn">Drop</button></td>
                    </tr>
                <?php   }                                               ?>
                
            </table>
			<!-- Enroll New Course + button | openEnrollForm() function -->
            <button onclick="openEnrollForm()" class="enrollcrs-btn">Enroll New Course +</button>
        </fieldset>


        <!-- Enroll Course Form Popup [Add form action to update student enrolled courses] -->
        <form action="" method="POST" id="enrollform">
            <fieldset>
                <legend>Available Courses</legend>
                <table>
					<!-- Prints the column attributes -->
                    <tr>
                        <th>+</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Level</th>
                        <th>Units</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) {            ?>
						<!-- Prints the course information from table -->
                        <tr>
                            <td><input name="Courses[]" type="checkbox" value="<?php $row["CRS_ID"] ?>"></td>
                            <td><?php echo $row["CRS_ID"]; ?></td>
                            <td><?php echo $row["CRS_NAME"]; ?></td>
                            <td><?php echo $row["CRS_DESC"]; ?></td>
                            <td><?php echo $row["CRS_LEVEL"]; ?></td>
                            <td><?php echo $row["CRS_UNIT"]; ?></td>
                        </tr>
                    <?php   }                                               ?>
                </table>
                <div class="formBtns">
					<!-- Close button | closeEnrollForm() function -->
                    <button onclick="closeEnrollForm()" class="enrollcrs-btn cancel">Close</button>
					<!-- Enroll + -->
                    <input type="submit" value="Enroll +" class="enrollcrs-btn" formaction="">
                </div>
            </fieldset>
        </form>

        <!-- Update Info Form Popup [Add form action to update student information]-->
        <form action="" method="POST" name="myForm" id="updateinfoform">
            <fieldset>
                <legend>Enter your personal information: </legend>
				<!-- Name -->
                <label>First Name: <input type="text" name="FNAME" required></label>
                <label>Middle Initial: <input type="text" name="MI" required></label>
                <label>Last Name: <input type="text" name="LNAME" required></label>
				<!-- Gender -->
                <label>Gender: <select name="GENDER" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select></label>
				<!-- Date of Birth -->
                <label>Date of Birth: <input type="date" name="BDAY" required></label>
                <div class="formBtns">
					<!-- Close button | openInfoForm() function -->
                    <button onclick="closeInfoForm()" class="update-btn cancel">Close</button>
					<!-- Update -->
                    <input type="submit" value="Update" class="update-btn" formaction="">
                </div>
            </fieldset>
        </form>

    </div>
</body>

</html>