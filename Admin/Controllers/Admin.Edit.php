<?php
include_once __DIR__ . '/../../Models/Database.php';

class Edit {
    public $firstName;
    public $middleName;
    public $lastName;
    public $matricNumber;
    public $department;
    public $status;
    public $id;
    public $firstNameErrors = [];
    public $lastNameErrors = [];
    public $middleNameErrors = [];
    public $matricErrors = [];
    public $statusErrors = [];
    public $departmentErrors = [];
    public $feedback = [];

    public function editData() {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $varExist = isset($_POST["firstname"]) && isset($_POST["middlename"]) && isset($_POST["lastname"]) && isset($_POST["matric_number"]) && isset($_POST["department"]) && isset($_POST["status"]) && isset($_POST["id"]);

            if($varExist) {
                $this -> firstName = htmlspecialchars(trim($_POST['firstname']));
                $this -> middleName = htmlspecialchars(trim($_POST['middlename']));
                $this -> lastName = htmlspecialchars(trim($_POST['lastname']));
                $this -> matricNumber = htmlspecialchars(trim($_POST['matric_number']));
                $this -> department = htmlspecialchars(trim($_POST['department']));
                $this -> status = htmlspecialchars(trim($_POST['status']));
                $id = $this -> id = $_POST["id"];

                $allEmpty = empty($this -> firstName) && empty($this -> middleName) && empty($this -> lastName) && empty($this -> matricNumber) && empty($this -> status);

                // Validate Firstname
                if(empty($this -> firstName)) {
                    $this -> firstNameErrors[] = 'Firstname cannot be empty';
                } elseif(strlen($this -> firstName) < 3) {
                        $this -> firstNameErrors[] = 'Name should be more than 3 letters'; 
                } else {
                    $firstName = $this -> firstName;
                }

                // Validate Lastname
                if(empty($this -> lastName)) {
                    $this -> lastNameErrors[] = "Lastname cannot be empty";
                } elseif(strlen($this -> lastName) < 3) {
                        $this -> lastNameErrors[] = 'Name should be more than 3 letters';
                } else {
                    $lastName = $this -> lastName;
                }
                
                // Validate Middlename
                if(empty($this -> middleName)) {
                    $this -> middleNameErrors[] = "Middlename cannot be empty";
                } else {
                    $middleName = $this -> middleName;
                }

                // Validate Matricnumber
                if(empty($this -> matricNumber)) {
                    $this -> matricErrors[] = "Matric number is required";
                } elseif(strlen($this -> matricNumber) !== 6) {
                    $this -> matricErrors[] = "Matric number should be exactly 5 digits";
                } elseif(!preg_match("/\d/", $this -> matricNumber)) {
                    $this -> matricErrors[] = "Matric number should be numeric";
                } else {
                    $matricNumber = $this -> matricNumber;
                }
                
                // Validate status
                if(empty($this -> status)) {
                    $this -> statusErrors[] = 'Status required';
                } else {
                    $status = $this -> status;
                }
                
                // Validate department
                if($this -> department === 'none') {
                    $this -> departmentErrors[] = 'Pick a department';
                } else {
                    $department = $this -> department;
                }

                if($allEmpty) {
                    $this -> feedback[] = 'All fields are required';
                } elseif(empty($this -> firstNameErrors) && empty($this -> lastNameErrors) && empty($this -> middleNameErrors) && empty($this -> feedback) && empty($this -> matricErrors) && empty($this -> departmentErrors) && empty($this -> statusErrors['status'])) {
                     try {
                        $db = new Database();
                        $db -> updateStudentData($id, $firstName, $middleName, $lastName, $matricNumber, $department, $status);
                        $this -> feedback[] = 'Successful!';
                    } catch(PDOException $e) {
                        echo "Error => {$e}";
                    }
                }
            }
        }
    }
}

$newEdit = new Edit();