<?php
include_once __DIR__ . '/../Utility/Header.php';
include_once __DIR__ . '/../../Models/Database.php';
include_once __DIR__ . '/../Controllers/Admin.SignIn.php';
include_once __DIR__ . '/../Controllers/Admin.Edit.php';
$newDB = new Database();
if(isset($_POST['oldmatric'])) {
    $student = $newDB -> fetchStudentDataByMatric($_POST['oldmatric'])[0];
    // print_r($student);
}
$newEdit -> editData();
?>

<head>
    <link rel="stylesheet" href="../../../css/output.css">
</head>
<main class="p-xsm">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="p-4">
        <div class="">
            <div class="mb-xmd">
                <h2 class="text-h3 font-medium">Edit Student Data</h2>
            </div>
            <div class="mb-xmd flex flex-col gap-sm">
                <input type="hidden" name="id" value="<?= $student["id"] ?? '' ?>">
                <div class="flex flex-col">
                    <label for="firstname" class="text-label font-medium">First Name</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="firstname" name="firstname" value="<?= $student["firstname"] ?? '' ?>">
                    <span class="text-red-600">
                        <?= implode('<br>', $newEdit -> firstNameErrors) ?>
                    </span>
                </div>
                <div class="flex flex-col">
                    <label for="middlename" class="text-label font-medium">Middle Name</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="middlename" name="middlename" value="<?= $student["middlename"] ?? '' ?>">
                    <span class="text-red-600">
                        <?= implode('<br>', $newEdit -> middleNameErrors) ?>
                    </span>
                </div>
                <div class="flex flex-col">
                    <label for="lastname" class="text-label font-medium">Last Name</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="lastname" name="lastname" value="<?= $student["lastname"] ?? '' ?>">
                    <span class="text-red-600">
                        <?= implode('<br>', $newEdit -> lastNameErrors) ?>
                    </span>
                </div>
                <div class="flex flex-col">
                    <label for="matric_number" class="text-label font-medium">Matric no</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="matric_number" name="matric_number" value="<?= $student["matric"] ?? '' ?>">
                    <span class="text-red-600">
                        <?= implode('<br>', $newEdit -> matricErrors) ?>
                    </span>
                </div>
                <div class="flex flex-col">
                    <label for="department" class="text-label font-medium">Department</label>
                    
                    <select name="department" id="department" class="border-2 p-xsm border-grey rounded-input" value="">
                        <option value="none">None</option>
                        <option value="mathematics">Mathematics</option>
                        <option value="physics">Physics</option>
                        <option value="chemistry">Chemistry</option>
                        <option value="industial_chem">Industrial Chemistry</option>
                        <option value="csc">Computer Science</option>
                        <option value="zoology">Zoology</option>
                    </select>
                    <span class="text-red-600">
                        <?= implode('<br>', $newEdit -> departmentErrors) ?>
                    </span>
                </div>
                <div class="">
                    <div class="flex justify-between">
                        <div class="basis-1/2 flex gap-sm">
                            <label for="fresher" class="text-label font-medium">Fresher</label>
                            <input class="" type="radio" id="fresher" value="fresher" name="status">
                        </div>

                        <div class="basis-1/2 flex gap-sm">
                            <label for="de" class="text-label font-medium">
                                Direct Entry
                            </label>
                            <input class="" type="radio" id="de" value="de" name="status">
                        </div>
                    </div>
                    <span class="text-red-600">
                        <?=implode('<br>',  $newEdit -> statusErrors) ?>
                    </span>
                </div>
                <span class="text-red-600">
                    <?= implode('<br>', $newEdit -> feedback) ?>
                </span>
            </div>
            <div class="mb-xmd">
                <button type="submit" class="w-full bg-primary px-sm py-xsm rounded-input text-white">Update Data</button>
            </div>
            <div class="">
                <p class=""><a href="../Views/Admin.Home.php">Back to Home</a></p>
            </div>
        </div>
    </form>
</main>

<?php
include_once __DIR__ . '/../Utility/Footer.php';
?>