<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Enrollment</title>
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
        <h1>Update an Enrollment</h1>
        <form action="AdminFunctionality.php" method="POST">
            <fieldset>
                <legend>Update Enrollment Information: </legend>
                <label>Student ID: <input type="number" name="STU_ID"></label>
                <label>Course ID: <input type="number" name="CRS_ID"></label>
            </fieldset>
            <input type="hidden" name="ENRL_ID" value="<?= $_REQUEST['ENRL_ID'] ?>" >
            <input type="submit" name="updateEnrl" value="Proceed &#8594" class="btn">
        </form>
    </div>
</html>