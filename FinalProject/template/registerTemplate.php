

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Assignment</title>
</head>
<body>
    <form action= "../include/createAccount.php" method="post">
    <fieldset>
        <p>
            <label for ="firstName">First Name:</label>
            <input type = "text" name ="firstName" id = "firstName" placeholder="First Name" required>
        </p>
        <p>
            <label for ="lastName">Last Name:</label>
            <input type = "text" name ="lastName" id = "lastName" placeholder="Last Name" required>
        </p>
        <p>
            <label for ="username">Username:</label>
            <input type = "text" name ="username" id = "username" placeholder="Username" required>
        </p>
        <p>
            <label for ="password">Password:</label>
            <input type = "password" name ="password" id = "password" placeholder="Password" required>
        </p>
        <p>
            <label for ="email">Email:</label>
            <input type = "text" name ="email" id = "email" placeholder="Email" required>
        </p>
        <p>
            <input type = "submit" value = "Register">
        </p>

    </form>
</body>
</html>