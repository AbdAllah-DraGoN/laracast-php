<?php

namespace Core; 

class Container 
{

  protected $bindings = [];

  public function bind($key, $resolver)
  {
    $this->bindings[$key] = $resolver;
  }
  
  public function resolve($key)
  {

    if(! isset($this->bindings[$key])) {
      throw new \Exception("No matching binding found for {$key}");
    }

    $resolver = $this->bindings[$key];

    return call_user_func($resolver);
    
  }

}