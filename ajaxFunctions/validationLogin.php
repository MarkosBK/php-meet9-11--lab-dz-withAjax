<?php
include_once("../pages/functions.php");
$link = connect();
$login = $_POST['login'];
$q = "SELECT login FROM Users where login='" . $login . "'";
$query = mysqli_query($link, $q);
echo mysqli_num_rows($query);