<!-- Добавление/удаление картинок -->


<?php
if ($_POST["addImage"]) {
    if (addImage($_POST["imagesHotel"], $_FILES)) {
        echo "<script>";
        echo "window.location=document.URL;";
        echo "</script>";
    } else {
        echo "<h3 align='center' style='color: red'>При добавлении возникла ошибка!</h3>";
    }
} else if ($_POST["deleteImage"]) {
    $hotelId = $_POST["imagesHotel"];
    $imageSelector = "selectedImages" . strval($hotelId);
    if (deleteImage($_POST[$imageSelector])) {
        echo "<script>";
        echo "window.location=document.URL;";
        echo "</script>";
    } else {
        echo "<h3 align='center' style='color: red'>При удалении возникла ошибка!</h3>";
    }
} else {
?>

<form action="index.php?page=4" method="POST" enctype="multipart/form-data"
    class="d-flex flex-column justify-content-around">
    <h3 align='center'>PICTURES</h3>

    <select class="form-control mb-3 mx-auto" name="imagesHotel" id="imagesHotelSelect" style="width: 50%;">
        <option disabled>Hotel</option>
        <?php
            $hotels = getHotels();
            for ($i = 0; $i < count($hotels); $i++) {
                if ($i === 0) {
                    echo "<option selected value='" . $hotels[$i]["id"] . "'>" . $hotels[$i]["hotel"] . "</option>";
                } else {
                    echo "<option value='" . $hotels[$i]["id"] . "'>" . $hotels[$i]["hotel"] . "</option>";
                }
            }
            ?>
    </select>
    <div class="imagesHotel position-relative" id="imagesHotel">
        <?php
            for ($i = 0; $i < count($hotels); $i++) {
                $images = getImagesByHotel($hotels[$i]["id"]);
                echo "<div class='row container-fluid position-absolute imageBlock' id='" . $hotels[$i]["id"] . "'>";

                for ($j = 0; $j < count($images); $j++) {
                    $nameCBs = "selectedImages" . $hotels[$i]["id"] . "[]";
                    echo "<div class='col-lg-4 col-md-4 col-sm-6 px-1 inputsImage'>";
                    echo "<input type='checkbox' name='$nameCBs' id='" . $images[$j]['id'] . "' value='" . $images[$j]['id'] . "' class='checkboxImage'/>";
                    echo "<label for='" . $images[$j]['id'] . "'>";
                    echo "<div class='divImage' style='background-image: url(" . $images[$j]["imagepath"] . ");'>";
                    echo "<div class='divBackground'></div>";
                    echo "</div></label></div>";
                }
                echo "</div>";
            }
            ?>
    </div>

    <div class="row">
        <div class="d-flex flex-column justify-content-end col-lg-6 col-sm-6 mt-2">
            <div class="input__wrapper">
                <input type="file" id="input__file" name="input__file[]" class="input input__file" accept="image/*"
                    multiple>
                <label for="input__file" class="btn input__file-button m-0">
                    <span class="input__file-button-text">Выберите файлы</span>
                </label>
            </div>
            <input class="btn" type="submit" value="Add" name="addImage" id="addImage" disabled>
        </div>
        <div class="d-flex flex-column justify-content-end col-lg-6 col-sm-6 mt-2">
            <input type="text" id="deleteImageInfo" class="form-control text-center" value="Select images"
                style="color: orangered;" disabled>
            <input class="btn" type="submit" value="Delete" name="deleteImage" id="deleteImage" disabled>
        </div>
    </div>
</form>
<?php
}
?>