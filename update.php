<?php
//Updates the information inside the database after values are in the inputs and submitted.
/**
 * @var mysqli $db
 * @var array $username
 */

//Step 1: Require Database
require_once "db.php";

//Step 2:if the form is submitted, the value changes
if (isset($_POST['submit'])){
    //Gets the ID from the DB
    $userId = mysqli_escape_string($db, $_GET['id']);
    //using POST to insert the new data inside the tables of the database,
    $username = mysqli_escape_string($db, $_POST['username']);
    $name = mysqli_escape_string($db, $_POST['name']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $password= mysqli_escape_string($db, $_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //Step 3: Update the users table with new information in the database
        $query = "UPDATE users
                  SET username = '$username', name = '$name', email = '$email', password = '$hashedPassword' 
                  WHERE id = '$userId'";
        $result = mysqli_query($db, $query);

     //Step 4: If the data reached the database (result), user will be send to the index.php
     //If there is no data reached in the database, give error about the query
        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
            }
    } else if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT id, name, username, email FROM users WHERE id = '$id'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
    } else {
        header('Location: index.php');
        exit();
    }
    } else {
        header('Location: index.php');
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Update Details</title>
</head>
    <body>
        <div class ="page-header">
            <h1>Update your details </h1>
            <div class="page-header">
                <h2>Here you can update your information details.</h2>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="data-field">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?= $user['name']; ?>"">
                    <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                    <div id="title" class="form-text">Insert your name here.</div>
                </div>
                <div class="data-field">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" value = "<?= $user['username']; ?>"">
                    <span class="errors"><?= isset($errors['username']) ? $errors['username'] : '' ?></span>
                    <div id="username" class="form-text">Insert your username here.</div>
                </div>
                <div class="data-field">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name= "email" class="form-control" id="email" value="<?= $user['email']; ?>"">
                    <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                    <div id="email" class="form-text">Insert your email here.</div>
                </div>
                <div class="data-field">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name= "password" class="form-control" id="password">
                    <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                    <div id="password" class="form-text">Insert your password here.</div>
                </div>
                <input type="submit" name="submit">
            </form>

        </div>
    </body>
</html>
