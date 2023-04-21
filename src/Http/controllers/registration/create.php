<?php

use Core\Session;

$heading = 'Register';

view('registration/create.view.php', [
  'heading' => $heading,
  'errors' => Session::get('errors')
]);
