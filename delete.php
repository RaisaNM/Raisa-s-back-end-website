<?php
/** @var mysqli $db */
//require DB to get de userId their data of the person who si logged in.
require_once "db.php";

//userId becomes the ID that you get with super global GET from DB
$userId = $_GET['id'];

//Remove from the database using a query.
//usage of mysqli_escape_string so no injections can take place within the query and in the database.
$query = "DELETE FROM users WHERE id = " . mysqli_escape_string($db, $userId);
//if there is a problem with the queary, it gives an error, if not the query has suceeded.
mysqli_query($db, $query) or die ('Error: ' . mysqli_error($db));

//Close connection
mysqli_close($db);

//Redirect to register page after deleting the ID and data from the user.
header("Location: register.php");
exit;
