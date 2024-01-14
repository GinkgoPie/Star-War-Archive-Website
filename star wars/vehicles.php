<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Wars - vehicle</title>
    <script src="js/script.js"></script>
    <script src="js/people_script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
</head>
<body style="background-color: black; color: white">
<?php
session_start();
require_once 'navbar.php';
require_once 'database.php';

$vehicle_id = $_GET['vehicle_id'];
$vehicle = getAVehicle($vehicle_id);
if (!$vehicle) {
    require_once 'pageNotFound.php';
} else {
    $manufacturer = getManufacturerForVehicle($vehicle_id);
    $class = getVehicleClass($vehicle['vehicleclassID']);
    $sameClassVehicles = getSameClassVehicles($vehicle['vehicleclassID'], $vehicle_id);
    $films = getFilmsForVehicle($vehicle_id);
    $people = getPeopleForVehicle($vehicle_id);
    ?>
    <div class="row m-5">
        <div class="col-md-6">
            <img src="<?php echo rtrim($vehicle['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="width:90%" alt="<?php echo $vehicle['vehicle_name']; ?>">
            <div class="row">
                <h2 style="margin-top: 5%;margin-left: 2%;;color: darkgoldenrod; text-align: start; font-family: 'Quicksand', sans-serif">Information</h2>
            </div>
            <div class="row">
                <div class="col text-white" >
                    <h5>Model :</h5>
                    <h5>Cost(in credits) :</h5>
                    <h5>Length :</h5>
                    <h5>Max Atmosphering Speed :</h5>
                    <h5>Crew :</h5>
                    <h5>Passengers :</h5>
                    <h5>Cargo Capacity :</h5>
                    <h5>Consumables :</h5>
                    <h5>Class :</h5>

                </div>
                <div class="col text-white" >
                    <h5><?php echo $vehicle['vehicle_model']?></h5>
                    <h5><?php echo $vehicle['vehicle_cost_in_credits']?></h5>
                    <h5><?php echo $vehicle['vehicle_length']?></h5>
                    <h5><?php echo $vehicle['vehicle_max_atmosphering_speed']?></h5>
                    <h5><?php echo $vehicle['vehicle_crew']?></h5>
                    <h5><?php echo $vehicle['vehicle_passengers']?></h5>
                    <h5><?php echo $vehicle['vehicle_cargo_capacity']?></h5>
                    <h5><?php echo $vehicle['vehicle_consumables']?></h5>
                    <h5><?php echo $class['vehicle_class']?></h5>
                </div>
            </div>
        </div>

        <div class="col-md-6" >
            <h1 style="color: white; text-align: center"><?php echo $vehicle['vehicle_name']; ?></h1>

            <?php
            if (count($films) > 0) {
                echo '<p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: \'Quicksand\', sans-serif">Appears in</p>';
            }
            ?>

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
            if (count($people) > 0) {
                echo '<p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: \'Quicksand\', sans-serif">Drivers</p>';
            }
            ?>


            <div class="row">
                <?php
                foreach ($people as $person) {
                    ?>
                    <div class="col-md-4">
                        <a href="people.php?person_id=<?php echo $person['peopleID']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 200px; width: 250px">
                            <div class="card-header-tabs text-center text-dark"><?php echo $person['people_name']; ?></div>
                            <div class="card-body text-primary d-flex justify-content-center">
                                <img src="<?php echo rtrim($person['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%" alt="<?php echo $person['people_name']; ?>">
                            </div>
                        </a>
                    </div>
                    <?php

                }
                ?>
            </div>


            <?php
            if (count($sameClassVehicles) > 0) {
                echo '<p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: \'Quicksand\', sans-serif">Same class vehicles</p>';
            }
            ?>


            <div class="row">
                <?php
                foreach ($sameClassVehicles as $v) {
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-sm-3" style="background-color: darkgoldenrod; height: 200px; width: 250px">
                            <a href="vehicles.php?vehicle_id=<?php echo $v['vehicleID']; ?>" class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                                <div class="card-header-tabs text-center text-dark"><?php echo $v['vehicle_name']; ?></div>
                                <div class="card-body text-primary d-flex justify-content-center">
                                    <img src="<?php echo rtrim($v['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%" alt="<?php echo $v['vehicle_name']; ?>">
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php

                }
                ?>

            </div>

            <p style="margin-top: 6%; margin-left: 2%; color: darkgoldenrod; text-align: start; font-size: x-large; font-family: \'Quicksand\', sans-serif">Manufacturer</p>
            <div class="row">
                <div class="col-md-2">
                    <div class="card mb-sm-3" style="background-color: darkgoldenrod; height: 150px">
                        <div class="card-header-tabs text-center text-dark"><?php echo $manufacturer['vehicle_manufacturer']; ?></div>
                        <div class="card-body text-primary d-flex justify-content-center">
                            <img src="<?php echo rtrim($manufacturer['image_url'], "/revision/latest"); ?>" onerror="this.src='img/default_image.jpg'" style="max-width:100%; max-height: 100%" alt="<?php echo $manufacturer['vehicle_manufacturer']; ?>">
                        </div>
                    </div>
                </div>
            </div>
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

