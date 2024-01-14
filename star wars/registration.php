<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Explore the captivating Star Wars universe with our dynamic collection of films. Immerse yourself in the galaxy far, far away as you browse through an array of movie titles, each offering a unique adventure. Discover characters, planets, and species, and embark on an intergalactic journey. Join us for an unforgettable cinematic experience.">
    <title>Star Wars - Registration</title>
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
?>
<div class="mt-5 container">
    <h2>Register</h2>
    <form action="registration.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="image">Profile Image (jpeg, png, gif only):</label>
            <input type="file" class="form-control-file" name="image" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
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
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" name="dob" required value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : ''; ?>">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="adminCheckbox" name="adminCheckbox">
            <label class="form-check-label" for="adminCheckbox">Register as Administrator</label>
        </div>
        <div class="form-group" id="adminCodeGroup" style="display: none;">
            <label for="admin_code">Administrator Code:</label>
            <input type="text" class="form-control" name="admin_code">
        </div>
        <div class="form-group text-center">
            <button type="submit" style="background-color: darkgoldenrod" class="btn btn-primary mx-auto">Register</button>
        </div>
    </form>
</div>



    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"], $_FILES["image"], $_POST["email"], $_POST["password"], $_POST["dob"])) {
        if (isset($_POST["adminCheckbox"]) && $_POST['admin_code']!='INFO263') {
            echo '<div class="alert alert-danger mt-3">Invalid Administrator Code. You need invitation.</div>';
        }

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
                    if (saveUser($_POST["username"], $_POST["dob"], $isAdmin, $_POST["email"], $hashedPassword, $targetFile)) {
                        echo '<meta http-equiv="refresh" content="0.5;url=login.php">';
                    }


                } else {
                    echo "Image upload failed!";
                }
            }
        }

    }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById("adminCheckbox").addEventListener("change", function() {
        var adminCodeGroup = document.getElementById("adminCodeGroup");
        adminCodeGroup.style.display = this.checked ? "block" : "none";
    });
    const passwordField = document.getElementById("passwordField");
    const passwordToggle = document.getElementById("passwordToggle");

    passwordToggle.addEventListener("click", () => {
        if (passwordField.type === "password") {
            passwordField.type = "text";
            passwordToggle.classList.remove("fa-eye");
            passwordToggle.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            passwordToggle.classList.remove("fa-eye-slash");
            passwordToggle.classList.add("fa-eye");
        }
    });


</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
