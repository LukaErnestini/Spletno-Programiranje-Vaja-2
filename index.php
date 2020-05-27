<?php

require 'vendor/autoload.php';
require 'core/bootstrap.php';

use App\Core\{App, Request, Router};

Router::load('app/routes.php') //chaining
  ->direct(Request::uri(), Request::method());

App::bind('siteRoot', realpath(dirname(__FILE__)));

/* $router = Router::load('routes.php');
require = $router->direct($uri); */