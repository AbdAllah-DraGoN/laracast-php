<?php

use Core\App;
use Core\Validator;
use Core\Database;


$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs.
$errors = [];

if(!Validator::email($email)){
  $errors['email'] = 'Please Provide a valid email address.';
}

if(!Validator::string($password, 6, 24)){
  $errors['password'] = 'Please Provide a password between 6 and 24 characters.';
}
if (! empty($errors)) {
  return view("registeration/create.view.php",[
    'errors' => $errors,
  ]);
}


$db = App::resolve(Database::class);
// check if the account already exists.
$user = $db -> query("SELECT * FROM users WHERE email = :email",[
  'email' => $email
]) -> find();

if($user){
  // if yes, redirect to the login page.
  redirect("/");
}else {
  // if not, save the account to the database, and then log the user in, and redirect.
  $db -> query("INSERT INTO users(email, password) VALUES (:email, :password)",[
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT),
  ]);

  // mark that the user has logged in.
  login($user); 

  redirect("/");
}


  