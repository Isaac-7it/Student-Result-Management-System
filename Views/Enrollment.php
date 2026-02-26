<?php
include_once '../utility/header.php';
include_once '../Controllers/Enrollment.php';
include_once '../Models/Database.php';

$db = new Database();
// $db -> connectDatabase(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
// $db -> createStudentEnrollment();
// $db -> db -> exec("ALTER TABLE enrollments ADD COLUMN unit INT(11)");
?>
<main>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="p-4">
        <div class="">
            <div class="mb-xmd">
                <h2 class="text-h3 font-medium">Enroll for a Course</h2>
            </div>
            <div class="mb-xmd flex flex-col">
                <div class="flex flex-col">
                    <label for="courseCode" class="text-label font-medium">Course Code</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="courseCode" name="courseCode" 
                    value="">
                    <span class="text-red-600"><?= implode("<br>", $newEnrollment -> courseErrors) ?></span>
                </div>
            </div>
            <div class="mb-xmd flex flex-col">
                <div class="flex flex-col">
                    <label for="unit" class="text-label font-medium">Units</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="unit" name="unit" 
                    value="">
                    <span class="text-red-600"><?= implode("<br>", $newEnrollment -> unitErrors) ?></span>
                </div>
            </div>
            <span class="text-red-600"><?= implode("<br>", $newEnrollment -> feedback) ?></span>
            <div class="mb-xmd">
                <button type="submit" class="w-full bg-primary px-sm py-xsm rounded-input text-white">Register</button>
            </div>
            <div class="">
                <a href="../Views/Home.php">Back to Home</a>
            </div>
        </div>
    </form>
</main>
<?php
include_once '../utility/footer.php';
?>