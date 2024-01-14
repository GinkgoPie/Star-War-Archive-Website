<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Wars - Films</title>
    <script src="js/script.js"></script>
    <script src="js/film_script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
</head>
<body class="film-page-body">
<?php
require_once 'navbar.php';
require_once 'database.php';

$film_id = $_GET['film_id'];
$film = getAFilm($film_id);
$people = getPeopleForFilm($film_id);
$planets = getPlanetsForFilm($film_id);
$producers = getProducersForFilm($film_id);
$vehicles = getVehiclesForFilm($film_id);
$starships = getStarshipsForFilm($film_id);
if (!$film) {
    require_once 'pageNotFound.php';
} else {
?>
<div class="row" style="margin-left: 30px; padding: 30px">
    <div class="col-md-5">
        <img src="<?php echo $film['image_url']; ?>" onerror="this.src='img/default_image.jpg'" style="width:95%" alt="<?php echo $film['film_title']; ?>">
    </div>
    <div class="col-md-7">
        <div class="row-cols-8">
            <h1 style="color: white; text-align: center"><?php echo $film['film_title']; ?></h1>
            <p style="color: darkgoldenrod; text-align: start; font-size: x-large; font-family: 'Quicksand', sans-serif">Description</p>
            <p style="color: darkgoldenrod; text-align: start; font-size: large; font-family: 'Quicksand', sans-serif"><?php echo $film['film_opening_crawl']; ?></p>
        </div>
        <div class="row" style="position: relative">
            <p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: 'Quicksand', sans-serif">Cast</p>
            <?php
            if (count($people) > 12) {
                echo '<button class="toggleButton" id="people-toggle-button" onclick="togglePeople()">Show More</button>';
            }
            ?>
        </div>


        <div class="row flex-fill" id="people-container">
            <?php
            $index = 0;
            $max = 12;
            foreach ($people as $person) {
                if ($index < $max) {
                    ?>
                    <div class="col-md-2">
                        <a href="people.php?person_id=<?php echo $person['person_id']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                            <div class="card-header-tabs text-center text-dark"><?php echo $person['people_name']; ?></div>
                            <div class="card-body text-primary d-flex justify-content-center">
                                <img src="<?php echo $person['image_url']; ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="<?php echo $person['people_name']; ?>">
                            </div>
                        </a>
                    </div>
                    <?php
                }
                $index++;
            }
            ?>
        </div>
        <div class="row" style="position: relative">
            <p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: 'Quicksand', sans-serif">Planet</p>
            <?php
            if (count($planets) > 6) {
                echo '<button class="toggleButton" id="planet-toggle-button" onclick="togglePlanet()">Show More</button>';
            }
            ?>
        </div>

        <div class="row flex-fill" id="planet-container">
            <?php
            $planetIndex = 0;
            $maxPlanets = 6;
            foreach ($planets as $planet) {
                if ($planetIndex < $maxPlanets) {
                ?>
                    <div class="col-md-2">
                        <a href="planets.php?planet_id=<?php echo $planet['planet_id']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                            <div class="card-header-tabs text-center text-dark"><?php echo $planet['planet_name']; ?></div>
                            <div class="card-body text-primary d-flex justify-content-center">
                                <img src="<?php echo rtrim($planet['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="<?php echo $planet['planet_name']; ?>">
                            </div>
                        </a>
                    </div>
                <?php
                }
                $planetIndex++;
            }
            ?>
        </div>
    </div>


</div>
<div class="col" style="margin-left: 30px; padding: 5px">
    <div class="row" style="margin-left: 30px;margin-right: 50px; position: relative;">
        <?php
        if (count($vehicles) > 0) {
            echo '<p style="margin-top: 0; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: \'Quicksand\', sans-serif">Vehicle</p>';
        }
        ?>

        <?php
        if (count($vehicles) > 6) {
            echo '<button class="toggleButton" id="vehicle-toggle-button" onclick="toggleVehicle()">Show More</button>';
        }
        ?>
    </div>

    <div class="row flex-fill mx-5" id="vehicle-container">
        <?php
        $vehicleIndex = 0;
        $maxVehicles = 6;
        foreach ($vehicles as $vehicle) {
            if ($vehicleIndex < $maxVehicles) {
                ?>
                <div class="col-md-2">
                    <a href="vehicles.php?vehicle_id=<?php echo $vehicle['vehicle_id']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                        <div class="card-header-tabs text-center text-dark"><?php echo $vehicle['vehicle_name']; ?></div>
                        <div class="card-body text-primary d-flex justify-content-center">
                            <img src="<?php echo rtrim($vehicle['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="<?php echo $vehicle['vehicle_name']; ?>">
                        </div>
                    </a>
                </div>
                <?php
            }
            $vehicleIndex++;
        }
        ?>
    </div>
</div>

<div class="col mt-4" style="margin-left: 30px; padding: 5px;">
    <div class="row" style="margin-left: 30px;margin-right: 50px; position: relative;">
        <p style="margin-top: 0; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: 'Quicksand', sans-serif">Starship</p>
        <?php
        if (count($starships) > 6) {
            echo '<button class="toggleButton" id="starship-toggle-button" onclick="toggleStarship()">Show More</button>';
        }
        ?>
    </div>

    <div class="row flex-fill mx-5" id="starship-container">
        <?php
        $starshipIndex = 0;
        $maxStarships = 6;
        foreach ($starships as $starship) {
            if ($starshipIndex < $maxStarships) {
                ?>
                <div class="col-md-2">
                    <a href="starships.php?starship_id=<?php echo $starship['starship_id']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                        <div class="card-header-tabs text-center text-dark"><?php echo $starship['starship_name']; ?></div>
                        <div class="card-body text-primary d-flex justify-content-center">
                            <img src="<?php echo rtrim($starship['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="<?php echo $starship['starship_name']; ?>">
                        </div>
                    </a>
                </div>
                <?php
            }
            $starshipIndex++;
        }
        ?>
    </div>
</div>

<div class="col mt-4" style="margin-left: 30px; padding: 5px;">
    <div class="row" style="margin-left: 30px;margin-right: 50px; position: relative;">
        <?php
        if (count($producers) > 0) {
            echo '<p style="margin-top: 0; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: \'Quicksand\', sans-serif">Producers</p>';
        }
        ?>
    </div>

    <div class="row flex-fill mx-5" id="producers-container">
        <?php
        foreach ($producers as $producer) {
                ?>
                <div class="col-md-2">
                    <div class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                        <div class="card-header-tabs text-center text-dark"><?php echo $producer['producer_name']; ?></div>
                        <div class="card-body text-primary d-flex justify-content-center">
                            <img src="<?php echo rtrim($producer['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="<?php echo $producer['producer_name']; ?>">
                        </div>
                    </div>
                </div>
                <?php
        }
        ?>
    </div>
</div>

<script>
var peopleData = <?php echo json_encode($people); ?>;
var planetsData = <?php echo json_encode($planets); ?>;
var vehiclesData = <?php echo json_encode($vehicles); ?>;
var starshipsData = <?php echo json_encode($starships); ?>;
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
}