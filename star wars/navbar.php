<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Wars - Nav</title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand flex-row d-flex">
        <img src="img/logo.jpg" alt="Star war Logo">
    </a>
    <div class="site-name-div">
        <p class="site-name">Star War Hub</p>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="films.php">Films</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="planets.php">Planets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="people.php">People</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="species.php">Species</a>
            </li>
            <?php
            session_start();
            if (isset($_SESSION['user_id'])) {
                echo'<li class="nav-item">
                <a class="nav-link" href="logout.php">Log out</a></li>';
            } else {
                echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
            }
            ?>

        </ul>
    </div>
</nav>

<!-- Your PHP or content here -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
