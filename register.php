<!--Form to add an account to the website-->
<?php
//STEP 1: Database is required to post the user's new account into the database.
if (isset($_POST['submit'])){
    require_once "db.php";

//STEP 2: The required varaiables are sorted in which row of the database will be POSTED.
    // the values will go through a check that removes special characters to avoid SQL injections
    $name = mysqli_escape_string($db, $_POST['name']);
    $username = mysqli_escape_string($db, $_POST['username']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = mysqli_escape_string($db, $_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//STEP 3: Validation if data is correct or not filled in
    require_once "form-validation.php";

//STEP 4: Saves inserted data from the users
    if (empty($errors)){
        //4.1: Values of the asked variables will be insert into the database.
        $query= "INSERT INTO users (name, username, email, password)
                VALUES ('$name','$username','$email','$hashedPassword')";
        $result = mysqli_query($db, $query) or die('Error: ' . $query);

        //4,2: if there is result, the user will be send to the settings page where the confirmation email will be send.
        if ($result) {
            header('Location: PHPMailer-master/settings.php');
            exit;
        //4.3: If there is no result, there will be an error message given about the database not being connected.
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
        //4.4: Close connection with the satabase
        mysqli_close($db);
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Register user</title>
  </head>
  <body>
    <h1>Register here!</h1>
    <h2>Fill in your personal details down below. </h2>
    <div class = "container">
      <a href="login.php">Already have an account? Login here!</a>

<!--        Form for required information to be filled in value for the database  -->
      <form action="" method="post" enctype="multipart/form-data">
          <div class="data-field">
              <label for="name" class="form-label">Name</label>
<!--            Value of the inputs are checked with isset to see if the variable isn't 0-->
<!--            Using "htmlentities" for protection of hmtl injections-->
              <input type="text" name="name" class="form-control" id="name" value="<?= isset($name) ? htmlentities($name) : '' ?>">
<!--            Class errors only appear if the input is empty-->
              <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
              <div id="title" class="form-text">Insert your name here.</div>
          </div>
          <div class="data-field">
              <label for="username" class="form-label">Username</label>
              <input type="text" name="username" class="form-control" id="username" value = "<?= isset($username) ? htmlentities($username) : '' ?>">
              <span class="errors"><?= isset($errors['username']) ? $errors['username'] : '' ?></span>
              <div id="username" class="form-text">Insert your username here.</div>
          </div>
          <div class="data-field">
              <label for="email" class="form-label">Email</label>
              <input type="email" name= "email" class="form-control" id="email" value="<?= isset($email) ? htmlentities($email) : '' ?>">
              <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
              <div id="email" class="form-text">Insert your email here.</div>
          </div>
          <div class="data-field">
              <label for="password" class="form-label">Password</label>
              <input type="password" name= "password" class="form-control" id="password" value="<?= isset($password) ? htmlentities($password) : '' ?>">
              <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
              <div id="password" class="form-text">Insert your password here.</div>
          </div>
          <input type="submit" name="submit">
      </form>

  </div>
  </body>
</html>