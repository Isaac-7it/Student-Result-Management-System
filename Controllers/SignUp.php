<?php
session_start();
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
    public $requiredError = [];

    public function handleRequest() {
        var_dump($_SERVER['REQUEST_METHOD'] === 'POST');
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $varExist = isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['lastname']) && isset($_POST['matric_number']) && isset($_POST['pass']) && isset($_POST['status']) && isset($_POST['department']) && isset($_POST['retyped_pass']);
            var_dump(isset($_POST['firstname']), isset($_POST['middlename']), isset($_POST['lastname']), isset($_POST['matric_number']), isset($_POST['pass']), isset($_POST['status']), isset($_POST['department']), isset($_POST['retyped_pass']));

            if($varExist) {
                $this -> firstName = htmlspecialchars(trim($_POST['firstname']));
                $this -> middleName = htmlspecialchars(trim($_POST['middlename']));
                $this -> lastName = htmlspecialchars(trim($_POST['lastname']));
                $this -> matricNumber = htmlspecialchars(trim($_POST['matric_number']));
                $this -> password = htmlspecialchars(trim($_POST['pass']));
                $this -> department = htmlspecialchars(trim($_POST['department']));
                $this -> status = htmlspecialchars(trim($_POST['status']));
                $this -> retypedPassword = htmlspecialchars(trim($_POST['retyped_pass']));

                $allEmpty = empty($this -> firstName) && empty($this -> middleName) && empty($this -> lastName) && empty($this -> matricNumber) && empty($this -> status) && empty($this -> password) && ($this -> department === 'none') && $this -> retypedPassword;

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
                
                if(empty($this -> password)) {
                    $this -> passErrors[] = "Password is requred";
                } elseif($this -> password !== $this -> retypedPassword) {
                    $this -> passErrors[] = "Passwords do not match!";
                } elseif(!preg_match("/[A-Za-z0-9#$&]/", $this -> password)) {
                    $this -> passErrors[] = "Password must contain letters, numbers and any of #$&";
                } elseif (strlen($this -> password) >= 10) {
                    $this -> passErrors[] = "Password shouldn't be more than 8 characters!";
                }
                else {
                    $password = password_hash($this -> password, PASSWORD_DEFAULT);
                }
                
                if($allEmpty) {
                    $this -> requiredError[] = 'All fields are required';
                } elseif(empty($this -> firstNameErrors) && empty($this -> lastNameErrors) && empty($this -> middleNameErrors) && empty($this -> passErrors) && empty($this -> requiredError) && empty($this -> matricErrors) && empty($this -> departmentErrors)) {
                     try {
                        $db = new Database();
                        $db -> connectDatabase(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
                        $matchingStudentByMatric = $db -> fetchStudentDataByMatric($matricNumber);
                        $matchingStudentByName = $db -> fetchStudentDataByMiddlename($middleName);
                        if((count($matchingStudentByName) !== 0) || (count($matchingStudentByMatric) !== 0)) {
                           $this -> requiredError[] = 'User already exist. Proceed to login';

                            header("Location: ../Views/SignIn.php");
                            exit();
                        } else {
                            $db -> insertStudentData($firstName, $middleName, $lastName, $matricNumber, $password, $department, $status);
                            $this -> firstName = $_SESSION["firstName"] = $firstName;
                            $this -> middleName = $_SESSION["middleName"] = $middleName;
                            $this -> lastName = $_SESSION["lastName"] = $lastName;
                            $this -> matricNumber = $_SESSION["matricNumber"] = $matricNumber;
                            $this -> department = $_SESSION["department"] = $department;
                            $this -> status = $_SESSION["status"] = $status;

                            header("Location: ../Views/Home.php");
                            exit();
                        } 
                    } catch(PDOException $e) {
                        echo "Error => {$e}";
                    }
                }
            } else {
                $this -> requiredError[] = 'All fields are required';
            }
        }
    }
    
}

$newSignUp = new SignUp();
$newSignUp -> handleRequest();
