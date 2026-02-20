<?php
include_once '../utility/header.php';
include_once '../Controllers/SignUp.php';

?>
<main>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="p-4">
        <div class="">
            <div class="mb-xmd">
                <h2 class="text-h3 font-medium">Create an Account</h2>
            </div>
            <div class="mb-xmd flex flex-col gap-sm">
                <div class="flex flex-col">
                    <label for="firstname" class="text-label font-medium">First Name</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="firstname" name="firstname" value="<?= $newSignUp -> firstName ?>">
                    <span class="text-red-600"><?= implode("<br>", $newSignUp -> firstNameErrors) ?></span>
                </div>
                <div class="flex flex-col">
                    <label for="middlename" class="text-label font-medium">Middle Name</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="middlename" name="middlename" value="<?= $newSignUp -> middleName ?>">
                    <span class="text-red-600"><?= implode("<br>", $newSignUp -> middleNameErrors) ?></span>
                </div>
                <div class="flex flex-col">
                    <label for="lastname" class="text-label font-medium">Last Name</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="lastname" name="lastname" value="<?= $newSignUp -> lastName ?>">
                    <span class="text-red-600"><?= implode("<br>", $newSignUp -> lastNameErrors) ?></span>
                </div>
                <div class="flex flex-col">
                    <label for="matric_number" class="text-label font-medium">Matric no</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="text" id="matric_number" name="matric_number" value="<?= $newSignUp -> matricNumber ?>">
                    <span class="text-red-600"><?= implode("<br>", $newSignUp -> matricErrors) ?></span>
                </div>
                <div class="flex flex-col">
                    <label for="pass" class="text-label font-medium">Password</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="password" id="pass" name="pass" value="<?= $newSignUp -> password ?>">
                </div>
                <div class="flex flex-col">
                    <label for="retyped-pass" class="text-label font-medium">Retype Password</label>
                    <input class="border-2 p-xsm border-grey rounded-input" type="password" id="retyped-pass" name="retyped_pass" value="<?= $newSignUp -> retypedPassword ?>">
                    <span class="text-red-600"><?= implode("<br>", $newSignUp -> passErrors) ?></span>
                </div>
                <div class="flex flex-col">
                    <label for="department" class="text-label font-medium">Department</label>
                    <select name="department" id="department" class="border-2 p-xsm border-grey rounded-input" value="<?= $newSignUp -> department ?>">
                        <option value="none">None</option>
                        <option value="mathematics">Mathematics</option>
                        <option value="physics">Physics</option>
                        <option value="chemistry">Chemistry</option>
                        <option value="industial_chem">Industrial Chemistry</option>
                        <option value="csc">Computer Science</option>
                        <option value="zoology">Zoology</option>
                    </select>
                    <span class="text-red-600"><?= implode("<br>", $newSignUp -> departmentErrors) ?></span>
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
                    <span class="text-red-600"><?= implode("<br>", $newSignUp -> statusErrors) ?></span>
                </div>
                <span class="text-red-600"><?= implode("<br>", $newSignUp -> requiredError) ?></span>
            </div>
            <div class="mb-xmd">
                <button type="submit" class="w-full bg-primary px-sm py-xsm rounded-input text-white">Sign Up</button>
            </div>
            <div class="">
                <p class="">Already have an account? <a href="#">Sign In</a></p>
            </div>
        </div>
    </form>
</main>
<?php
include_once '../utility/footer.php';
?>