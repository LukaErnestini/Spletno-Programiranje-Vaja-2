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
$router->get('mojiOglasi', 'PagesController@mojiOglasi');
$router->get('oglasEdit', 'OglasController@edit');
$router->get('objavi', 'OglasController@objava');


$router->post('users', 'UsersController@store');
$router->post('prijava', 'UporabnikController@prijavi');
$router->post('registracija', 'UporabnikController@registriraj');
$router->post('oglasEdit', 'OglasController@submitEdit');
$router->post('objavi', 'OglasController@store');