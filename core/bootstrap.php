<?php

use App\Core\App;

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
  Connection::make(App::get('config')['database'])
));

function view($name, $data = [])
{
  extract($data); //iz array-a ustvari spremenljivke
  return require "app/views/{$name}.view.php";
}

function redirect($path)
{
    // Send HTTP header https://my.bluehost.com/hosting/help/241
    header("Location: /{$path}");
}