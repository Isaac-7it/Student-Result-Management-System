<?php
include_once __DIR__ . '/../Utility/Header.php';
include_once __DIR__ . '/../../Models/Database.php';
include_once __DIR__ . '/../Controllers/Admin.SignIn.php';
include_once __DIR__ . '/../Controllers/Admin.EditCourse.php';
$newDB = new Database();
if(isset($_POST['matric'])) {
    $courses = $newDB -> fetchAllStudentCourse($_POST['matric']);
    // print_r($courses);
} else {
    $courses = [];
}
$newEdit = new Edit();
$newEdit -> editCourse();
?>

<head>
    <link rel="stylesheet" href="../../../css/output.css">
</head>
<main class="p-xsm">
    <div class="mb-xmd">
        <h2 class="text-h3 font-medium">Edit Student Course</h2>
    </div>
    <div class="overflow-x-scroll">
        <table>
            <thead>
                <tr>
                    <th>Course ID</th>
                    <th>Matric Number</th>
                    <th>Course Code</th>
                    <th>Unit</th>
                    <th>Score</th>
                    <th>Session</th>
                    <th>Semester</th>
                    <th>Default Score</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($courses as $course): ?>
                    <tr>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" class="flex gap-1 mb-2" method="POST">
                            <?php foreach($course as $detail): ?>
                                <td>
                                    <input type="text" name="<?= implode('', array_keys($course, $detail)) ?>" value="<?= $detail ?>" class="border-2 border-grey rounded-input p-1">
                                </td>
                            <?php endforeach ?>
                            <td>
                                <select name="session" id="session" class="border-2 border-grey rounded-input p-1">
                                    <option value="2024/25">2024/25</option>
                                    <option value="2023/24">2023/24</option>
                                </select>
                            </td>
                            <td>
                                <select name="semester" id="semester" class="border-2 border-grey rounded-input p-1">
                                    <option value="first">First</option>
                                    <option value="second">Second</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="score" value="100" class="border-2 border-grey rounded-input p-1">
                            </td>
                            <td>
                                <button type="submit" class="bg-red-700 text-white px-4 rounded-md">Update</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <a href="../Views/Admin.Home.php" class="">Back to home!</a>
</main>

<?php
include_once __DIR__ . '/../Utility/Footer.php';
?>