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
    $sql = "CREATE TABLE IF NOT EXISTS contactPage (
        id INT(7) NOT NULL,
        email VARCHAR(50) NOT NULL,
        issue TEXT NOT NULL,
        FOREIGN KEY(id) REFERENCES registration(id)
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

function insert($pdo, $email, $issue,$id)
{

   
    $sql = "INSERT INTO contactPage (email, issue,id) VALUES (:email, :issue,:id)";

    $statement = $pdo->prepare($sql);


    $statement->bindParam(':email', $email);
    $statement->bindParam(':issue', $issue);
    $statement->bindParam(':id', $id);

    $statement->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = createPDO($dsn, $username, $db_password);
    makeTable($pdo);

    $email = $_POST['email'];
    $issue = $_POST['issue'];
    $id = $_SESSION['id'];
    insert($pdo,$email,$issue,$id);
    
    $sql = "SELECT registration.username, contactPage.issue, contactPage.email 
        FROM registration JOIN contactPage ON registration.id = contactPage.id";
    
    $statement = $pdo->prepare($sql);
    $statement->execute();
    
    header("Location: ../mainSite.php");
    exit();


}
?>
