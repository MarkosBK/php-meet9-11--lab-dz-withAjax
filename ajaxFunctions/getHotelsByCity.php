<?php
include_once("../pages/functions.php");
$link = connect();
$cityId = $_POST['cityId'];
$q = "SELECT * FROM Hotels where cityId='$cityId'";
$query = mysqli_query($link, $q);
$result['hotel'] = [];
$result['image'] = [];
while ($row = mysqli_fetch_assoc($query)) {
    $image = getImagesByHotel($row['id'])[0];
    array_push($result['hotel'], $row);
    array_push($result['image'], $image);
}
echo json_encode($result);