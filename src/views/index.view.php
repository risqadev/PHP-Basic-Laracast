<?php

use Core\Session;

$currentUserEmail = Session::get('user')['email'];

view('partials/head.php', [
  'heading' => $heading
]);
view('partials/nav.php');
view('partials/banner.php', [
  'heading' => $heading
]);
?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <p>Hello, <?= $currentUserEmail ?? 'Guest' ?>. Welcome to the home page.</p>
  </div>
</main>

<?php view('partials/footer.php') ?>