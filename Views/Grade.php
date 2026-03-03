<?php
include_once '../Utility/header.php';
include_once '../Models/Database.php';
include_once '../Controllers/SignIn.php';

// print_r($_SESSION);
$db = new Database();
$courses = $db -> fetchStudentGrades($_SESSION['matricNumber']);
// print_r($courses)
?>

<table>
    <thead>
        <tr>
            <th>Course</th>
            <th>Score</th>
            <th>Grade</th>
            <th>Credit</th>
            <th>Unit</th>
        </tr>
    </thead>
    <?php foreach($courses as $grades): ?>
        <tr>
            <?php foreach($grades as $grade): ?>
                <td><?= $grade ?></td>
            <?php endforeach ?>
        </tr>
    <?php endforeach ?>
</table>
<a href="../Views/Home.php" class="">Back to Home</a>