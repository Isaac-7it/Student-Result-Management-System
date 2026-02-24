<?php
include_once '../utility/header.php';
include_once '../Controllers/SignUp.php';
print_r($_SESSION);
?>
<main>
    <h1>Welcome <?= $_SESSION["firstName"] ?></h1>
</main>
<?php
include_once '../utility/footer.php';
?>