<?php
include_once '../Controllers/SignIn.php';
include_once '../utility/header.php';
include_once '../Models/Database.php';
include_once '../Controllers/GradePoint.php';
$gradePoint = new GradePoint($_SESSION["matricNumber"]);
// $newDB = new Database();
// $newSignIn = new SignIn();
// $newDB -> connectDatabase(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
// print_r($newDB -> fetchStudentDataByMatric($newSignIn -> matricNumber));
// print_r($_SESSION);
?>

<?php if(isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] === true): ?>
<main class="p-xsm">
    <nav class="flex items-center justify-between mb-sm">
        <span class="text-icon p-1.5 inline-block bg-white rounded">
            <i class="fa-solid fa-bars"></i>
        </span>
        <span>Student <span class="font-semibold">Dashboard</span></span>
        <span class="text-icon inline-block"><i class="fa-solid fa-bell"></i></span>
    </nav>
    <div class="bg-white p-sm rounded-xl mb-sm">
        <h2 class="text-h4 font-semibold">Welcome, <?= $_SESSION["firstName"] ?> 👋</h2>
        <p class="capitalize"><?= $_SESSION["department"] ?> || Level<?= $_SESSION["status"] === "fresher" ? " 100" : " 200" ?></p>
    </div>
    <div class="bg-white p-sm mb-sm">
        <h5 class="mb-sm">Overview</h5>
        <div class="grid">
            <div class="bg-grey rounded-xl flex flex-col p-[8px]">
                <span class="text-[12px] text-wrap flex-1 inline-block">Current GPA</span>
                <span class="font-stats text-3xl font-medium"><?= (float) round($gradePoint -> getCGPA(), 2) ?></span>
            </div>
            <div class="bg-grey rounded-xl flex flex-col p-[8px]">
                <span class="text-[12px] text-wrap flex-1 inline-block">Courses Registered</span>
                <span class="font-stats text-3xl font-medium">
                    <?= $gradePoint -> getNumberOfCourses() ?>
                </span>
            </div>
            <div class="bg-grey rounded-xl flex flex-col p-[8px]">
                <span class="text-[12px] text-wrap flex-1 inline-block">Total Units</span>
                <span class="font-stats text-3xl font-medium"><?= $gradePoint -> getTotalUnits() ?></span>
            </div>
        </div>
    </div>
    <div class="">
        <div class="">
            <span>GPA Trend</span>

            <span>Last 4 semesters</span>
        </div>
        <div class="text-center mb-sm">
            <a href="../Views/Grade.php" class="py-xsm bg-blue-800 block w-full text-white rounded-md">View Grades</a>
        </div>
        <div class="text-center mb-sm">
            <a href="../Views/Enrollment.php" class="py-xsm text-dark-grey block w-full bg-white rounded-md">Register Courses</a>
        </div>
        <div class="text-center mb-sm">
            <a href="../Views/Remove.php" class="py-xsm text-dark-grey block w-full bg-white rounded-md">Remove Courses</a>
        </div>
        <div class="text-center mb-sm">
            <a href="" class="py-xsm text-dark-grey block w-full bg-white rounded-md">
                <span></span>
                <span>
                    Download Transcript
                </span>
            </a>
        </div>
        </div>
        <div class="text-center mb-sm">
            <a href="../Controllers/LogOut.php" class="py-xsm text-white block w-full bg-red-700 rounded-md">
               Log Out
            </a>
        </div>
    </div>
</main>
<?php else: ?>
<div class="text-center">
    <p>Please log in to access this page.</p>
</div>
<?php 
header("Location: ../Views/SignIn.php");
endif; ?>
<?php
include_once '../utility/footer.php';
?>