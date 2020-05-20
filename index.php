<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';

Router::load('routes.php') //chaining
  ->direct(Request::uri(), Request::method());

/* $router = Router::load('routes.php');
require = $router->direct($uri); */