<?php
/** @var mysqli $db */
//Require the database
require_once "db.php";

//starts session when ID is given after login in (see login.php).
$id = $_SESSION['id'];
//Selects the id in row id's in the database from users/
$query = "SELECT * 
          FROM users
          WHERE id = '$id'";
$result = mysqli_query($db, $query);

//Results of the ID gets fetched and put as an array in a row
$userAccounts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $userAccounts[] = $row;
}

//Close connection
mysqli_close($db);
