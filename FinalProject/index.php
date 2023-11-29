<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Assignment</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
</head>
<body>

    <form action="connect.php" method="POST" class="w3-container w3-card-4 w3-light-grey w3-margin">
        <h1 class="w3-text-blue">Login</h1>

        <label for="username">Username:</label>
        <input class="w3-input" type="text" name="username" id="username" placeholder="Username" required>

        <label for="password">Password:</label>
        <input class="w3-input" type="password" name="password" id="password" placeholder="Password" required>

        <button class="w3-button w3-blue w3-margin-top" type="submit">Login</button>

        <p>If you do not have an account, please <a href="registerTemplate.php">register</a></p>
    </form>

</body>
</html>
