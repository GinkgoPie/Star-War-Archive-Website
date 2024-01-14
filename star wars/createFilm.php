<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Wars - Create a Film</title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body style="background-color: black; color: white">
<?php
session_start();
require_once 'navbar.php';
require_once 'database.php';
if (!isset($_SESSION['user_id'])) {
    require_once "pageNotFound.php";
} else {
    ?>
<div class="mt-5 container" >
    <h2>Add a new film</h2>
    <form action="createFilm.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="film_title">Title:</label>
            <input type="text" class="form-control" name="film_title" required>
        </div>
        <div class="form-group">
            <label for="film_episode_id">Episode:</label>
            <input type="number" class="form-control-file" name="film_episode_id"  required>
        </div>
        <div class="form-group">
            <label for="film_release_date">Release date:</label>
            <input type="date" class="form-control" name="film_release_date" required>
        </div>
        <div class="form-group">
            <label for="film_opening_crawl">Opening crawl:</label>
            <input type="text" class="form-control" name="film_opening_crawl" required>
        </div>
        <div class="form-group">
            <label for="film_director">Director:</label>
            <input type="text" class="form-control" name="film_director" required>
        </div>
        <div class="form-group">
            <label for="selected_characters">Selected characters:</label><br>
            <div class="characters-container">
                <?php
                $characters = getAllPeople();
                if ($characters) {
                    foreach ($characters as $character) {
                        $characterID = $character['peopleID'];
                        echo '<input type="checkbox" name="selected_characters[]" value="' . $characterID . '" id="character' . $characterID . '" class="character-checkbox">';
                        echo '<label for="character' . $characterID . '" class="character-label">';
                        echo '<img src="' . $character['image_url'] . '" class="character-image" alt="' . $character['people_name'] . '">';
                        echo '<span class="character-name">' . $character['people_name'] . '</span>';
                        echo '</label>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="image">Poster Image(jpeg, png, gif only):</label>
            <input type="file" class="form-control-file" name="image" accept="image/*" required>
        </div>
        <div class="form-group text-center">
            <button type="submit" style="background-color: darkgoldenrod" class="btn btn-primary mx-auto">Post</button>
        </div>
    </form>
</div>
<?php

}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["film_title"], $_FILES["image"], $_POST["film_opening_crawl"], $_POST["film_director"], $_POST["film_episode_id"])) {

    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $allowedFormats = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES["image"]["type"], $allowedFormats)) {
            echo '<div class="alert alert-danger">Invalid image format. Please upload a JPEG, PNG, or GIF image.</div>';
        } else {

            $targetDir = "img/";
            $originalFileName = $_FILES["image"]["name"];
            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $uniqueFileName = time() . '-' . uniqid() . '.' . $fileExtension;
            $targetFile = $targetDir . $uniqueFileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $imagePath = $targetFile;
                $hashedPassword = password_hash($_POST["password"], PASSWORD_BCRYPT);
                $isAdmin = isset($_POST["adminCheckbox"]) && $_POST['admin_code']=='INFO263';
                if (saveMovie($_POST["film_title"], $_POST["film_episode_id"], $_POST["film_release_date"], $_POST["film_opening_crawl"], $_POST["film_director"], $targetFile)) {
                    if (isset($_POST["selected_characters"]) && is_array($_POST["selected_characters"])) {
                        $selectedCharacters = $_POST["selected_characters"];
                        foreach ($selectedCharacters as $characterID) {
                            if (!saveCharacterForFilm($_POST["film_episode_id"], $characterID)) {
                                echo '<div class="alert alert-danger">Could not save the character.</div>';
                            }
                        }
                    }
                    echo '<meta http-equiv="refresh" content="1.5;url=films.php">';


                } else {
                    echo '<div class="alert alert-danger">Could not upload the film.</div>';
                }


            } else {
                echo '<div class="alert alert-danger">Image upload failed!</div>';
            }
        }
    }

}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

