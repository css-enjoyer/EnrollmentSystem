<?php
    $conn = new mysqli("localhost:3306", "root", "mysql123", "school");

    if($conn -> connect_error) {
        die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
    }
    $sql = "SELECT * FROM school.student";
    $result = $conn -> query($sql);
    $conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="navsection">
            <div class="logo-container">
                <img src="images/ustseal.png" width="50px">
            </div>
            <ul>
                <li>Notifications</li>
                <li>Messages</li>
                <li><a href="Landing.html">Logout</a></li>
            </ul>
        </div>
        <div class="mainsection">
            <h1>Database Overview</h1>
            <br>
            <p class="staff-notif">Click cells to update record</p>
            <br>
            <fieldset>
                <legend>Authorized Staff Accounts</legend>
                <table class="staff-table">
                    <tr>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                    <!-- Update this section to print staff information from table with php -->
                    <tr>
                        <td>
                            <button title="Update this record">1</button>
                        </td>
                        <td>
                            <button title="Update this record">Francis Alarcon</button>
                        </td>
                        <td>
                            <button title="Update this record">alarcon@ust.edu.ph</button>
                        </td>
                        <td>
                            <button title="Update this record">CS</button>
                        </td>
                        <td>
                            <button title="Update this record">04/12/2022</button>
                        </td>
                        <td>
                            <button title="Update this record">Male</button>
                        </td>
                        <td><button action="" class="removecrs-btn">Fire Professor?</button></td>
                    </tr>
                    <!--  -->
                    </tr>        
                </table>
                <button class="enrollcrs-btn">Authorize New Staff +</button>
            </fieldset>

            <fieldset>
            <legend>Enrolled Students</legend>
                <table class="staff-table">
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Student Department</th>
                        <th>Student Type</th>
                        <th>Actions</th>
                    </tr>
                    <!-- Update button to delete course from student courses -->
                    <!-- Update this section to print enrolled students with php -->
                    <tr>
                        <td>
                            <button title="Update this record">1</button>
                        </td>
                        <td>
                            <button title="Update this record">Liliam Pumpernickle</button>
                        </td>
                        <td>
                            <button title="Update this record">YE</button>
                        </td>
                        <td>
                            <button title="Update this record">Irregular</button>
                        </td>
                        <td><button action="" class="removecrs-btn">Drop Student</button></td>
                    </tr>
                    <!--  -->
                </table>
                <button class="enrollcrs-btn">Enroll New Student +</button>
            </fieldset>

            <fieldset>
            <legend>Available Courses</legend>
                <table class="staff-table">
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Course Description</th>
                        <th>Course Level</th>
                        <th>Course Units</th>
                        <th>Actions</th>
                    </tr>
                    <!-- Update this section to display courses -->
                    <tr>
                        <td>
                            <button title="Update this record">1</button>
                        </td>
                        <td>
                            <button title="Update this record">ICS2602</button>
                        </td>
                        <td>
                            <button title="Update this record">Computer Programming 1</button>
                        </td>
                        <td>
                            <button title="Update this record">1</button>
                        </td>
                        <td>
                            <button title="Update this record">5</button>
                        </td>
                        <td><button action="" class="removecrs-btn">Delete Course Entry</button></td>
                    </tr>
                    <!--  -->
                </table>
                <button class="enrollcrs-btn">Add New Course +</button>
            </fieldset>
        </div>
    </body>
</html>