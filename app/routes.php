<?php 

$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');
$router->get('users', 'UsersController@index');
$router->get('prijava', 'PagesController@prijava');
$router->get('oglas', 'OglasController@show');

$router->post('users', 'UsersController@store');