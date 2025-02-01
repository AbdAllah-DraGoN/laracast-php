<?php
/* return [
  "/" => 'controlers/index.php',
  "/about" => 'controlers/about.php',
  "/notes" => 'controlers/notes/index.php',
  "/note" => 'controlers/notes/show.php',
  "/notes/create" => 'controlers/notes/create.php',
  "/contact" => 'controlers/contact.php' ]; 
*/




// Main Pages
$router->get("/", 'index.php');
$router->get("/about", 'about.php');
$router->get("/contact", 'contact.php');
$router->get("/notes", 'notes/index.php')->only('auth');


// CRUD Operations for Notes
$router->get("/note", 'notes/show.php');
$router->delete("/note", 'notes/destroy.php');

$router->get("/notes/create", 'notes/create.php');
$router->post("/notes", 'notes/store.php');

$router->get("/note/edit", 'notes/edit.php');
$router->patch("/note", 'notes/update.php');


// Registeration 
$router->get("/register", 'registeration/create.php')->only('guest');
$router->post("/register", 'registeration/store.php')->only('guest');


// Session
$router->get("/login", 'session/create.php')->only('guest');
$router->post("/session", 'session/store.php')->only('guest');
$router->delete("/session", 'session/destroy.php')->only('auth');


