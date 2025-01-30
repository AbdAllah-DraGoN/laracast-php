<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);


$currentUserId = 8;

// find the corresponding note
$note = $db -> query(
  "SELECT * FROM notes WHERE id = :id ",
[
  'id' => $_POST['id']
]) -> findOrFail();

// authorize that the current user can edit the note
authorize($note['user_id'] === $currentUserId);



$db = App::resolve(Database::class);


// validate the form
$errors = [];

if (!Validator::string($_POST['body'], 1, 100)) {
  $errors['body'] = 'A body of no more than 100 characters is required.';
}

// if there are errors, show the form with the errors
if (count($errors)) {
  return view("notes/edit.view.php",[
  'heading' => 'Edit Note',
  'errors' => $errors,
  'note' => $note,
  ]);
}

// if no validation errors, update the record in the notes database table.
$db -> query("UPDATE notes SET body = :body WHERE id = :id",[ 
  'id' => $_POST['id'],
  'body' => $_POST['body'],
]);

// redirect user to the notes index page
header('location: /php/learn-from-english/public/notes');
die();
