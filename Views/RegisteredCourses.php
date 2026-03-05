<?php
include_once '../Utility/header.php';
include_once '../Models/Database.php';
include_once '../Controllers/SignIn.php';

// print_r($_SESSION);
$db = new Database();
$courses = $db -> fetchAllStudentCourse($_SESSION['matricNumber']);
// print_r($courses)
?>

<table>
    <thead>
        <tr>
            <th>Course</th>
            <th>Unit</th>
        </tr>
    </thead>
    <?php foreach($courses as $grades): ?>
        <tr>
            <td><?= $grades['course_code'] ?></td>
            <td><?= $grades['unit'] ?></td>
        </tr>
    <?php endforeach ?>
</table>
<a href="../Views/Home.php" class="">Back to home</a>