<?php
session_start();
/** @var mysqli $db */
//requires database
require_once "db.php";

//STEP 1: Check if user is logged in, else move to index page of the user
if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}
//STEP 2: Validates the form of the login after clicking the submit button.
if (isset($_POST['submit'])) {
    //Retrieve values that are in the inputs (see the html code below)
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    // Goes into the database to fetch the email
    $query = "SELECT *
              FROM users
              WHERE email = '$email'";
    $result = mysqli_query($db, $query) or die('Error: '.$query);
    $username = mysqli_fetch_assoc($result);

    //STEP 3:
    //Check if email exists in database
    //if yes: the password linked with the e-mail will be checked.
    //if not: you will get an error.
    $errors = [];
    if ($username) {
        //Validate password (make sure you hash the password if you use password_verify)
        if (password_verify($password, $username['password'])) {
            $_SESSION['id'] = $username['id'];
            //Redirect to index.php if everything is correct
            header("Location: index.php");
            exit;
        } else {
            echo $errors[] = 'Uw logingegevens zijn onjuist';
        }
    } else {
        echo "Uw logingegevens zijn onjuist";
    }
}
?>

<!--login page when the user logs into their account.-->
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login user</title>
</head>
<body>
<h1>Login here!</h1>
<h2>Fill in your personal details down below to login. </h2>
<div class = "container">
<!-- Request a link that is tied to the users login, this is based on the email.  -->
    <form id="login" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
        <div>
            <label for="email">E-mail</label>
<!--        Checks if the email in the input is there or not    -->
            <input type="email" name="email" id="email" value="<?= (isset($email) ? htmlentities($email) : ''); ?>"/>
        </div>
        <div>
            <label for="password">Wachtwoord</label>
            <input type="password" name="password" id="password"/>
        </div>
        <input type="submit" name="submit">
    </form>
    <a href="register.php">Register</a>
</div>

</body>
</html>
