<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Wars - Species</title>
    <script src="js/script.js"></script>
    <script src="js/people_script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
</head>
<body class="planet-page-body">
<?php
session_start();
require_once 'navbar.php';
require_once 'database.php';
//
//speciesID                int not null
//        primary key
//        references people (people_species_id),
//    species_name             longtext,
//    species_classification   longtext,
//    species_designation      longtext,
//    species_average_height   longtext,
//    species_skin_colors      longtext,
//    species_hair_colors      longtext,
//    species_eye_colors       longtext,
//    species_average_lifespan longtext,
//    species_homeworld_id     int,
//    species_language         longtext,
//    image_url                longtext
$species_id = $_GET['species_id'];
$species = getASpecies($species_id);
if (!$species_id) {
    require_once 'pageNotFound.php';
} else {
    $people = getPeopleForSpecies($species_id);
    ?>

    <div class="col-md-6">
        <img src="<?php echo rtrim($species['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="width:90%" alt="<?php echo $species['species_name']; ?>">
        <div class="row">
            <h2 style="margin-top: 5%;margin-left: 2%;;color: darkgoldenrod; text-align: start; font-family: 'Quicksand', sans-serif">Information</h2>
        </div>

        <div class="row">
            <div class="col text-white" >
                <h5>Classification :</h5>
                <h5>Designation :</h5>
                <h5>Average Height :</h5>
                <h5>Skin Colors :</h5>
                <h5>Hair Colors :</h5>
                <h5>Eye Colors :</h5>
                <h5>Average Lifespan :</h5>
                <h5>Language :</h5>

            </div>
            <div class="col text-white" >
                <h5><?php echo $species['species_classification']?></h5>
                <h5><?php echo $species['species_designation']?></h5>
                <h5><?php echo $species['species_average_height']?></h5>
                <h5><?php echo $species['species_skin_colors']?></h5>
                <h5><?php echo $species['species_hair_colors']?></h5>
                <h5><?php echo $species['species_eye_colors']?></h5>
                <h5><?php echo $species['species_average_lifespan']?></h5>
                <h5><?php echo $species['species_language']?></h5>
            </div>
        </div>
    </div>

    <div class="col-md-6" >
        <h1 style="color: white; text-align: center"><?php echo $species['species_name']; ?></h1>

        <?php
        if (count($people) > 0) {
            echo '<p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: \'Quicksand\', sans-serif">People of this specie</p>';
        }
        ?>

        <div class="row" style="width: 100%" id="films-container">
            <?php
            foreach ($people as $p) {
                ?>
                <div class="col-md-4">
                    <a href="people.php?person_id=<?php echo $p['peopleID']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 200px; width: 200px">
                        <div class="card-header-tabs text-center text-dark"><?php echo $p['people_name']; ?></div>
                        <div class="card-body text-primary d-flex justify-content-center">
                            <img src="<?php echo $p['image_url']; ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="<?php echo $p['people_name']; ?>">
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>


    </div>
    <?php
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

