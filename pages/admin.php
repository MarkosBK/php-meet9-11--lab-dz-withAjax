<?php
if (!isset($_SESSION["admin"])) {
    echo "<h1 align='center' style='color: orangered; text-shadow: 2px 2px 5px #000; margin-top: 3%'>Only ADMINS</h1>";
} else {
?>

<div class="container row adminPanel mt-lg-2 mt-sm-0 mx-auto px-0">
    <!-- Добавление/удаление стран -->
    <div class="col-lg-6 col-sm-12 p-3" id="adminCountries">
        <?php include_once("pages/admin/country.php"); ?>
    </div>

    <!-- Добавление/удаление городов -->
    <div class="col-lg-6 col-sm-12 border p-3" id="adminCities">
        <?php include_once("pages/admin/city.php"); ?>
    </div>

    <!-- Добавление/удаление отелей -->
    <div class="col-lg-6 col-sm-12 border p-3" id="adminHotels">
        <?php include_once("pages/admin/hotels.php"); ?>
    </div>

    <!-- Добавление/удаление картинок -->
    <div class="col-lg-6 col-sm-12 border p-3" id="adminImages">
        <?php include_once("pages/admin/images.php"); ?>
    </div>
</div>
<?php } ?>