<?php
// checking if data is validated or not
$errors = [];
if ($name == "") {
    $errors['name'] = 'Name cannot be empty';
}
if ($username == "") {
    $errors['username'] = 'Username cannot be empty';
}
if ($email == "") {
    $errors['email'] = 'Email cannot be empty';
}
if ($password == "") {
    $errors['password'] = 'Password cannot be empty';
}