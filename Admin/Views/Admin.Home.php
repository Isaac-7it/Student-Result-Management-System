<?php
include_once __DIR__ . '/../Utility/Header.php';
include_once __DIR__ . '/../../Models/Database.php';
include_once __DIR__ . '/../Controllers/Admin.SignIn.php';

$newDB = new Database();
$students = $newDB -> fetchAllStudents();
?>

<main class="p-xsm">
    <nav class="flex items-center justify-between mb-sm">
        <span><span class="font-semibold">Dashboard</span></span>
        <span class="text-icon inline-block"><i class="fa-solid fa-bell"></i></span>
    </nav>
    <div class="bg-white p-sm rounded-xl mb-sm">
        <h2 class="text-h4 font-semibold">Welcome, Admin 👋</h2>
    </div>
    <div class="bg-white p-sm mb-sm">
        <h5 class="mb-sm">Overview</h5>
        <div class="grid">
            <div class="bg-grey rounded-xl flex flex-col p-[8px]">
                <span class="text-[12px] text-wrap flex-1 inline-block">Total Students</span>
                <span class="font-stats text-3xl font-medium"><?= count($students) ?></span>
            </div>
            <div class="bg-grey rounded-xl flex flex-col p-[8px]">
                <span class="text-[12px] text-wrap flex-1 inline-block">Cummu. GPA</span>
                <span class="font-stats text-3xl font-medium">3.67</span>
            </div>
            <div class="bg-grey rounded-xl flex flex-col p-[8px]">
                <span class="text-[12px] text-wrap flex-1 inline-block">Credits</span>
                <span class="font-stats text-3xl font-medium">3.67</span>
            </div>
        </div>
    </div>
    <div class="h-[50vh] overflow-x-scroll overflow-y-scroll">
        <table class="max-content">
            <thead class="w-full">
                <tr class="w-full">
                    <td>Firstname</td>
                    <td>Middlename</td>
                    <td>Lastname</td>
                    <td>Matric</td>
                    <td>Department</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody class="w-full">
                <?php foreach($students as $student): ?>
                    <tr class="w-full">
                        <?php foreach($student as $data): ?>
                            <td><?= $data ?></td>
                        <?php endforeach ?>
                        <td>
                        <form action="../Views/Admin.EditData.php" method="POST">
                            <input type="hidden" name="oldmatric" value="<?= $student["matric"] ?>">
                            <button class="cursor-pointer" type="submit">Edit <i class="fa-solid fa-pen-to-square"></i></button>
                        </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mb-sm">
        <a href="../Views/Admin.SignIn.php" class="py-xsm text-white block w-full bg-red-700 rounded-md">
           Log Out
        </a>
    </div>
</main>

<?php
include_once __DIR__ . '/../Utility/Footer.php';
?>