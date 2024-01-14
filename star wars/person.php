

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Wars - People</title>
    <script src="js/script.js"></script>
    <script src="js/people_script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
</head>
<body class="person-page-body">
<?php
session_start();
require_once 'navbar.php';
require_once 'database.php';

$person_id = $_GET['person_id'];
$person = getAPerson($person_id);
if (!$person) {
    require_once 'pageNotFound.php';
} else {
    $people_height = ($person['people_height'] == 'unknown') ? 'unknown height' : $person['people_height'].'cm';
    $people_mass = ($person['people_mass'] == 'unknown') ? 'unknown mass' : $person['people_mass'].'kg';
    $people_hair_color = ($person['people_hair_color'] == 'none') ? 'no hair' : $person['people_hair_color'].' hair';
    $people_skin_color = ($person['people_skin_color'] == 'unknown') ? 'skin color unknown' : $person['people_skin_color'].' skin';
    $people_eye_color = ($person['people_eye_color'] == 'unknown') ? 'eye color unknown' : $person['people_eye_color'].' eyes';
    $people_birth_year = ($person['people_birth_year'] == 'unknown') ? 'birth year unknown' : 'born in '.$person['people_birth_year'];
    $people_gender = ($person['people_gender'] == 'unknown') ? 'gender unknown' : $person['people_gender'];
    $people_species = getSpeciesForPerson($person['people_species_id']);
    $films = getFilmsForPerson($person_id);
    $planet = getPlanetForPerson($person['people_homeworld_id']);
    $vehicles = getVehiclesForPerson($person_id);
    $starships = getStarshipsForPerson($person_id);
    ?>

        <div class="col-md-6">
            <img src="<?php echo $person['image_url']; ?>" onerror="this.src='img/default_image.jpg'" style="width:90%" alt="<?php echo $person['people_name']; ?>">
            <div class="col text-white" >
                <p style="margin-top: 5%;color: darkgoldenrod; text-align: start; font-size: x-large; font-family: 'Quicksand', sans-serif">Profile</p>
                <h5><?php echo $people_height?></h5>
                <h5><?php echo $people_mass?></h5>
                <h5><?php echo $people_hair_color?></h5>
                <h5><?php echo $people_skin_color?></h5>
                <h5><?php echo $people_eye_color?></h5>
                <h5><?php echo $people_birth_year?></h5>
                <h5><?php echo $people_gender?></h5>
                <a href="species.php?species_id=<?php echo $people_species['speciesID']; ?>" style="text-decoration: underline; color: gold; text-align: start; font-size: large; font-family: 'Quicksand', sans-serif"><em><?php echo $people_species['species_name']; ?></em></a>
            </div>
        </div>

        <div class="col-md-6" >
            <h1 style="color: white; text-align: center"><?php echo $person['people_name']; ?></h1>

            <p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: 'Quicksand', sans-serif">Home planet</p>
            <div class="row" id="planet-container">
                <div class="col-md-2">
                    <a href="planets.php?planet_id=<?php echo $planet['planetID']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 200px; width: 200px">
                        <div class="card-header-tabs text-center text-dark"><?php echo $planet['planet_name']; ?></div>
                        <div class="card-body text-primary d-flex justify-content-center">
                            <img src="<?php echo rtrim($planet['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="width:100%; max-height: 100%" alt="<?php echo $planet['planet_name']; ?>">
                        </div>
                    </a>
                </div>
            </div>

            <p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: 'Quicksand', sans-serif">Appears in</p>
            <div class="row" style="width: 100%" id="films-container">
                <?php
                foreach ($films as $film) {
                    ?>
                    <div class="col-md-4">
                        <a href="film.php?film_id=<?php echo $film['film_id']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 200px; width: 200px">
                            <div class="card-header-tabs text-center text-dark"><?php echo $film['film_title']; ?></div>
                            <div class="card-body text-primary d-flex justify-content-center">
                                <img src="<?php echo $film['image_url']; ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="<?php echo $film['film_title']; ?>">
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>


            <?php
            if (count($vehicles) > 0) {
                echo '<p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: \'Quicksand\', sans-serif">Vehicle</p>';
            }
            ?>


            <div class="row" id="vehicle-container">
                <?php
                foreach ($vehicles as $vehicle) {
                    ?>
                    <div class="col-md-4">
                        <a href="vehicles.php?vehicle_id=<?php echo $vehicle['vehicle_id']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 200px; width: 250px">
                            <div class="card-header-tabs text-center text-dark"><?php echo $vehicle['vehicle_name']; ?></div>
                            <div class="card-body text-primary d-flex justify-content-center">
                                <img src="<?php echo rtrim($vehicle['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%" alt="<?php echo $vehicle['vehicle_name']; ?>">
                            </div>
                        </a>
                    </div>
                    <?php

                }
                ?>
            </div>


            <?php
            if (count($starships) > 0) {
                echo '<p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: \'Quicksand\', sans-serif">Starship</p>';
            }
            ?>


            <div class="row" id="starship-container">
                <?php
                foreach ($starships as $starship) {
                        ?>
                        <div class="col-md-4">
                            <a href="starships.php?starship_id=<?php echo $starship['starship_id']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 210px; width: 210px"">
                            <div class="card-header-tabs text-center text-dark"><?php echo $starship['starship_name']; ?></div>
                            <div class="card-body text-primary d-flex justify-content-center">
                                <img src="<?php echo rtrim($starship['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="width:100%; max-height: 100%" alt="<?php echo $starship['starship_name']; ?>">
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




<script>
    var vehiclesData = <?php echo json_encode($vehicles); ?>;
    var starshipsData = <?php echo json_encode($starships); ?>;
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

