<?php
require ('./../config.php');
$conn = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);

if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}


// QUERIES FOR DATA RETRIEVAL//


$stu_sql = "SELECT * FROM school.student";
$instr_sql = "SELECT * FROM school.instructor";
$crs_sql = "SELECT * FROM school.course";
$enrl_sql = "SELECT * FROM school.enrollment";


// ROW INIT
$stu_sql_result = $conn->query($stu_sql);
$stu_sql_row = $stu_sql_result->fetch_assoc();

$instr_sql_result = $conn->query($instr_sql);
$instr_sql_row = $instr_sql_result->fetch_assoc();

$crs_sql_result = $conn->query($crs_sql);
$crs_sql_row = $crs_sql_result->fetch_assoc();

$enrl_sql_result = $conn->query($enrl_sql);
$enrl_sql_row = $enrl_sql_result->fetch_assoc();

// CLOSING CONNECTION
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="navsection">
        <div class="logo-container">
            <img src="./../images/ustseal.png" width="50px">
        </div>
        <ul>
            <li>Notifications</li>
            <li>Messages</li>
            <li><a href="./../Landing.php">Logout</a></li>
        </ul>
    </div>
    
    <!-- STAFF TABLE -->
    <div class="mainsection">
        <h1>Database Overview</h1>
        <br>
        <p class="staff-notif">Click cells to update record</p>
        <br>
        <fieldset>
            <legend>Authorized Staff Accounts</legend>
            <table class="staff-table">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Initial</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Email</th>
                </tr>

                <?php while ($instr_sql_row = $instr_sql_result->fetch_assoc()) {            ?>
                    <tr>
                        <td><?php echo $instr_sql_row['INSTR_ID']; ?></td>
                        <td><?php echo $instr_sql_row['INSTR_FNAME']; ?></td>
                        <td><?php echo $instr_sql_row['INSTR_MI']; ?></td>
                        <td><?php echo $instr_sql_row['INSTR_LNAME']; ?></td>
                        <td><?php echo $instr_sql_row['INSTR_GENDER']; ?></td>
                        <td><?php echo $instr_sql_row['INSTR_BDAY']; ?></td>
                        <td><?php echo $instr_sql_row['INSTR_ADDRESS']; ?></td>
                        <td><?php echo $instr_sql_row['INSTR_CONTACT']; ?></td>
                        <td><?php echo $instr_sql_row['INSTR_EMAIL']; ?></td>
                        <!-- UPDATE: BUTTON NOT FUNCTIONAL -->
                        <td><button action="" class="removecrs-btn">Fire Professor?</button></td>
                    </tr>
                <?php   }                                               ?>
            </table>
            <button class="enrollcrs-btn">Authorize New Staff +</button>
        </fieldset>
        
        <!-- STUDENT TABLE -->
        <fieldset>
            <legend>Enrolled Students</legend>
            <table class="staff-table">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Initial</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                    <th>Student Type</th>
                    <th>Email</th>
                </tr>
                
                <?php while ($stu_sql_row = $stu_sql_result->fetch_assoc()) {            ?>
                    <tr>
                        <td><?php echo $stu_sql_row['STU_ID']; ?></td>
                        <td><?php echo $stu_sql_row['STU_FNAME']; ?></td>
                        <td><?php echo $stu_sql_row['STU_MI']; ?></td>
                        <td><?php echo $stu_sql_row['STU_LNAME']; ?></td>
                        <td><?php echo $stu_sql_row['STU_GENDER']; ?></td>
                        <td><?php echo $stu_sql_row['STU_BDAY']; ?></td>
                        <td><?php echo $stu_sql_row['STU_ADDRESS']; ?></td>
                        <td><?php echo $stu_sql_row['STU_CONTACT']; ?></td>
                        <td><?php echo $stu_sql_row['STU_EMAIL']; ?></td>
                        <td><?php echo $stu_sql_row['STU_TYPE']; ?></td>
                        <!-- TODO: BUTTON NOT FUNCTIONAL -->
                        <td><button action="" class="removecrs-btn">Drop Student</button></td>
                    </tr>
                <?php   }                                               ?>
            </table>
            <!-- TODO: BUTTON NOT FUNCTIONAL -->
            <button class="enrollcrs-btn">Enroll New Student +</button>
        </fieldset>

        <!-- COURSES TABLE -->
        <fieldset>
            <legend>Available Courses</legend>
            <table class="staff-table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Units</th>
                    <th>Instructor ID</th>
                    <th>Actions</th>
                </tr>
                <?php while ($crs_sql_row = $crs_sql_result->fetch_assoc()) {            ?>
                    <tr>
                        <td><?php echo $crs_sql_row['CRS_ID']; ?></td>
                        <td><?php echo $crs_sql_row['CRS_NAME']; ?></td>
                        <td><?php echo $crs_sql_row['CRS_UNIT']; ?></td>
                        <td><?php echo $crs_sql_row['INSTR_ID']; ?></td>
                        <!-- TODO: BUTTON NOT FUNCTIONAL -->
                        <td><button action="" class="removecrs-btn">Delete Course Entry</button></td>
                    </tr>
                <?php   }                                               ?>
            </table>

            <button class="enrollcrs-btn">Add New Course +</button>
        </fieldset>

        <!-- ENROLLMENT TABLE -->
        <fieldset>
            <legend>Current Enrollments</legend>
            <table class="staff-table">
                <tr>
                    <th>Enrollment ID</th>
                    <th>Student ID</th>
                    <th>Course ID</th>
                </tr>
                <?php while ($enrl_sql_row = $enrl_sql_result->fetch_assoc()) {            ?>
                    <tr>
                        <td><?php echo $enrl_sql_row['ENRL_ID']; ?></td>
                        <td><?php echo $enrl_sql_row['STU_ID']; ?></td>
                        <td><?php echo $enrl_sql_row['CRS_ID']; ?></td>
                        <!-- TODO: BUTTON NOT FUNCTIONAL -->
                        <td><button action="" class="removecrs-btn">Delete Enrollment</button></td>
                    </tr>
                <?php   }                                               ?>
            </table>

            <button class="enrollcrs-btn">Enroll Student +</button>
        </fieldset>

    </div>
</body>

</html>