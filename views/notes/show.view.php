<?php require base_path("views/partials/head.php")?>
<?php require base_path("views/partials/nav.php")?>
<?php require base_path("views/partials/banner.php")?>



<main>
  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <p class="mb-6">
      <a href="/php/learn-from-english/public/notes" class="text-blue-600 hover:underline">go back to Notes</a>
    </p>
    <p>
      <?= htmlspecialchars($note['body']) ?>
    </p>  
    <footer class="flex mt-6 flex-row items-end">
      <a 
        href="/php/learn-from-english/public/note/edit?id=<?= $note['id'] ?>"
        class="text-xl text-yellow-500 border border-yellow-500 rounded px-3 py-1 hover:bg-yellow-500 hover:text-black"
        >
        Edit
      </a>
      
      <form method="POST" class="ml-6">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="id" value="<?= $note['id'] ?>">
        <button class="text-xl font-bold text-red-500">Delete</button>
      </form>
    </footer>
  </div>
</main>


<?php require base_path("views/partials/footer.php")?>