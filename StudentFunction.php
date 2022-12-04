<?php
$conn = new mysqli("localhost:3310", "root", "mysql", "school");

// -> is similar to java's . for methods
if ($conn -> connect_error) {
    die("Connect Error (" . $conn -> connect_errno . ")" . $conn -> connect_error);
}

$STU_ID = substr($_POST["STU_ID"], 4);
$ENRL_YEAR = (int)substr($_POST["STU_ID"], 0, 4);
$userName = (int) $ENRL_YEAR . $STU_ID;

$CRS_IDs = $_POST['Courses'];
// Add course

if (isset($_POST['addCourse'])) {
    foreach ($CRS_IDs as $CRS_ID) {
        $CLASS_ID = (int)$CRS_ID + 1000;
        $add_enrollment_query = "INSERT INTO enrollment(STU_ID, ENRL_YEAR, CLASS_ID) VALUES ($STU_ID, $ENRL_YEAR, $CLASS_ID)";
        mysqli_query($conn, $add_enrollment_query);
        // echo $add_enrollment_query . "<br><br><br>";
        
    }
}



$conn -> close();
?>

<html>
<body>
    <form action="StudentHomepage.php" method="POST">
        <input type="hidden" name="userName" value="<?= $userName ?>">
        <input type="submit" value="Return">
    </form>
</body>
</html>