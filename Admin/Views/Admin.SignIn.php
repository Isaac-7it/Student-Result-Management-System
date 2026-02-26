<?php
include_once __DIR__ . '/../Utility/Header.php';
include_once __DIR__ . '/../Controllers/Admin.SignIn.php';
?>
<main>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="p-4">
        <div class="">
            <div class="mb-xmd">
                <h2 class="text-h3 font-medium">Login (Admin)</h2>
            </div>
            <div class="mb-xmd flex flex-col gap-sm">
                <div class="flex flex-col">
                    <label for="username" class="text-label font-medium">Username</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="username" name="username" value="">
                    <span class="text-red-600"></span>
                </div>
                <div class="flex flex-col px-1.5">
                    <label for="pass" class="text-label font-medium">Password</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="password" id="pass" name="pass" value="">
                    <span class="text-red-600"></span>
                </div>
            </div>
            <span class="text-red-600"><?= implode('<br>', $newSignIn -> feedback) ?></span>
            <div class="mb-xmd">
                <button type="submit" class="w-full bg-primary px-sm py-xsm rounded-input text-white">Sign In</button>
            </div>
            <div class="">
                <p class="">Are you an student? <a href="../../Views/SignIn.php">Follow here!</a></p>
            </div>
        </div>
    </form>
</main>