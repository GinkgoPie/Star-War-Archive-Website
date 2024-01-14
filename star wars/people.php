<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Wars - People</title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">
</head>
<body class="people-page-body">
<?php
session_start();
require_once 'navbar.php';
require_once 'database.php';
echo '<div class="row" style="margin: 100px">';
if (isset($_GET['person_id'])) {
    $person_id = $_GET['person_id'];
    require_once ('person.php');
} else {
    $people = getAllPeople();
    foreach ($people as $person) {
        ?>
        <div class="col-md-4">
            <a href="people.php?person_id=<?php echo $person['peopleID']; ?>" class="card mb-xl-5" style="height: 500px">

                <div class="card-header text-center text-dark"><?php echo $person['people_name']; ?></div>
                <div class="card-body text-primary d-flex justify-content-center">
                    <img src="<?php echo $person['image_url']; ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%" alt="<?php echo $person['people_name']; ?>">
                </div>
            </a>
        </div>
        <?php
    }
}
echo '</div>';
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
