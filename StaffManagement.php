<?php
$conn = new mysqli("localhost:3310", "root", "mysql", "school");
if ($conn->connect_error) {
    die("Connect Error (" . $conn->connect_Errorno . ") " . $conn->connect_error);
}
$sql = "SELECT * FROM school.student";
$result = $conn->query($sql);


$INSTR_ID = substr($_REQUEST["userName"], 4);
$EMPL_YEAR = substr($_REQUEST["userName"], 0, 4);

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
			WHERE i.INSTR_ID = $INSTR_ID AND i.EMPL_YEAR = $EMPL_YEAR;";

$info_query_result = $conn->query($info_query);
$info_query_row = $info_query_result->fetch_assoc();

$INSTR_FNAME = $info_query_row["INSTR_FNAME"];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <h1>System Dashboard</h1>
        <h1><?= $INSTR_FNAME ?>'s Profile</h1>
    </div>
</body>

</html>