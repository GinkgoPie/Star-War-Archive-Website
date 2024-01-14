<!DOCTYPE html>
<html lang="en" xmlns:mso="urn:schemas-microsoft-com:office:office" xmlns:msdt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882">
<head>
    <meta charset="UTF-8">
    <title>Star Wars</title>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pixelify+Sans">


    <!--[if gte mso 9]><xml>
    <mso:CustomDocumentProperties>
    <mso:TaxCatchAll msdt:dt="string">4;#Departmental Document [Information]|fac5df9f-00c6-476f-b378-e7e6fdb4a7a9;#3;#Department Administration|5922f16f-5876-4a9c-b5de-d040ae3368bc;#2;#Business|a8bf67d7-71dc-4e2d-b344-a59a3ab155e8;#1;#Ilam|17015150-e7d5-4990-b358-e90ea571f1b0</mso:TaxCatchAll>
    <mso:c2d7d53541144364bb9d71f286b51f7e msdt:dt="string">Ilam|17015150-e7d5-4990-b358-e90ea571f1b0</mso:c2d7d53541144364bb9d71f286b51f7e>
    <mso:i7a4717f7d5d4c169373d4bfa77876ba msdt:dt="string">Departmental Document [Information]|fac5df9f-00c6-476f-b378-e7e6fdb4a7a9</mso:i7a4717f7d5d4c169373d4bfa77876ba>
    <mso:beaf417fcb4a4faab8ee781c2aab7105 msdt:dt="string"></mso:beaf417fcb4a4faab8ee781c2aab7105>
    <mso:SolarDepartment msdt:dt="string">2;#Business|a8bf67d7-71dc-4e2d-b344-a59a3ab155e8</mso:SolarDepartment>
    <mso:SolarDocumentType msdt:dt="string">4;#Departmental Document [Information]|fac5df9f-00c6-476f-b378-e7e6fdb4a7a9</mso:SolarDocumentType>
    <mso:SolarRecordOutcome msdt:dt="string"></mso:SolarRecordOutcome>
    <mso:MediaServiceImageTags msdt:dt="string"></mso:MediaServiceImageTags>
    <mso:SolarCategory msdt:dt="string">3;#Department Administration|5922f16f-5876-4a9c-b5de-d040ae3368bc</mso:SolarCategory>
    <mso:SolarBusinessUnit msdt:dt="string"></mso:SolarBusinessUnit>
    <mso:jb15094b84d04db39a8de0b202a5649b msdt:dt="string"></mso:jb15094b84d04db39a8de0b202a5649b>
    <mso:a01561942c7d47699e3a361a6a580934 msdt:dt="string">Business|a8bf67d7-71dc-4e2d-b344-a59a3ab155e8</mso:a01561942c7d47699e3a361a6a580934>
    <mso:ece120804c3e4f2e81afd96eec8909f4 msdt:dt="string">Department Administration|5922f16f-5876-4a9c-b5de-d040ae3368bc</mso:ece120804c3e4f2e81afd96eec8909f4>
    <mso:InformationValue msdt:dt="string"></mso:InformationValue>
    <mso:lcf76f155ced4ddcb4097134ff3c332f msdt:dt="string"></mso:lcf76f155ced4ddcb4097134ff3c332f>
    <mso:SolarLocation msdt:dt="string">1;#Ilam|17015150-e7d5-4990-b358-e90ea571f1b0</mso:SolarLocation>
    <mso:b0b6db7483f14678a4ad7fdce99521be msdt:dt="string"></mso:b0b6db7483f14678a4ad7fdce99521be>
    </mso:CustomDocumentProperties>
    </xml><![endif]-->
</head>
<body  class="home-page-body">

<?php
    session_start();
    require_once "navbar.php";
    require_once "database.php";
?>

<?php

try {
    $open_review_s_db = new PDO("sqlite:resources/star_wars.db");
    $open_review_s_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

$films = getAllFilms();
?>



<div class="slideshow-container">
    <?php
    foreach ($films as $film) {
        ?>
        <div class="mySlides fade">
            <a href="film.php?film_id=<?php echo $film['filmID']; ?>">
            <img src="<?php echo $film['image_url']; ?>"  onerror="this.src='img/default_image.jpg'" style="width:100%;" alt="<?php echo $film['film_title']; ?>">
            </a>
            <div class="slide-text"><?php echo $film['film_title']; ?></div>
        </div>
        <?php
    }
    ?>
</div>
<br>

<div style="text-align:center">
    <?php
    // Create a dot for each film slide
    for ($i = 1; $i <= count($films); $i++) {
        ?>
        <span class="dot"></span>
        <?php
    }
    ?>
</div>



<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 4000);
    }
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>