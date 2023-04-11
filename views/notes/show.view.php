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

    <p class="mb-6">
      <a  href="/notes"
          class="text-blue-500 hover:underline"
      >go back...</a>
    </p>

    <p>
      <?= htmlspecialchars($note['body']) ?>
    </p>

    <form method="POST">
      <div class="mt-6 flex items-center gap-x-6">
        <input  type="hidden"
                name="_method"
                value="DELETE">
        <input  type="hidden"
                name="id"
                value="<?= $note['id'] ?>">
        <button type="submit"
                class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >Delete</button>
      </div>
    </form>
  </div>
</main>

<?php view('partials/footer.php') ?>  