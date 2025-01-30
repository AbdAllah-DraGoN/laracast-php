<?php

namespace Core;

class App
{
  protected static $container;

  public static function setContaier($container)
  {
    static::$container = $container;
  }

  public static function container()
  {
    return static::$container;
  }

  public static function bind($key)
  {
    static::container()->bind($key);
  }
  
  public static function resolve($key)
  {
    return static::container()->resolve($key);
  }
}