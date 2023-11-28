<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Assignment - Register</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body>

    <div class="w3-display-middle">
        <form action="createAccount.php" method="post" class="w3-card-4 w3-light-grey w3-margin">
            <h1 class="w3-text-teal">Register</h1>

            <label for="firstName">First Name:</label>
            <input class="w3-input" type="text" name="firstName" id="firstName" placeholder="First Name" required>

            <label for="lastName">Last Name:</label>
            <input class="w3-input" type="text" name="lastName" id="lastName" placeholder="Last Name" required>

            <label for="username">Username:</label>
            <input class="w3-input" type="text" name="username" id="username" placeholder="Username" required>

            <label for="password">Password:</label>
            <input class="w3-input" type="password" name="password" id="password" placeholder="Password" required>

            <label for="email">Email:</label>
            <input class="w3-input" type="text" name="email" id="email" placeholder="Email" required>

            <button class="w3-button w3-teal w3-margin-top" type="submit">Register</button>
        </form>
    </div>

</body>
</html>

