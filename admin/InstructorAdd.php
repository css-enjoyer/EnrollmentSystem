<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Instructor</title>
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
        <h1>Adding an Instructor</h1>
        <form action="AdminFunctionality.php" method="POST">
            <fieldset>
                <legend>Enter Instructor Information: </legend>
                <label>First Name: <input type="text" name="INSTR_FNAME" required></label>
                <label>Middle Initial: <input type="text" name="INSTR_MI" required></label>
                <label>Last Name: <input type="text" name="INSTR_LNAME" required></label>
                <label>Gender: 
                    <select name="INSTR_GENDER" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </label>
                <label>Date of Birth: <input type="date" name="INSTR_BDAY" required></label>
                <label>Address: <input type="text" name="INSTR_ADDRESS" required></label>
                <label>Email: <input type="email" name="INSTR_EMAIL" required></label>
                <label>Contact: <input type="number" name="INSTR_CONTACT" required></label>
            </fieldset>
            <input type="submit" name="addInstr" value="Proceed &#8594" class="btn">
        </form>
    </div>
</html>