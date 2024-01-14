<?php

function openConnection() {
    try {
        $open_star_war_db = new PDO("sqlite:resources/star_wars.db");
        $open_star_war_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $open_star_war_db;
    
}

function getAllFilms(){
    $pdo = openConnection();
    $films = [];
    try {
        $res = $pdo->query("SELECT * FROM film");
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $film = [
                'filmID' => $row['filmID'],
                'film_title' => $row['film_title'],
                'image_url' => $row['image_url'],
                'description' => $row['film_opening_crawl']
            ];
            $films[] = $film;
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $films;
}

function getAllPeople(){
    $pdo = openConnection();
    try {
        $query = "SELECT * FROM people";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $people;
}

function getAllSpecies() {
    $pdo = openConnection();
    try {
        $query = "SELECT speciesID, species_name, image_url FROM species";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $species = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $species;
}


function getAllPlanets() {
    $pdo = openConnection();
    try {
        $query = "SELECT planetID, planet_name, image_url FROM planet";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $planets = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $planets;
}

function getAFilm($id){
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM film WHERE filmID = :filmID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':filmID', $id);
        $stmt->execute();
        $film = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $film;
}

function getAStarship($id) {
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM starship WHERE starshipID = :starshipID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':starshipID', $id);
        $stmt->execute();
        $starship = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $starship;
}

function getAVehicle($id){
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM vehicle WHERE vehicleID = :vehicleID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':vehicleID', $id);
        $stmt->execute();
        $vehicle= $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $vehicle;
}

function getAPlanet($id){
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM planet WHERE planetID = :planetID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':planetID', $id);
        $stmt->execute();
        $planet = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $planet;

}



function getAPerson($id){
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM people WHERE peopleID = :peopleID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':peopleID', $id);
        $stmt->execute();
        $person = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $person;

}

function getASpecies($id){
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM species WHERE speciesID = :speciesID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':speciesID', $id);
        $stmt->execute();
        $species = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $species;

}


function getPeopleForFilm($filmID) {
    $pdo = openConnection();
    try {
        $query = "SELECT p.peopleID AS person_id, people_name, image_url 
                  FROM people p 
                  LEFT JOIN film_people fp ON p.peopleID = fp.peopleID 
                  WHERE fp.filmID = :filmID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':filmID', $filmID);
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $people;
}

function getPeopleForStarship($shipID) {
    $pdo = openConnection();
    try {
        $query = "SELECT p.peopleID, people_name, image_url 
                  FROM people p 
                  LEFT JOIN people_starships ps ON p.peopleID = ps.peopleID 
                  WHERE ps.starshipID = :starshipID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':starshipID', $shipID);
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $people;
}

function getPeopleForVehicle($id){
    $pdo = openConnection();
    try {
        $query = "SELECT p.peopleID, people_name, image_url 
                  FROM people p 
                  LEFT JOIN people_vehicles pv ON p.peopleID = pv.peopleID 
                  WHERE pv.vehicleID = :vehicleID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':vehicleID', $id);
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $people;
}


function getFilmsForPerson($personID) {
    $pdo = openConnection();
    try {
        $query = "SELECT f.filmID AS film_id, film_title, image_url 
                  FROM film f 
                  JOIN film_people fp ON f.filmID = fp.filmID 
                  WHERE fp.peopleID = :peopleID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':peopleID', $personID);
        $stmt->execute();
        $films = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $films;
}


function getFilmsForPlanet($planetID){
    $pdo = openConnection();
    try {
        $query = "SELECT f.filmID AS film_id, film_title, f.image_url 
                  FROM film f 
                  JOIN film_planet fp ON f.filmID = fp.filmID 
                  WHERE fp.planetID = :planetID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':planetID', $planetID);
        $stmt->execute();
        $films = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $films;
}

function getFilmsForStarship($shipID){
    $pdo = openConnection();
    try {
        $query = "SELECT f.filmID AS film_id, film_title, f.image_url 
                  FROM film f 
                  JOIN film_starships fs ON f.filmID = fs.filmID 
                  WHERE fs.starshipID = :starshipID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':starshipID', $shipID);
        $stmt->execute();
        $films = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $films;
}

function getFilmsForVehicle($vehicleID) {
    $pdo = openConnection();
    try {
        $query = "SELECT f.filmID AS film_id, film_title, f.image_url 
                  FROM film f 
                  JOIN film_vehicles fv ON f.filmID = fv.filmID 
                  WHERE fv.vehicleID = :vehicleID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':vehicleID', $vehicleID);
        $stmt->execute();
        $films = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $films;
}



function getPlanetsForFilm($filmID) {
    $pdo = openConnection();
    try {
        $query = "SELECT p.planetID AS planet_id, planet_name, image_url
                  FROM planet p 
                  LEFT JOIN film_planet fp ON p.planetID = fp.planetID 
                  WHERE fp.filmID = :filmID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':filmID', $filmID);
        $stmt->execute();
        $planets = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $planets;
}

function getProducersForFilm($filmID) {
    $pdo = openConnection();
    try {
        $query = "SELECT p.producerID AS producer_id, producer_name, image_url
                  FROM producer p 
                  JOIN film_producer fp ON p.producerID = fp.producerID 
                  WHERE fp.filmID = :filmID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':filmID', $filmID);
        $stmt->execute();
        $producers = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $producers;
}

function getVehiclesForFilm($filmID) {
    $pdo = openConnection();
    try {
        $query = "SELECT v.vehicleID AS vehicle_id, vehicle_name, vehicle_model, image_url
                  FROM vehicle v 
                  JOIN film_vehicles fv ON v.vehicleID = fv.vehicleID 
                  WHERE fv.filmID = :filmID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':filmID', $filmID);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $vehicles;
}

function getStarshipsForFilm($filmID) {
    $pdo = openConnection();
    try {
        $query = "SELECT s.starshipID AS starship_id, starship_name, starship_model, image_url
                  FROM starship s 
                  JOIN film_starships fs ON s.starshipID = fs.starshipID 
                  WHERE fs.filmID = :filmID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':filmID', $filmID);
        $stmt->execute();
        $starships = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $starships;
}

function getPlanetForPerson($planetID) {
    $pdo = openConnection();

    try {
        $query = "SELECT planetID, planet_name, image_url FROM planet WHERE planetID = :planetID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':planetID', $planetID);
        $stmt->execute();
        $planet = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $planet;
}

function getPeopleForPlanet($planetID) {
    $pdo = openConnection();
    try {
        $query = "SELECT p.peopleID, people_name, p.image_url 
                  FROM people p 
                  JOIN planet pl ON p.people_homeworld_id = pl.planetID 
                  WHERE p.people_homeworld_id = :planetID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':planetID', $planetID);
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $people;
}

function getVehiclesForPerson($personID) {
    $pdo = openConnection();
    try {
        $query = "SELECT v.vehicleID AS vehicle_id, vehicle_name, vehicle_model, image_url
                  FROM vehicle v 
                  JOIN people_vehicles pv ON v.vehicleID = pv.vehicleID 
                  WHERE pv.peopleID = :peopleID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':peopleID', $personID);
        $stmt->execute();
        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $vehicles;
}

function getStarshipsForPerson($personID) {
    $pdo = openConnection();
    try {
        $query = "SELECT s.starshipID AS starship_id, starship_name, starship_model, image_url
                  FROM starship s 
                  JOIN people_starships ps ON s.starshipID = ps.starshipID 
                  WHERE ps.peopleID = :peopleID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':peopleID', $personID);
        $stmt->execute();
        $starships = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $starships;

}

function getSpeciesForPerson($speciesID) {
    $pdo = openConnection();

    try {
        $query = "SELECT speciesID, species_name, image_url FROM species WHERE speciesID = :speciesID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':speciesID', $speciesID);
        $stmt->execute();
        $species = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $species;
}

function getClimateForPlanet($id) {
    $pdo = openConnection();
    try {
        $query = "SELECT c.planet_climate
                  FROM planet_climate pc
                  JOIN climate c ON c.planetclimateID = pc.climateID 
                  WHERE pc.planetID = :planetID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':planetID', $id);
        $stmt->execute();
        $climate = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $climate;

}

function getTerrainsForPlanet($id) {
    $pdo = openConnection();
    try {
        $query = "SELECT t.planet_terrain, t.image_url
                  FROM planet_terrain pt
                  LEFT JOIN terrain t ON t.planetterrainID = pt.terrainID 
                  WHERE pt.planetID = :planetID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':planetID', $id);
        $stmt->execute();
        $terrains = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $terrains;

}

function getPeopleForSpecies($id){
    $pdo = openConnection();
    try {
        $query = "SELECT p.peopleID, people_name, p.image_url 
                  FROM people p 
                  JOIN species s ON p.people_species_id = s.speciesID 
                  WHERE p.people_species_id = :people_species_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':people_species_id', $id);
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $people;

}

function getManufacturerForStarship($starship_id) {
    $pdo = openConnection();
    try {
        $query = "SELECT * 
                  FROM starship_manufacturer sm 
                  JOIN manufacturer m ON sm.manufacturerID = m.manufacturerID 
                  WHERE sm.starshipID = :starshipID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':starshipID', $starship_id);
        $stmt->execute();
        $manufacturer = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $manufacturer;
}

function getManufacturerForVehicle($vehicle_id) {
    $pdo = openConnection();
    try {
        $query = "SELECT * 
                  FROM vehicle_manufacturer vm
                  JOIN manufacturer m ON vm.manufacturerID = m.manufacturerID 
                  WHERE vm.vehicleID = :vehicleID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':vehicleID', $vehicle_id);
        $stmt->execute();
        $manufacturer = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetchAll to get all matching rows
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $manufacturer;
}

function getStarshipClass($class_id) {
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM starshipclass WHERE starshipclassID = :starshipclassID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':starshipclassID', $class_id);
        $stmt->execute();
        $class = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $class;
}

function getVehicleClass($class_id) {
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM vehicleclass WHERE vehicleclassID = :vehicleclassID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':vehicleclassID', $class_id);
        $stmt->execute();
        $class = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $class;

}

function getSameClassShips($class_id, $starshipID) {
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM starship WHERE starshipclassID = :starshipclassID AND starshipID != :starshipID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':starshipclassID', $class_id);
        $stmt->bindParam(':starshipID', $starshipID);
        $stmt->execute();
        $starships = $stmt->fetchALL(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $starships;

}

function getSameClassVehicles($class_id, $vehicleID) {
    $pdo = openConnection();

    try {
        $query = "SELECT * FROM vehicle WHERE vehicleclassID = :vehicleclassID AND vehicleID != :vehicleID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':vehicleclassID', $class_id);
        $stmt->bindParam(':vehicleID', $vehicleID);
        $stmt->execute();
        $vehicles = $stmt->fetchALL(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $vehicles;
}


function saveUser($username, $dob, $isAdmin, $email, $password, $image) {
    $db = openConnection();

    try {

        $stmt = $db->prepare("INSERT INTO user (user_name, dob, admin, email, password, image_url) VALUES (:username, :dob, :isAdmin, :email, :password, :image)");

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':isAdmin', $isAdmin);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), 'UNIQUE constraint failed: user.email') !== false) {
            die("<div style='text-align: center;margin-top: 3%;'>Error: " . 'It seems like this email address has been used.</div>');
        } else {
            die("<div style='text-align: center;margin-top: 3%;'>Error: " . $e->getMessage()."</div>");
        }

    }
}

function authenticateUser($email, $password) {
    $db = openConnection();

    try {

        $stmt = $db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
        return false;
    }
}

function saveMovie($title, $ep_id, $releaseDate, $openingCrawl, $director, $imageUrl): bool {
    $db = openConnection();

    try {

        $stmt = $db->prepare("INSERT INTO film (film_title, film_episode_id, film_opening_crawl, film_director, film_release_date, image_url) VALUES (:title, :episodeID, :openingCrawl, :director, :releaseDate, :imageUrl)");


        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':episodeID', $ep_id, PDO::PARAM_INT);
        $stmt->bindParam(':openingCrawl', $openingCrawl);
        $stmt->bindParam(':director', $director);
        $stmt->bindParam(':releaseDate', $releaseDate);
        $stmt->bindParam(':imageUrl', $imageUrl);


        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
        return false;
    }

}

function saveCharacterForFilm($ep_id, $people_id) {
    $db = openConnection();

    try {

        $stmt = $db->prepare("SELECT filmID FROM film WHERE film_episode_id = :episodeID");
        $stmt->bindParam(':episodeID', $ep_id, PDO::PARAM_INT);
        $stmt->execute();
        $film = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($film) {
            $filmID = $film['filmID'];
            $description = null;

            $stmt = $db->prepare("INSERT INTO film_people (peopleID, filmID, film_people_description) VALUES (:peopleID, :filmID, :description)");
            $stmt->bindParam(':peopleID', $people_id, PDO::PARAM_INT);
            $stmt->bindParam(':filmID', $filmID, PDO::PARAM_INT);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return false;
    }
}

function isAdmin($userID) {
    $db = openConnection();

    try {

        $stmt = $db->prepare("SELECT * FROM user WHERE userID = :userID");
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['admin']==1) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
        return false;
    }
}






