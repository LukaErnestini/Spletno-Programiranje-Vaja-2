<?php

class UsersController
{
  public function index()
  {
    $users = App::get('database')->selectAll('users');

    return view('users', compact('users'));
  }

  public function store()
  {
    App::get('database') -> insert('users', $_POST);

    return redirect('users');
  }
}