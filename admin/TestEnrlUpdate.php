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
                <legend>Enter Enrollment Information: </legend>
                <label>Student ID: <input type="number" name="STU_ID" required></label>
                <label>Course ID: <input type="number" name="CRS_ID" required></label>
            </fieldset>
            <input type="submit" name="addEnrl" value="Proceed &#8594" class="btn">
        </form>
    </div>
</html>