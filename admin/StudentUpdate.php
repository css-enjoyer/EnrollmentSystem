<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
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
        <h1>Updating Student Information</h1>
        <form action="AdminFunctionality.php" method="POST">
            <fieldset>
                <legend>Update Student Information: </legend>
                <label>First Name: <input type="text" name="STU_FNAME"></label>
                <label>Middle Initial: <input type="text" name="STU_MI"></label>
                <label>Last Name: <input type="text" name="STU_LNAME"></label>
                <label>Gender: 
                    <select name="STU_GENDER">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </label>
                <label>Date of Birth: <input type="date" name="STU_BDAY"></label>
                <label>Address: <input type="text" name="STU_ADDRESS"></label>
                <label>Personal Email: <input type="email" name="STU_EMAIL"></label>
                <label>Contact: <input type="number" name="STU_CONTACT"></label>
                <label>Student Type: 
                    <select name="STU_TYPE">
                        <option value="N/A">N/A</option>
                        <option value="Regular">Regular</option>
                        <option value="Irregular">Irregular</option>
                    </select>
                </label>
            </fieldset>
            <input type="hidden" name="STU_ID" value="<?= $_REQUEST['STU_ID'] ?>" >
            <input type="submit" name="updateStu" value="Proceed &#8594" class="btn">
        </form>
    </div>
</html>