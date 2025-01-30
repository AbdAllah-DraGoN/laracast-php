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
$router->get("/", 'controlers/index.php');
$router->get("/about", 'controlers/about.php');
$router->get("/contact", 'controlers/contact.php');
$router->get("/notes", 'controlers/notes/index.php')->only('auth');


// CRUD Operations for Notes
$router->get("/note", 'controlers/notes/show.php');
$router->delete("/note", 'controlers/notes/destroy.php');

$router->get("/notes/create", 'controlers/notes/create.php');
$router->post("/notes", 'controlers/notes/store.php');

$router->get("/note/edit", 'controlers/notes/edit.php');
$router->patch("/note", 'controlers/notes/update.php');


// Registeration 
$router->get("/register", 'controlers/registeration/create.php')->only('guest');
$router->post("/register", 'controlers/registeration/store.php')->only('guest');


// Session
$router->get("/login", 'controlers/session/create.php')->only('guest');
$router->post("/session", 'controlers/session/store.php')->only('guest');
$router->delete("/session", 'controlers/session/destroy.php')->only('auth');


