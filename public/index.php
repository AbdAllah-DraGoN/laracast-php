<?php

use Core\Session;
use Core\ValidationException;

const PUBLIC_PATH = __DIR__;
const BASE_PATH = __DIR__ . "/../";
const MAIN_WEBSITE_URL = 'localhost/php/learn-from-english/public';



session_start();

require(BASE_PATH . "Core/functions.php"); 

require BASE_PATH . "vendor/autoload.php";

// require base_path("Response.php");
// require base_path("Core/Database.php");
// 

// spl_autoload_register(function($class){
//   $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  
//   require base_path("{$class}.php");
// });

require base_path("views/bootstrap.php");

// require base_path("Core/Router.php");
$router = new \Core\Router();

$routes = require base_path("routes.php");

$path = str_replace("/php/learn-from-english/public", '', $_SERVER['REQUEST_URI']);
$uri = parse_url($path)["path"];


$method =  $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
  
  $router->route($uri, $method);

} catch (ValidationException $exception) {

  Session::flash('errors', $exception -> errors);
  Session::flash('old', $exception -> old);
  
  return redirect($router->previousUrl());
}



Session::unflash();