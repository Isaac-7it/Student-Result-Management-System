<?php
include_once '../utility/header.php';
include_once '../Controllers/SignIn.php';
$newSiginIn = new SignIn();
?>
<main>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="p-4">    
        <div class="">
            <div class="mb-xmd">
                <h2 class="text-h3 font-medium">Login</h2>
            </div>
            <div class="mb-xmd flex flex-col gap-sm">
                <div class="flex flex-col">
                    <label for="matric_number" class="text-label font-medium">Matric no</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="matric_number" name="matric_number" value="">
                    <span class="text-red-600"><?= $newSiginIn -> matricError ?></span>
                </div>
                <div class="flex flex-col">
                    <label for="pass" class="text-label font-medium">Password</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="password" id="pass" name="pass" value="">
                    <span class="text-red-600"></span>
                </div>
            </div>
            <div class="mb-xmd">
                <button type="submit" class="w-full bg-primary px-sm py-xsm rounded-input text-white">Sign In</button>
            </div>
            <div class="">
                <p class="">Don't have an account? <a href="#">Sign Up</a></p>
            </div>
        </div>
    </form>
</main>