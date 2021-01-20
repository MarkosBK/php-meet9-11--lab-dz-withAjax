<?php
function connect($host = "localhost", $user = "root", $pass = "root", $dbname = "traveldb")
{
    $link = mysqli_connect($host, $user, $pass) or die("Failed connect to server");
    mysqli_select_db($link, $dbname) or die("Failed connet to database");
    mysqli_query($link, "set names 'utf-8'");
    return $link;
}

$link = connect();

function register($login, $pass, $email)
{
    global $link;
    $login = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));
    if ($login == "" || $pass == "" || $email == "") {
        echo "<h3 align='center' style='color: red'>Query 6: Не все поля заполнены!</h3>";
        return false;
    }
    if (strlen($login) < 3 || strlen($login) > 30) {
        echo "<h3 align='center' style='color: red'>Query 6: Логин должен быть от 3 до 30 символов!</h3>";
        return false;
    }
    $ins1 = "INSERT INTO users (login, pass, email, roleId) VALUES ('" . $login . "', '" . md5($pass) . "', '" . $email . "', 2)";
    mysqli_query($link, $ins1);
    $error = mysqli_errno($link);
    if ($error) {
        if ($error == 1062) {
            echo "<h3 align='center' style='color: red'>Пользователь с таким логином существует</h3>";
            return false;
        } else {
            echo "<h3 align='center' style='color: red'>Произошла ошибка: " . $error . "</h3>";
            return false;
        }
    }
    return true;
}

function getUsers()
{
    global $link;
    $q = "SELECT * FROM Users";
    $query = mysqli_query($link, $q);
    $users = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($users, $row);
    }
    return $users;
}

function getUserByLogin($login)
{
    global $link;
    $q = "SELECT * FROM Users where login='$login' LIMIT 1";
    $query = mysqli_query($link, $q);
    $user = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($user, $row);
    }
    return $user;
}

function authorization($login, $pass)
{
    $userDb = getUserByLogin($login);
    if (count($userDb) > 0) {
        if ($userDb[0]['pass'] === md5($pass)) {
            $_SESSION['userLogin'] = $login;
            if (getRoleById($userDb[0]['roleId'])['role'] == "Admin") {
                $_SESSION['admin'] = $login;
            }
        } else {
            echo "<h3 align='center' style='color: red'>Неверный пароль</h3>";
            return false;
        }
    }
    return true;
}

function checkAuthorization()
{
    if (strlen($_SESSION["userLogin"]) > 0) {
        return true;
    }
    return false;
}

function getRoleById($roleId)
{
    global $link;
    $q = "SELECT role FROM Roles where id='$roleId'";
    $query = mysqli_query($link, $q);
    $role = mysqli_fetch_assoc($query);
    return $role;
}


function getCountries()
{
    global $link;
    $q = "SELECT * FROM Countries";
    $query = mysqli_query($link, $q);
    $countries = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($countries, $row);
    }
    return $countries;
}

function addCountry($country)
{
    trim(htmlspecialchars($country));
    global $link;
    if (strlen($country) <= 0) return false;
    if ($country == "") return false;
    $q = "INSERT INTO Countries(country) VALUES ('$country')";
    $query = mysqli_query($link, $q) or die("Ошибка " . mysqli_errno($link));;
    return true;
}

function deleteCountry($countriesId)
{
    global $link;
    foreach ($countriesId as $value) {
        $q = "DELETE FROM Countries WHERE id='$value'";
        $query = mysqli_query($link, $q) or die("Ошибка " . mysqli_errno($link));;
    }
    return true;
}

function getCities()
{
    global $link;
    $q = "SELECT * FROM Cities";
    $query = mysqli_query($link, $q);
    $cities = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($cities, $row);
    }
    return $cities;
}

function getCountryById($countryId)
{
    global $link;
    $q = "SELECT * FROM Countries where id='$countryId'";
    $query = mysqli_query($link, $q);
    $country = mysqli_fetch_assoc($query);
    return $country;
}

function deleteCity($citiesId)
{
    global $link;
    foreach ($citiesId as $value) {
        $q = "DELETE FROM Cities WHERE id='$value'";
        $query = mysqli_query($link, $q) or die("Ошибка " . mysqli_errno($link));
    }
    return true;
}

function addCity($city, $countryId)
{
    trim(htmlspecialchars($city));
    global $link;
    if (strlen($city) <= 0) return false;
    if ($city == "") return false;
    $q = "INSERT INTO Cities(city, countryId) VALUES ('$city','$countryId')";
    $query = mysqli_query($link, $q) or die("Ошибка " . mysqli_errno($link));
    return true;
}

function getHotels()
{
    global $link;
    $q = "SELECT * FROM Hotels";
    $query = mysqli_query($link, $q);
    $hotels = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($hotels, $row);
    }
    return $hotels;
}

function getCityById($cityId)
{
    global $link;
    $q = "SELECT * FROM Cities where id='$cityId'";
    $query = mysqli_query($link, $q);
    $city = mysqli_fetch_assoc($query);
    return $city;
}

function getCitiesByCountry($countryId)
{
    global $link;
    $q = "SELECT * FROM Cities where countryId='$countryId'";
    $query = mysqli_query($link, $q);
    $cities = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($cities, $row);
    }
    return $cities;
}

function addHotel($hotel, $countryId, $cityId, $stars, $cost, $info)
{
    $hotel = trim(htmlspecialchars($hotel));
    $info = trim(htmlspecialchars($info));
    $stars = trim(htmlspecialchars($stars));
    $cost = trim(htmlspecialchars($cost));
    global $link;
    if (strlen($hotel) <= 0) return false;
    if ($hotel == "") return false;
    if ($cost < 0) return false;
    if ($stars < 1) return false;
    $stars = intval($stars);
    $cost = doubleval($cost);
    $q = "INSERT INTO Hotels(hotel, countryId, cityId, stars, cost, info) VALUES ('$hotel','$countryId','$cityId','$stars','$cost','$info')";
    $query = mysqli_query($link, $q) or die("Ошибка " . mysqli_errno($link));
    return true;
}

function deleteHotel($hotelsId)
{
    global $link;
    foreach ($hotelsId as $value) {
        $q = "DELETE FROM Hotels WHERE id='$value'";
        $query = mysqli_query($link, $q) or die("Ошибка " . mysqli_errno($link));
    }
    return true;
}

function getImagesByHotel($hotelId)
{
    global $link;
    $q = "SELECT * FROM Images where hotelId='$hotelId'";
    $query = mysqli_query($link, $q);
    $images = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($images, $row);
    }
    return $images;
}

function addImage($hotelId, $images)
{
    global $link;
    for ($i = 0; $i < count($images["input__file"]["name"]); $i++) {
        if ($images && $images["input__file"]["error"][$i] == UPLOAD_ERR_OK) {
            $imgName = $images["input__file"]["name"][$i];
            $imgName = str_replace(" ", "_", $imgName);
            if (!file_exists("files/" . $imgName)) {
                move_uploaded_file($images["input__file"]["tmp_name"][$i], "files/" . $imgName);
            }
            $imgName = "files/" . $imgName;
            $q = "INSERT INTO Images(hotelId, imagepath) VALUES ('$hotelId','$imgName')";
            $query = mysqli_query($link, $q) or die("Ошибка " . mysqli_errno($link));
        }
    }
    return true;
}

function deleteImage($imagesId)
{
    global $link;
    foreach ($imagesId as $value) {
        $q = "DELETE FROM Images WHERE id='$value'";
        $query = mysqli_query($link, $q) or die("Ошибка " . mysqli_errno($link));
    }
    return true;
}

function getHotelsByCity($cityId)
{
    global $link;
    $q = "SELECT * FROM Hotels where cityId='$cityId'";
    $query = mysqli_query($link, $q);
    $hotels = [];
    while ($row = mysqli_fetch_assoc($query)) {
        array_push($hotels, $row);
    }
    return $hotels;
}

function getHotelsById($hotelId)
{
    global $link;
    $q = "SELECT * FROM Hotels where id='$hotelId'";
    $query = mysqli_query($link, $q);
    $hotel = mysqli_fetch_assoc($query);
    return $hotel;
}

function moveToAdmins($userId, $file)
{
    global $link;
    if ($userId == 0) exit();
    $fn = $_FILES['avatar']['tmp_name'];
    $file = fopen($fn, 'rb');
    $img = fread($file, filesize($fn));
    fclose($file);
    $img = mysqli_real_escape_string($link, $img);
    $q = "UPDATE Users SET avatar='" . $img . "', roleId=1 WHERE id =" . $userId;
    mysqli_query($link, $q);
    $err = mysqli_errno($link);
    if ($err) {
        echo "<h3 align='center' style='color: red'>SQL error: " . $err . "</h3>";
        return false;
    }
    return true;
}