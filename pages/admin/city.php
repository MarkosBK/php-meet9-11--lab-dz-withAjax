<!-- Добавление/удаление городов -->

<?php
if ($_POST["addCity"]) {
    if (addCity($_POST["city"], $_POST["country"])) {
        echo "<script>";
        echo "window.location=document.URL;";
        echo "</script>";
    } else {
        echo "<h3 align='center' style='color: red'>При добавлении возникла ошибка!</h3>";
    }
} else if ($_POST["deleteCity"]) {
    if (deleteCity($_POST["selectedCities"])) {
        echo "<script>";
        echo "window.location=document.URL;";
        echo "</script>";
    } else {
        echo "<h3 align='center' style='color: red'>При удалении возникла ошибка!</h3>";
    }
} else {
?>

<form action="index.php?page=4" method="POST">
    <h3 align='center'>CITIES</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col" class='py-1 px-1 col-2'>#</th>
                <th scope="col" class='py-1 px-1 col-4'>Country</th>
                <th scope="col" class='py-1 px-1 col-5'>City</th>
                <th scope="col" class='py-1 px-1 col-1'></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $cities = getCities();
                for ($i = 0; $i < count($cities); $i++) {
                    echo "<tr>";
                    echo "<td class='py-1 px-1 col-2'>" . ($i + 1) . "</td>";
                    echo "<td class='py-1 px-1 col-4'>" . getCountryById($cities[$i]["countryId"])["country"] . "</td>";
                    echo "<td class='py-1 px-1 col-5'>" . $cities[$i]["city"] . "</td>";
                    echo "<td class='py-1 px-1 col-1'><input value='" . $cities[$i]["id"] . "' type='checkbox' name='selectedCities[]' class='checkboxCity'></td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex flex-column container-fluid px-0 mt-2">
                <div class="container-fluid d-flex px-0">
                    <div class="mr-1" style="width: 50%;">
                        <input type="text" class="form-control text-center" placeholder="City" name="city">
                    </div>
                    <div class="ml-1" style="width: 50%;">
                        <select id="selectCountry" class="form-control text-center" name="country">
                            <option disabled selected>Country</option>
                            <?php
                                $countries = getCountries();
                                for ($i = 0; $i < count($countries); $i++) {
                                    echo "<option value='" . $countries[$i]["id"] . "'>" . $countries[$i]["country"] . "</option>";
                                }
                                ?>
                        </select>
                    </div>
                </div>
                <div class="container-fluid px-0">
                    <input class="btn container-fluid" type="submit" value="Add" name="addCity">
                </div>
            </div>
        </div>
        <div class="col-lg-4 d-flex flex-column justify-content-end mt-2">
            <input type="text" id="deleteCityInfo" class="form-control text-center" value="Select cities"
                style="color: orangered;" disabled>
            <input class="btn" type="submit" value="Delete" name="deleteCity" id="deleteCity" disabled>
        </div>
    </div>
</form>
<?php
}
?>