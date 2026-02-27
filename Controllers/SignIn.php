<?php
session_start();
include_once '../Models/Database.php';
class SignIn {
    public $matricNumber;
    public $password;
    public $passwordError;
    public $matricError;
    public $userData;
    public $userSignIn;
    
    public function handleRequest() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $varExist = isset($_POST['matric_number']) && isset($_POST['pass']);

            if($varExist) {
                $this -> matricNumber = htmlspecialchars(trim($_POST['matric_number']));
                $this -> password = trim($_POST['pass']);

            // Validate matric
            if(empty($this -> matricNumber)) {
                $this -> matricError .= 'Matric Number cannot be empty';
            } else {
                $matricNumber = $this -> matricNumber;
            }

            // Validate password
            if(empty($this -> password)) {
                 $this -> passwordError = 'Password is required!';
            } else {
                $password = $this -> password;
            }

            if(empty($this ->matricError) && empty($this -> passwordError)) {
                    try {
                        $db = new Database();
                        $db -> connectDatabase(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
                        $matchingData = $db -> fetchStudentDataByMatric($matricNumber);
                        if (count($matchingData) !== 0) {
                            $this -> userData = $matchingData[0];
                                               
                            if(password_verify($password, ($this -> userData)['password']) && (($this -> userData)['matric'] === $matricNumber)) {
                            $this -> userSignIn = true;
                            // Store user data in session
                            $_SESSION["firstName"] = ($this -> userData)['firstname'];
                            $_SESSION["middleName"] = ($this -> userData)['middlename'];
                            $_SESSION["lastName"] = ($this -> userData)['lastname'];
                            $_SESSION["matricNumber"] = ($this -> userData)['matric'];
                            $_SESSION["department"] = ($this -> userData)['department'];
                            $_SESSION["status"] = ($this -> userData)['status'];
             
                            header('Location: ../Views/Home.php');
                            exit();
                            } else {
                                $this -> passwordError = 'Password or Matric Number is incorrect';
                            }
                        } else {
                            $this -> passwordError = 'User does not exit!';
                        }
                    } catch(PDOException $e) {
                        echo "Error => {$e}";
                    }
                }
            }
        }
    }
}

$newSignIn = new SignIn();
$newSignIn -> handleRequest();