<?php
session_start();
/** @var array $userAccounts */
//if the is no ID fetched from the database, re-direct the person to the login page.
//if that's not the case, the user can come into their own index page.
if (!$_SESSION['id']) {
    header("Location: login.php");
    exit;
}
require_once "user-data.php";

?>
<!--Index when the user logs into their account-->
<!doctype html>
<html lang="en">
<head>
    <title>Index Accounts</title>
    <meta charset="utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<h1>Index account</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
<!--   From the user-data.php, is the variables $userAccount fetched from the database.
       This will be read in horizontal tables, the id, username, name, email-->
    <?php foreach ($userAccounts as $userAccount) { ?>
        <tr>
            <td><?= $userAccount['id']; ?></td>
            <td><?= $userAccount['username']; ?></td>
            <td><?= $userAccount['name']; ?></td>
            <td><?= $userAccount['email']; ?></td>

<!--   Redirect to update en delete-->
            <td><a href="update.php?id=<?= $userAccount['id']; ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $userAccount['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<!--   logout redirect-->
<a href="./logout.php">Log out</a>
</body>
</html>
