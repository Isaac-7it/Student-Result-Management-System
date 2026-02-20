<?php
include_once '../utility/header.php';
include_once '../Controllers/SignUp.php';
print_r($_POST);
?>
<main>
    <h1>Welcome <?= $firstName ?></h1>
</main>
<?php
include_once '../utility/footer.php';
?>