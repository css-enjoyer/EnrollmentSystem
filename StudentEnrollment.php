<?php
$conn = new mysqli("localhost:3310", "root", "0413", "schoolenrollment");
if($conn -> connect_error) {
    die ("Connect Error (".$conn->connect_Errorno.") ".$conn->connect_error);
}
$sql = "SELECT * FROM schoolenrollment.Courses";
$result = $conn -> query($sql);
$conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Your journey starts here!</h1>
    <form action="Enroll.php" method="POST">
        <fieldset>
        <legend>Student Information</legend>
            <label>First Name: <input type="text" name="FNAME"></label>
            <label>Middle Initial: <input type="text" name="MI"></label>
            <label>Last Name: <input type="text" name="LNAME"></label>
            <label>Age: <input type="text"></label>
            <label>Date of Birth: <input type="date"></label>
            <label>Gender: <select>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select></label>
        </fieldset>

        <fieldset>
        <legend>Department Selection</legend>
            <label>Department of: <select>
                <option value="cs">Computer Science</option>
                <option value="it">Information Technology</option>
                <option value="is">Information Systems</option>
            </select></label>
        </fieldset>

        <fieldset>
        <legend>Available Courses</legend>
            <!-- <label><input name="Courses[]" type="checkbox" value=""> ICS2607 (Class B) - Information Management</label>
            <label><input name="Courses[]" type="checkbox" value=""> ICS2608 (Class A) - Applications Development and Emerging Technologies (Web-Front-End)</label>
            <label><input name="Courses[]" type="checkbox" value=""> CS2614 (Class C) - College Calculus for Computing Sciences</label>
            <label><input name="Courses[]" type="checkbox" value=""> CS2615 (Class C) - Design and Analysis of Algorithms</label>
            <label><input name="Courses[]" type="checkbox" value=""> CS2616 (Class A) - Theory of Automata</label>
            <label><input name="Courses[]" type="checkbox" value=""> THY3 (Class A) - Christian Vision of the Church Society</label>
            <label><input name="Courses[]" type="checkbox" value=""> PATH_FIT (Class E) - Fitness Exercises for Specific Sports</label>
            <label><input name="Courses[]" type="checkbox" value=""> GE_ELECII (Class D) - Elective II</label> -->
            <table>
                <tr>
                    <th>+</th>
                    <th>Course ID</th>
                    <th>Course Description</th>
                    <th>Course Instructor</th>
                    <th>Course Class</th>
                    <th>Course Units</th>
                </tr>
                
        <?php   while($row=$result->fetch_assoc()) {            ?>
                <tr>
                    <td><input name="Courses[]" type="checkbox" value="<?php $row["CRS_ID"]?>"></td>
                    <td><?php echo $row["CRS_ID"];?></td>
                    <td><?php echo $row["CRS_DESC"];?></td>
                    <td><?php echo $row["CRS_INSTR"];?></td>
                    <td><?php echo $row["CRS_CLASS"];?></td>
                    <td><?php echo $row["CRS_UNITS"];?></td>
                </tr>        
        <?php   }                                               ?>
                
            </table>
        </fieldset>
        <input type="submit" value="Proceed" />
    </form>

</body>
</html>