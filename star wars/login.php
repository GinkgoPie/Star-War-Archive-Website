<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Ward - Login Page</title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">
</head>
<body>
<?php
session_start();
require_once 'navbar.php';
require_once 'database.php';
?>
<div class="container mt-5">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-group">
                <input type="password" id="passwordField" class="form-control" name="password" required>
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fa fa-eye" id="passwordToggle"></i>
                    </span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p>Don't have an account? <a href="registration.php">Register here</a></p>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user = authenticateUser($email, $password);
    if (!$user) {
        echo '<div class="alert alert-danger mt-3">Invalid email and password combination. Please try again.</div>';
    } else {
        $_SESSION['user_id'] = $user['userID'];
        header("Location: index.php");
    }
}

?>

