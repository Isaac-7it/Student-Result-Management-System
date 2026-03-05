<?php
include_once '../Utility/header.php';
include_once '../Controllers/Remove.php';
?>
<main class="p-xsm">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="flex flex-col">
        <div class="mb-xsm flex flex-col">
            <label for="matric">Matric Number</label>
            <input type="text" class="border-2 p-xsm border-grey rounded-input" name="matric" id="matric">
        </div>
        <div class="">
            <?= implode('<br>', $newDelete -> matricErrors) ?>
        </div>
        <div class="mb-xsm flex flex-col">
            <label for="coursecode">Course Code</label>
            <input type="text" class="border-2 p-xsm border-grey rounded-input" name="coursecode" id="coursecode">
        </div>
        <div class="">
            <?= implode('<br>', $newDelete -> courseErrors) ?>
        </div>
        <div class="">
            <?= implode('<br>', $newDelete -> feedback) ?>
        </div>
        <button class="w-full bg-red-700 px-sm py-xsm rounded-input text-white" type="submit">Delete Course</button>
    </form>
</main>
<?php
include_once '../Utility/footer.php';
?>