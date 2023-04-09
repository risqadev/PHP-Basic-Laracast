<?php

$config = require 'config.php';
$db = new Database($config['database']);

$notes = $db->query("select id, body, user_id from notes where user_id = :id", [':id' => $_GET['user']])->fetchAll();

$heading = 'My Notes';

require 'views/notes.view.php';