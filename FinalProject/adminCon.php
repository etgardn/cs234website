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

    if ($selectedOperation == "delete") {

        echo '<form action="" method="post">';
        echo '<label for="email">Enter the email you would like to delete</label>';
        echo '<input type="text" name="email" required>';
        echo '<input type="submit" value="Submit">';
        echo '</form>';
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $sql = "SELECT id FROM contactPage WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$email]);
            
            $id = $result[0];

            $sql = "DELETE FROM contactPage WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($id);
        }
        } elseif ($selectedOperation == "view") {
        $sql = "SELECT * FROM contactPage";
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        echo 'The list goes email - issue';
        echo '<ul>';
        foreach ($results as $result) {
            echo '<li>' . $result['email'] . '-' . $result['issue'] .'</li>';
        }
        echo '</ul>';
    }
    else {
        echo "Invalid operation selected.";
    }
    
$pdo = null;
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

    <h3>Choose Operation</h3>

    <form action="" method="post">
    <label for="operation">Choose an operation:</label>
    <select name="operation" id="operation">
        <!-- <option value="delete">Delete</option> -->
        <option value="view">View</option>
    </select>

    <br><br>

    <input type="submit" value="Submit">
</form>


</body>
</html>