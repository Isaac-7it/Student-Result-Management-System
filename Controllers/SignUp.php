<?php

class SignUp {
    public $firstName;
    public $middleName;
    public $lastName;
    public $matricNumber;
    public $password;
    public $retypedPassword;
    public $department;
    public $status;
    public $firstNameErrors = [];
    public $lastNameErrors = [];
    public $middleNameErrors = [];
    public $matricErrors = [];
    public $passErrors = [];
    public $statusErrors = [];
    public $departmentErrors = [];
    public $requiredError;

    public function __construct() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $varExist = isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['matric_number']) && isset($_POST['pass']) && isset($_POST['status']) && isset($_POST['department']);

            if($varExist) {
                $this -> firstName = htmlspecialchars(trim($_POST['firstname']));
                $this -> middleName = htmlspecialchars(trim($_POST['middlename']));
                $this -> lastName = htmlspecialchars(trim($_POST['lastname']));
                $this -> matricNumber = htmlspecialchars(trim($_POST['matric_number']));
                $this -> password = htmlspecialchars(trim($_POST['pass']));
                $this -> department = htmlspecialchars(trim($_POST['department']));
                $this -> status = htmlspecialchars(trim($_POST['status']));
                $this -> retypedPassword = htmlspecialchars(trim($_POST['retyped_pass']));

            
                if(empty($this -> firstName)) {
                    $this -> firstNameErrors[] = 'Firstname cannot be empty';
                } else {

                }

                if(empty($this -> lastName)) {
                    $this -> lastNameErrors[] = "Lastname cannot be empty";
                }

                if(empty($this -> middleName)) {
                    $this -> middleNameErrors[] = "Middlename cannot be empty";
                }

                if(empty($this -> matricNumber)) {
                    $this -> matricErrors[] = "Matric number is required";
                }

                if(empty($this -> status)) {
                    $this -> statusErrors[] = 'Status required';
                }

                if($this -> department === 'none') {
                    $this -> departmentErrors[] = 'Pick a department';
                }

                if(empty($this -> password)) {
                    $this -> passErrors[] = "Password is requred";
                }

                if($this -> password !== $this -> retypedPassword) {
                    $this -> passErrors[] = "Passwords do not match!";
                }
            } else {
                $this -> requiredError = 'All fields are required';
            }
        }
    }
}

$newSignUp = new SignUp();
