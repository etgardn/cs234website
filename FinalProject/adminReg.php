<?php
session_start();
if ($_SESSION['status'] != 'valid')
{
    header("Location: index.php");
    exit();
}

$dsn = "mysql:host=localhost;dbname=project";
$username = "root";
$db_password = "root";

$pdo = new PDO($dsn, $username, $db_password);

function executeQuery($query, $params)
{
    global $pdo;
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedDatabase = "project";
    $selectedTable = "registration";
    $selectedOperation = $_POST["operation"];

    if ($selectedOperation == "add") {
        echo '<form action="createAccount.php" method="post" class="w3-card-4 w3-light-grey w3-margin">';
        echo '<h1 class="w3-text-blue">Register</h1>';

        echo '<label for="firstName">First Name:</label>';
        echo '<input class="w3-input" type="text" name="firstName" id="firstName" placeholder="First Name" required>';

        echo    '<label for="lastName">Last Name:</label>';
        echo   '<input class="w3-input" type="text" name="lastName" id="lastName" placeholder="Last Name" required>';

        echo    '<label for="username">Username:</label>';
        echo    '<input class="w3-input" type="text" name="username" id="username" placeholder="Username" required>';

        echo    '<label for="password">Password:</label>';
        echo    '<input class="w3-input" type="password" name="password" id="password" placeholder="Password" required>';

        echo    '<label for="email">Email:</label>';
        echo    '<input class="w3-input" type="text" name="email" id="email" placeholder="Email" required>';

        echo    '<button class="w3-button w3-blue w3-margin-top" type="submit">Register</button>';
        echo   '</form>';
    } elseif ($selectedOperation == "delete") {
    
            echo '<form action="" method="post">';
            echo '<label for="username">Enter the email you would like to delete</label>';
            echo '<input type="text" name="username" required>';
            echo '<input type="submit" value="Submit">';
            echo '</form>';
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $sql = "SELECT id FROM registration WHERE username = ?";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute([$username]);
                
                $id = $result[0];
    
                $sql = "DELETE FROM registration WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$id]);
    
            }
        } elseif ($selectedOperation == "view") {
        $sql = "SELECT * FROM registration";
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        echo 'The list goes first name - last name - username - password(hashed) - email';
        echo '<ul>';
        foreach ($results as $result) {
            echo '<li>' . $result['firstName'] . '-' . $result['lastName'] . '-' . $result['username'] . '-' . $result['password'] . '-' . $result['email'] . '</li>';
        }
        echo '</ul>';
    }
    elseif ($selectedOperation == "update") {
        echo '<form action="" method="post">';
        echo '<label for="username">Enter the username you would like to change something about</label>';
        echo '<input type="text" name="username" required>';
        echo '<input type="submit" value="Submit">';
        echo '</form>';
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usernameToUpdate = $_POST['username'];
            $sql = "SELECT id, firstName, lastName, username, password, email FROM registration WHERE username = :username";
            $result = executeQuery($sql, [':username' => $usernameToUpdate]);
    
            if ($result) {
                $user = $result->fetch();

                echo '<form action="" method="post">';
                echo '<input type="hidden" name="userId" value="' . $user['id'] . '">';
                echo '<label for="firstName">First Name:</label>';
                echo '<input type="text" name="firstName" value="' . $user['firstName'] . '" required>';
                echo '<label for="lastName">Last Name:</label>';
                echo '<input type="text" name="lastName" value="' . $user['lastName'] . '" required>';
                echo '<label for="newUsername">Username:</label>';
                echo '<input type="text" name="newUsername" value="' . $user['username'] . '" required>';
                echo '<label for="email">Email:</label>';
                echo '<input type="text" name="email" value="' . $user['email'] . '" required>';
    
                echo '<input type="submit" name="updateUser" value="Update User">';
                echo '</form>';
    
                if (isset($_POST['updateUserSubmit'])) {
                    $userId = $_POST['userId'];
                    $newUsername = $_POST['newUsername'];
                    $newFirstName = $_POST['firstName'];
                    $newLastName = $_POST['lastName'];
                    $newEmail = $_POST['email'];
                
                    echo "User ID: $userId\n";
                    echo "New Username: $newUsername\n";
                    echo "New First Name: $newFirstName\n";
                    echo "New Last Name: $newLastName\n";
                    echo "New Email: $newEmail\n";
                
                    $sql = "UPDATE registration SET username = :newUsername, firstName = :newFirstName, lastName = :newLastName, email = :newEmail WHERE id = :userId";
                    $params = [
                        ':newUsername' => $newUsername,
                        ':newFirstName' => $newFirstName,
                        ':newLastName' => $newLastName,
                        ':newEmail' => $newEmail,
                        ':userId' => $userId,
                    ];
                    
                    echo "SQL: $sql\n";
                    echo "Parameters: " . print_r($params, true) . "\n";
                
                    $stmt = $pdo->prepare($sql);
                    $result = $stmt->execute($params);
                
                    if ($result) {
                        echo "User updated successfully!";
                    } else {
                        echo "Error updating user: " . print_r($stmt->errorInfo(), true);
                    }
                }
            }
        }
    }
    }else {
        echo "Invalid operation selected.";
    }

$pdo = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>

    <h3>Choose Operation</h3>

    <form action="" method="post">
    <label for="operation">Choose an operation:</label>
    <select name="operation" id="operation">
        <option value="add">Add</option>
        <option value="delete">Delete</option>
        <option value="view">View</option>
        <option value="update">Update</option>
    </select>

    <br><br>

    <input type="submit" value="Submit">
</form>


</body>
</html>
