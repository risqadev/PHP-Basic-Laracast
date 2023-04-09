<?php

require 'functions.php';
// require 'router.php';
require 'Database.php';

$config = require 'config.php';

$db = new Database($config['database']);


$id = $_GET['id'];

$posts = $db->query("select * from posts where id = :id", [':id' => $id])->fetch();

dd($posts);

// foreach ($posts as $post) {
//   echo '<li>' . $post['title'] . '</li>';
// }
