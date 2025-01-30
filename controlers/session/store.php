<?php

use Core\App;
use Core\Validator;
use Core\Database;

$db = App::resolve(Database::class); 


$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs.
$errors = [];

if(!Validator::email($email)){
  $errors['email'] = 'Please Provide a valid email address.';
}

if(!Validator::string($password)){
  $errors['password'] = 'Please Provide a valid password';
}
if (! empty($errors)) {
  return view("session/create.view.php",[
    'errors' => $errors,
  ]);
}



// match the credentials.

$user = $db -> query("SELECT * FROM users WHERE email = :email",[
  'email' => $email
]) -> find();


if ($user) {
  // check if the password is correct.
  if (password_verify($password, $user['password'])) {
    login($user); 
    
    header('location: /php/learn-from-english/public');
    exit();
  }
}


return view("session/create.view.php",[
  'errors' => [
    'email' => 'No Mathcing account found for that email address and password.'
  ],
]);





