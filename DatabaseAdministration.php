<?php
    $conn = new mysqli("localhost:3310", "root", "0413", "school");
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
        <h1>School Enrollment System</h1>
            <fieldset>
			<legend>Students</legend>
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Enrollment Year</th>
                        <th>First Name</th>
                        <th>Middle Initial</th>
                        <th>Last Name</th>
                        <th>Birthday</th>
                        <th>Gender</th>
                        <th>Department ID</th>
						<th>Email</th>
						<th>Student Type</th>
						<th>Actions</th>
                    </tr>
					<?php
					while ($row=$result->fetch_assoc()) 
					{
					?>

                    <tr>
                        <td><?php echo $row['STU_ID'];?></td>
						<td><?php echo $row['ENRL_YEAR'];?></td>
                        <td><?php echo $row['STU_FNAME'];?></td>
						<td><?php echo $row['STU_MI'];?></td>
						<td><?php echo $row['STU_LNAME'];?></td>
                        <td><?php echo $row['STU_BDAY'];?></td>
                        <td><?php echo $row['STU_GENDER'];?></td>
                        <td><?php echo $row['DEPT_ID'];?></td>
                        <td><?php echo $row['STU_EMAIL'];?></td>
                        <td><?php echo $row['STU_TYPE'];?></td>								
                        <td>
                            <button onclick="openInfoForm()" class="updateinfo-btn">Update</button>
                        </td>
						</tr>
						<?php
					}
						?>

    </div>
</body>
</html>