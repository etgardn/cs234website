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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>

    <h2>Select Table</h2>

    <form action="" method="post">
        <label for="database">Choose a table:</label>
        <select name="database" id="database">
            <option value="registration">Registration</option>
            <option value="professor_review">Professor Review</option>
            <option value="contactPage">Contact Page</option>
        </select>

        <input type="submit" value="Submit">
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedDatabase = $_POST["database"];

        switch ($selectedDatabase) {
            case "registration":
                header("Location: adminReg.php");
                exit();
                break;
            case "professor_review":
                header("Location: adminPR.php");
                exit();
                break;
            case "contactPage":
                header("Location: adminCon.php");
                exit();
                break;
            default:
                echo "Invalid operation selected.";
        }
    }
    $pdo = null;
    ?>

</body>
</html>
