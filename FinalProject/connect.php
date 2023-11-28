<?php

$dsn = "mysql:host=localhost;dbname=project";
$db_username = "root";
$db_password = "root";

session_start();
function createPDO($dsn,$db_username,$db_password)
{
    $pdo = new PDO( $dsn , $db_username , $db_password);
    return $pdo;
}

function userExist($pdo,$username, $password)
{
    $sql = "SELECT * FROM registration WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo "true";
        return true;
    }else{
        echo "false";
        return false;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = createPDO($dsn,$db_username,$db_password);

    if($username == "admin" && $password == "admin")
    {
        header("Location: admin.php");
        exit();
    }else{
        if( userExist($pdo,$username,$password) ){
            echo "entered true";
            header("Location: mainSite.php");
            exit();
        }else{
            echo "entered false";
            header("Location: index.php");
            exit();
        }
    }
}

?>