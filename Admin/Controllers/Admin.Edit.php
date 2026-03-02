<?php
include_once __DIR__ . '/../../Models/Database.php';

class Edit {
    public $firstName;
    public $middleName;
    public $lastName;
    public $department;
    public $status;
    public $id;
    public $firstNameErrors = [];
    public $lastNameErrors = [];
    public $middleNameErrors = [];
    public $statusErrors = [];
    public $departmentErrors = [];
    public $feedback = [];

    public function editData() {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $varExist = isset($_POST["firstname"]) && isset($_POST["middlename"]) && isset($_POST["lastname"]) && isset($_POST["department"]) && isset($_POST["status"]) && isset($_POST["id"]);

            if($varExist) {
                $this -> firstName = htmlspecialchars(trim($_POST['firstname']));
                $this -> middleName = htmlspecialchars(trim($_POST['middlename']));
                $this -> lastName = htmlspecialchars(trim($_POST['lastname']));
                $this -> department = htmlspecialchars(trim($_POST['department']));
                $this -> status = htmlspecialchars(trim($_POST['status']));
                $id = $this -> id = $_POST["id"];

                $allEmpty = empty($this -> firstName) && empty($this -> middleName) && empty($this -> lastName) && empty($this -> status);

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
                } elseif(empty($this -> firstNameErrors) && empty($this -> lastNameErrors) && empty($this -> middleNameErrors) && empty($this -> feedback) && empty($this -> departmentErrors) && empty($this -> statusErrors['status'])) {
                     try {
                        $db = new Database();
                        $db -> updateStudentData($id, $firstName, $middleName, $lastName, $department, $status);
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