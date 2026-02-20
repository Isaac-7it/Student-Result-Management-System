<?php
include_once '../Models/Database.php';
include_once '../Config/config.php';

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
            print_r($_POST);
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
                } elseif(empty($this -> lastName)) {
                    $this -> lastNameErrors[] = "Lastname cannot be empty";
                } elseif(empty($this -> middleName)) {
                    $this -> middleNameErrors[] = "Middlename cannot be empty";
                } elseif(empty($this -> matricNumber)) {
                    $this -> matricErrors[] = "Matric number is required";
                } elseif(empty($this -> status)) {
                    $this -> statusErrors[] = 'Status required';
                } elseif($this -> department === 'none') {
                    $this -> departmentErrors[] = 'Pick a department';
                } elseif(empty($this -> password)) {
                    $this -> passErrors[] = "Password is requred";
                } elseif($this -> password !== $this -> retypedPassword) {
                    $this -> passErrors[] = "Passwords do not match!";
                } else {
                    $db = new Database();
                    $db -> connectDatabase(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
                    $db -> insertStudentTable($this -> firstName, $this -> middleName, $this -> lastName, $this -> matricNumber, $this -> password, $this -> department, $this -> status);
                }

            } else {
                $this -> requiredError = 'All fields are required';
            }
        }
    }
}

$newSignUp = new SignUp();
