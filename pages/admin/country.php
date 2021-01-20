<!-- Добавление/удаление стран -->
<?php
if ($_POST["addCountry"]) {
    if (addCountry($_POST["country"])) {
        echo "<script>";
        echo "window.location=document.URL;";
        echo "</script>";
    } else {
        echo "<h3 align='center' style='color: red'>При добавлении возникла ошибка!</h3>";
    }
} else if ($_POST["deleteCountry"]) {
    if (deleteCountry($_POST["selectedCountries"])) {
        echo "<script>";
        echo "window.location=document.URL;";
        echo "</script>";
    } else {
        echo "<h3 align='center' style='color: red'>При удалении возникла ошибка!</h3>";
    }
} else {
?>
<form action="index.php?page=4" method="POST">
    <h3 align='center'>COUNTRIES</h3>

    <table class="table">
        <thead>
            <tr>
                <th scope="col" class='py-1 px-1 col-2'>#</th>
                <th scope="col" class='py-1 px-1 col-9'>Country</th>
                <th scope="col" class='py-1 px-1 col-1'></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $countries = getCountries();
                for ($i = 0; $i < count($countries); $i++) {
                    echo "<tr>";
                    echo "<td class='py-1 px-1 col-2'>" . ($i + 1) . "</td>";
                    echo "<td class='py-1 px-1 col-9'>" . $countries[$i]["country"] . "</td>";
                    echo "<td class='py-1 px-1 col-1'><input value='" . $countries[$i]["id"] . "' type='checkbox' name='selectedCountries[]' class='checkboxCountry'></td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
    <div class="row">
        <div class="d-flex flex-column justify-content-end col-lg-6 col-sm-6 mt-2">
            <input type="text" class="form-control text-center" placeholder="Country" name="country">
            <input class="btn" type="submit" value="Add" name="addCountry">
        </div>
        <div class="d-flex flex-column justify-content-end col-lg-6 col-sm-6 mt-2">
            <input type="text" id="deleteCountryInfo" class="form-control text-center" value="Select countries"
                style="color: orangered;" disabled>
            <input class="btn" type="submit" value="Delete" name="deleteCountry" id="deleteCountry" disabled>
        </div>
    </div>
</form>
<?php
}
?>