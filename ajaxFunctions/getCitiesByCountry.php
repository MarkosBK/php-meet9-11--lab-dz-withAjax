<?php
include_once("../pages/functions.php");
$link = connect();
$countryId = $_POST['countryId'];
$q = "SELECT * FROM Cities where countryId='$countryId'";
$query = mysqli_query($link, $q);
$result = "<option value='0' disabled>Select city</option>";
while ($row = mysqli_fetch_assoc($query)) {
    $result .= "<option value='" . $row["id"] . "'>" . $row["city"] . "</option>";
}

echo $result;