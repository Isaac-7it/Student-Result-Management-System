<?php
include_once __DIR__ . '/../Utility/Header.php';
include_once __DIR__ . '/../../Models/Database.php';
include_once __DIR__ . '/../Controllers/Admin.SignIn.php';
include_once __DIR__ . '/../Controllers/Admin.EditCourse.php';
$newDB = new Database();
if(isset($_POST['oldmatric'])) {
    $courses = $newDB -> fetchAllStudentCourse($_POST['oldmatric']);
    print_r($courses);
}
$courses = [];
?>

<head>
    <link rel="stylesheet" href="../../../css/output.css">
</head>
<main class="p-xsm">
    <div class="mb-xmd">
        <h2 class="text-h3 font-medium">Edit Student Course</h2>
    </div>
    <div class="overflow-x-scroll">
        <?php foreach($courses as $course): ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" class="flex gap-1 mb-2">
                    <?php foreach($course as $detail): ?>
                        <input type="text" name="<?= implode('', array_keys($course, $detail)) ?>" value="<?= $detail ?>" class="border-2 border-grey rounded-input p-1">
                    <?php endforeach ?>
                    <select name="session" id="session" class="border-2 border-grey rounded-input p-1">
                        <option value="2024/25">2024/25</option>
                        <option value="2023/24">2023/24</option>
                    </select>
                    <select name="semester" id="semester" class="border-2 border-grey rounded-input p-1">
                        <option value="first">First</option>
                        <option value="second">Second</option>
                    </select>
                    <input type="text" name="score" value="100" class="border-2 border-grey rounded-input p-1">
                    <button type="submit" class="bg-red-700 text-white px-4 rounded-md">Update</button>
                </form>
        <?php endforeach ?>
    </div>
</main>

<?php
include_once __DIR__ . '/../Utility/Footer.php';
?>