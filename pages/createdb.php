<?php
include_once("functions.php");
$link = connect();
$q1 = "CREATE TABLE Countries(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    country varchar(32) UNIQUE) default charset='utf8'";

$q2 = "CREATE TABLE Cities(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    city varchar(32),
    countryId int,
    FOREIGN KEY (countryId) REFERENCES Countries(id) ON DELETE CASCADE,
	uCity varchar(64),
    UNIQUE INDEX uCity(id, countryId)
) default charset='utf8'";

$q3 = "CREATE TABLE Hotels(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hotel varchar(64),
    countryId int,
    FOREIGN KEY (countryId) REFERENCES Countries(id) ON DELETE CASCADE,
    cityId int,
    FOREIGN KEY (cityId) REFERENCES Cities(id) ON DELETE CASCADE,
    stars int,
    cost double,
    info varchar(1024)
   ) default charset='utf8'";

$q4 = "CREATE TABLE Images(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hotelId int,
    FOREIGN KEY (hotelId) REFERENCES Hotels(id) ON DELETE CASCADE,
    imagepath varchar(255)
   ) default charset='utf8'";

$q5 = "CREATE TABLE Roles(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role varchar(32) UNIQUE
   ) default charset='utf8'";

$q6 = "CREATE TABLE Users(
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login varchar(30) UNIQUE,
    pass varchar(128),
    email varchar(64),
    roleId int,
    FOREIGN KEY (roleId) REFERENCES Roles(id) on DELETE CASCADE,
    discount int,
    avatar mediumblob
   ) default charset='utf8'";

mysqli_query($link, $q1);
$error = mysqli_errno($link);
if ($error) {
    echo "<h3 align='center' style='color: red'>Query 1: " . $error . "</h3>";
    exit();
}
mysqli_query($link, $q2);
$error = mysqli_errno($link);
if ($error) {
    echo "<h3 align='center' style='color: red'>Query 2: " . $error . "</h3>";
    exit();
}
mysqli_query($link, $q3);
$error = mysqli_errno($link);
if ($error) {
    echo "<h3 align='center' style='color: red'>Query 3: " . $error . "</h3>";
    exit();
}
mysqli_query($link, $q4);
$error = mysqli_errno($link);
if ($error) {
    echo "<h3 align='center' style='color: red'>Query 4: " . $error . "</h3>";
    exit();
}
mysqli_query($link, $q5);
$error = mysqli_errno($link);
if ($error) {
    echo "<h3 align='center' style='color: red'>Query 5: " . $error . "</h3>";
    exit();
}
mysqli_query($link, $q6);
$error = mysqli_errno($link);
if ($error) {
    echo "<h3 align='center' style='color: red'>Query 6: " . $error . "</h3>";
    exit();
}

echo "<h3 align='center' style='color: green'>База создана успешно!</h3>";