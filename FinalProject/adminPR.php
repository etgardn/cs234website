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
        echo '<label for="username">Enter the email you would like to delete</label>';
        echo '<input type="text" name="username" required>';
        echo '<input type="submit" value="Submit">';
        echo '</form>';
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $sql = "SELECT id FROM professor_reviews WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$username]);
            
            $id = $result[0];

            $sql = "DELETE FROM professor_reviews WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($id);

        }
    } elseif ($selectedOperation == "view") {
        $sql = "SELECT * FROM professor_reviews";
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        echo 'The list goes professor name-rating-review';
        echo '<ul>';
        foreach ($results as $result) {
            echo '<li>' . $result['professor_name'] . '-' . $result['rating'] . '-' . $result['review_text'] . '</li>';
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
        <option value="view">View</option>
    </select>

    <br><br>

    <input type="submit" value="Submit">
</form>


</body>
</html>