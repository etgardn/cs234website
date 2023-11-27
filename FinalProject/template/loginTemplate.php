<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Assignment</title>
</head>
<body>

    <form action="include/connect.php" method="POST">
    <fieldset>
        <p><h1>If you do not have an account please register</h1></p>
        <p>
            <label for ="username">Username:</label>
            <input type = "text" name ="username" id = "username" placeholder="Username" required >
        </p>
        <p>
            <label for ="password">Password:</label>
            <input type = "password" name ="password" id = "password" placeholder="Password" required>
        </p>
        <p>
            <input type = "submit" value = "Login">
        </p>
    </form>
    
    <form action = "template/registerTemplate.php" method = "POST">
        <input type = "submit" value = "Register">
    </form>

</body>
</html>