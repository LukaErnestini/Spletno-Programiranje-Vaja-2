<?php

namespace App\Core;

class Router {
  
  public $routes = [
    'GET' => [],
    'POST' => []
  ];

  public static function load($routesFile) {
    $router = new static; //kot new self alpa new Router

    require $routesFile;

    // se ne da, ker je staticna metoda, ni instancna metoda, ki bi imela access na $this
    //return $this;
    return $router;
  }

  public function direct($uri, $requestType) {
    if (array_key_exists($uri, $this->routes[$requestType])) {

      return $this->callAction(
        ...explode('@', $this->routes[$requestType][$uri]) // ... <- SPLAT OPERATOR
        // ce imamo array in uporabimo splat operator za array podat funkciji,
        // bo vsak element podan kot en argument funkciji
      );
    }

    throw new \Exception('No route defined for this URI: ' . $uri);
  }

  public function get($uri, $controller)
  {
    $this->routes['GET'][$uri] = $controller;
  }

  
  public function post($uri, $controller)
  {
    $this->routes['POST'][$uri] = $controller;
  }

  protected function callAction($controller, $action) //protected ker se klice samo znotraj classa
  {
    // die(var_dump($controller, $action));
    $controller = "App\Controllers\\{$controller}";
    $controller = new $controller;
    
    if (!method_exists($controller, $action)) {
      throw new \Exception("{$controller} doesn't respond to the {$action} action.");
    }

    return $controller->$action();
  }

}
