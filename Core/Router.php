<?php

namespace Core;

use Core\Middleware\Middleware;

class Router {

  protected $routes = [];

  public function add($method, $uri, $controller)
  {
    // this is the same as the line below but this shorthand 
    // $this->routes[] = compact('method', 'uri', 'controller');

    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => strtoupper($method),
      'middleware' => null
    ];
    return $this; // this is to allow chaining by other methods in the class
  }


  public function get($uri, $controller)
  {
    return $this->add('GET', $uri, $controller); // this is to allow chaining by other methods in the class
  }

  public function post($uri, $controller)
  {
    return $this->add('POST', $uri, $controller);
  }

  public function delete($uri, $controller)
  {
    return $this->add('DELETE', $uri, $controller);
  }

  public function patch($uri, $controller)
  {
    return $this->add('PATCH', $uri, $controller);
  }

  public function put($uri, $controller)
  {
    return $this->add('PUT', $uri, $controller);
  }

  
  public function only($key)
  {
    $this-> routes[array_key_last($this->routes)]['middleware'] = $key;
    return $this;
  }

  public function route($uri, $method = 'GET')
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
        
        Middleware::resolve($route['middleware']);

        return require base_path($route['controller']);
      }
    }

    $this->abort(404);
  }

  

  protected function abort($code = 404 ){

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

  
}
