<?php

$dsn = "mysql:host=localhost;dbname=project";
$username = "root";
$db_password = "root";

session_start();
function createPDO($dsn, $username, $password)
{
    $pdo = new PDO($dsn, $username, $password);
    return $pdo;
}

function makeTable($pdo)
{
    $sql = "CREATE TABLE IF NOT EXISTS registration (
        id INT(7) NOT NULL AUTO_INCREMENT,
        firstName VARCHAR(20) NOT NULL,
        lastName VARCHAR(20) NOT NULL,
        username VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        PRIMARY KEY(id)
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

function insertUser($pdo, $firstName, $lastName, $password, $email, $username)
{
    $sql = "INSERT INTO registration (username, password, firstName, lastName, email) VALUES (:username, :password, :firstName, :lastName, :email)";

    $statement = $pdo->prepare($sql);

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $statement->bindParam(':username', $username);
    $statement->bindParam(':password', $hashedPassword);
    $statement->bindParam(':firstName', $firstName);
    $statement->bindParam(':lastName', $lastName);
    $statement->bindParam(':email', $email);

    $statement->execute();
}

function uniqueUsername($pdo, $username)
{
    $sql = "SELECT COUNT(*) FROM registration WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count == 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_username = $_POST['username'];
    $user_lastName = $_POST['lastName'];
    $user_email = $_POST['email'];
    $user_firstName = $_POST['firstName'];
    $user_password = $_POST['password'];

    $pdo = createPDO($dsn, $username, $db_password);
    makeTable($pdo);

    if (uniqueUsername($pdo, $user_username)) {
        insertUser($pdo, $user_firstName, $user_lastName, $user_password, $user_email, $user_username);
        header("Location: index.php");
        exit();
    } else {
        echo "Username already taken";
    }
}
?>
