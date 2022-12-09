<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Record</title>
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
    </div>
    <div class="mainsection">
        <h1>Welcome, World Ender.</h1>
        <form action="TestFunctionality.php" method="POST">
            <fieldset>
                <legend>Enter Student Information: </legend>
                <label>First Name: <input type="text" name="STU_FNAME" required></label>
                <label>Middle Initial: <input type="text" name="STU_MI" required></label>
                <label>Last Name: <input type="text" name="STU_LNAME" required></label>
                <label>Gender: 
                    <select name="STU_GENDER" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </label>
                <label>Date of Birth: <input type="date" name="STU_BDAY" required></label>
                <label>Address: <input type="text" name="STU_ADDRESS" required></label>
                <label>Personal Email: <input type="email" name="STU_EMAIL" required></label>
                <label>Contact: <input type="number" name="STU_CONTACT" required></label>
            </fieldset>
            <input type="submit" name="addStu" value="Proceed &#8594" class="btn">
        </form>
    </div>
</html>