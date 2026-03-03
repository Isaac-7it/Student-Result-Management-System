<?php
include_once '../Utility/Header.php';
include_once '../Controllers/Admin.Delete.php';
?>
<main class="p-xsm">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="flex flex-col">
        <label for="matric" class="">Matric Num.</label>
        <input type="text" id="matric" name='matric' class="border-2 p-xsm border-grey rounded-input mb-xsm">
        <button type='submit' class='bg-red-700 px-sm py-xsm rounded-input text-white w-full'>Delete</button>
        <?= $newDelete -> feedback; ?>
    </form>
    <a href="../Views/Admin.Home.php" class="">Go back</a>
</main>
