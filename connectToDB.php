<?php

$username = "gkrgedon_adaevent_su";
$password = "adaevent123456";
$hostname = "localhost";

$dbhandle = mysqli_connect($hostname, $username, $password) or die(mysqli_error());
$selected = mysqli_select_db($dbhandle,"gkrgedon_adaevent_db") or die(mysqli_error($dbhandle));

?>