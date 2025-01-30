<?php

// comment this line because (spl_autoload_register) function replace it
// require base_path("Validator.php");

use Core\Validator ;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$errors = [];

// dd(Validator::email('dsss@gs.d'));
if (!Validator::string($_POST['body'], 1, 100)) {
  $errors['body'] = 'A body of no more than 100 characters is required.';
}

if (! empty($errors)) {
  return view("notes/create.view.php",[
  'heading' => 'Create Note',
  'errors' => $errors,
  ]);
}


$query = "INSERT INTO notes(body, user_id) VALUES (:body, :user_id)";
$db -> query($query,[ 
  'body' => $_POST['body'],
  'user_id' => 8
]);

header('location: /php/learn-from-english/public/notes');
die();
