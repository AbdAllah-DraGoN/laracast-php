<?php
use Core\Response;

function dd($data){
  echo "<pre>";
  var_dump($data);
  echo "</pre>";
  die();
}

function urlIs($value){
  $request = str_replace("/php/learn-from-english/public", '', $_SERVER['REQUEST_URI']);
  return $request === $value ;
}
function abort($code = 404 ){

  $error_messages = [

    404 => "Sorry. Page Not Found",
    403 => "You are not authorized to view this Page.",

  ];

  http_response_code($code);  

  if ($code == 404 || $code == 403 ) {

    $error_message = $error_messages[$code];

    require base_path("views/error.php");

  } 

  die();
}
function authorize($condition , $state = Response::FORBIDDEN){
  
  if (! $condition) {

    abort($state);

  }

}



function base_path($path){
  
  return BASE_PATH . $path;

}

function view($path, $attributes = []){

  extract($attributes);

  require base_path('views/' . $path);
  
}


function login($user){
  $_SESSION['user'] = [
    'email' => $user['email'],
  ];

  session_regenerate_id(true);
}

function logout(){
  
  $_SESSION = [];
  session_destroy();

  $params = session_get_cookie_params();
  setcookie(
    session_name(),
    '',
    time() - 3600,
    $params['path'],
    $params['domain'],
    $params['secure'],
    $params['httponly']
  );

}