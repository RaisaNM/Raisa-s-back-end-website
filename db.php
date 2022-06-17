<?php
//database info
$host     = "localhost";
$user     = "root";
$password = "";
$database = "prg2";

//Creates connection and then checks the connections if one of the variables isn't correct.
$db = mysqli_connect($host, $user, $password, $database) or die("Error: " . mysqli_connect_error());

