<?php

$dsn = "mysql:host=localhost;dbname=project";
$username = "root";
$db_password = "root";

function createPDO($dsn, $username, $password)
{
    $pdo = new PDO($dsn, $username, $password);
    return $pdo;
}
function makeTable($pdo)
{
    $sql = "CREATE TABLE IF NOT EXISTS contactPage (
        id INT(7) NOT NULL AUTO_INCREMENT,
        email VARCHAR(255) NOT NULL,
        issue TEXT NOT NULL,
        PRIMARY KEY(id)
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

function insert($pdo, $email, $issue)
{
    $sql = "INSERT INTO contactPage (email, issue) VALUES (:email, :issue)";

    $statement = $pdo->prepare($sql);


    $statement->bindParam(':email', $email);
    $statement->bindParam(':issue', $issue);

    $statement->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = createPDO($dsn, $username, $db_password);
    makeTable($pdo);

    $email = $_POST['email'];
    $issue = $_POST['issue'];

    insert($pdo,$email,$issue);
    
    echo "Thank you for contacting us";

}
?>
