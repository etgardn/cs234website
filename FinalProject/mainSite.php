<?php
session_start();

$dsn = "mysql:host=localhost;dbname=project";
$username = "root";
$db_password = "root";

function createPDO($dsn, $username, $db_password)
{
    $pdo = new PDO($dsn, $username, $db_password);
    return $pdo;
}

function makeTable($pdo)
{
    $sql = "CREATE TABLE IF NOT EXISTS professor_reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        professor_name VARCHAR(100) NOT NULL,
        review_text TEXT NOT NULL,
        rating INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute()) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . $stmt->errorInfo()[2];
    }
}


function init() {
    require config('template_path') . '/loginTemplate.php';
}

function site_name() {
    echo config('name');
}

function nav_menu($sep = ' | ') {
    $nav_menu = '';
    $nav_item = config('nav_menu');

    foreach ($nav_item as $uri => $name) {
        $nav_menu .= '<a class="w3-bar-item w3-button" href="' . 'content/' . $uri . ".phtml" . '">' . $name . '</a>' . $sep;
    }
    echo trim($nav_menu, $sep);
}

function page_content($dsn, $username, $db_password) {
    $pdo = createPDO($dsn, $username, $db_password);
    $sql = "SELECT professor_name, review_text, rating, created_at FROM professor_reviews ORDER BY created_at DESC";
    $result = $pdo->query($sql);

    if ($result->rowCount() > 0) {
        echo '<div class="w3-container">';
        while ($row = $result->fetch()) {
            echo '<div class="w3-card-4 w3-margin">';
            echo '<h4>' . $row['professor_name'] . '</h4>';
            echo '<p>Rating: ' . $row['rating'] . '</p>';
            echo '<p>' . $row['review_text'] . '</p>';
            echo '<p><small>Posted on ' . $row['created_at'] . '</small></p>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No reviews available.</p>';
    }

    $pdo = null;
}

function config($key = '') {
    $config = [
        'name' => 'Rate Your favorite Profesor',
        'nav_menu' => [
            'about-us' => 'About Us',
            'contact' => 'Contact',
            'logout' => 'Logout',
        ],
        'template_path' => 'template',
        'content_path' => 'content',
    ];

    return isset($config[$key]) ? $config[$key] : null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $professor_name = $_POST['professor_name'];
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];

    $pdo = createPDO($dsn, $username, $password);
    makeTable($pdo);

    $sql = "INSERT INTO professor_reviews (professor_name, review_text, rating) VALUES (:professor_name, :review_text, :rating)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':professor_name', $professor_name);
    $stmt->bindParam(':review_text', $review_text);
    $stmt->bindParam(':rating', $rating);

    $stmt->execute();

    $pdo = null; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php site_name(); ?></title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            font-family: "Arial", sans-serif;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        nav a {
            margin: 0 10px;
            text-decoration: none;
        }

        article {
            padding: 20px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="w3-container">
        <header class="w3-card-4">
            <h1><?php site_name(); ?></h1>
            <nav class="w3-bar">
                <?php nav_menu(); ?>
            </nav>
        </header>

        <article>
            <h2>Rate a Professor</h2>
            <form method="post" action="">
                <label for="professor_name">Professor Name:</label>
                <input class="w3-input" type="text" name="professor_name" required>

                <label for="review_text">Review:</label>
                <textarea class="w3-input" name="review_text" rows="4" required></textarea>

                <label for="rating">Rating:</label>
                <input class="w3-input" type="number" name="rating" min="1" max="5" required>

                <button class="w3-button w3-teal" type="submit" name="submit_review">Submit Review</button>
            </form>

            <h2>Recent Professor Reviews</h2>
            <?php page_content($dsn, $username, $db_password); ?>
        </article>
    </div>

    <footer class="w3-card-4">
        <small>&copy;<?php echo date('Y'); ?> Ethan Gardner</small>
    </footer>
</body>
</html>
