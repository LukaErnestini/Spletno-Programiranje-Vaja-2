<?php 

$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');
$router->get('users', 'UsersController@index');
$router->get('prijava', 'PagesController@prijava');
$router->get('oglas', 'OglasController@show');
$router->get('prijava', 'UporabnikController@prijava');
$router->get('odjava', 'UporabnikController@odjava');
$router->get('registracija', 'UporabnikController@registracija');


$router->post('users', 'UsersController@store');
$router->post('prijava', 'UporabnikController@prijavi');
$router->post('registracija', 'UporabnikController@registriraj');