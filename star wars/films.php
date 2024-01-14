<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Wars - Films</title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">
</head>
<body class="films-page-body">
<?php
session_start();
require_once 'navbar.php';
require_once 'database.php';
echo '<div class="row" style="margin: 100px">';
$films = getAllFilms();
foreach ($films as $film) {
    ?>
    <div class="col-md-3">
        <a href="film.php?film_id=<?php echo $film['filmID']; ?>" class="card mb-lg-5" style="height: 95%;">
            <div class="card-header text-center text-dark"><?php echo $film['film_title']; ?></div>
            <div class="card-body text-primary d-flex justify-content-center">
                <img src="<?php echo $film['image_url']; ?>" onerror="this.src='img/default_image.jpg'" style="width:80%" alt="<?php echo $film['film_title']; ?>">
            </div>
        </a>
    </div>
    <?php
}
if (isset($_SESSION['user_id'])&& isAdmin($_SESSION['user_id'])) {
    ?>
    <div class="col-md-3">
        <a href="createFilm.php" class="card mb-lg-5 add_film" style="height: 95%; width: 100%">
            <div class="card-body d-flex justify-content-center">?</div>
            <div class="card-body d-flex justify-content-center">Add a film</div>
        </a>
    </div>

    <?php
}
echo '</div>';
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

