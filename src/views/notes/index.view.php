<?php

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

    <?php foreach ($notes as $note) : ?>
      <li>
        <a  href="/note?id=<?= $note['id'] ?>"
            class="text-blue-500 hover:underline">
          <?= htmlspecialchars($note['body']) ?>
        </a>
      </li>
    <?php endforeach; ?>

    <p class="mt-6">
      <a  href="/notes/create"
          class="rounded-md px-3 py-2 bg-blue-500 text-sm font-semibold text-white hover:bg-blue-700 text-blue-500">
        Create note
      </a>
    </p>

  </div>
</main>

<?php view('partials/footer.php') ?>