<div class="container-fluid d-flex flex-column" style="height: 100%;">
    <h1 align='center' class="title" style="height: 50px;">HOTELS</h1>
    <div class="container-fluid d-flex" style="height: 40px;">
        <div class="mr-1" style="width: 200px;">
            <select id="countryTourSelect" class="form-control text-center" name="countryHotelId"
                onchange="getCitiesByCountry(this.value, this.id)">
                <option value="0" disabled>Select country</option>
                <?php
                $countries = getCountries();
                for ($i = 0; $i < count($countries); $i++) {
                    if ($i === 0)
                        echo "<option selected value='" . $countries[$i]["id"] . "'>" . $countries[$i]["country"] . "</option>";
                    else
                        echo "<option value='" . $countries[$i]["id"] . "'>" . $countries[$i]["country"] . "</option>";
                }
                ?>
            </select>
        </div>
        <div id="divCityHotelSelect" class="ml-1" style="width: 200px;">
            <select class='form-control text-center' id='cityHotelSelect' name='cityHotelId'
                onchange="getHotelsByCity(this.value)">
            </select>
        </div>
    </div>

    <div class="container-fluid" id="HotelsList">

    </div>
</div>