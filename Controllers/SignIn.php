<?php
include_once '../Models/Database.php';

class SignIn {
    public $matricNumber;
    public $password;
    public $passwordError;
    public $matricError;

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
                                               
                        if(password_verify($password, $matchingData[0]['password']) && ($matchingData[0]['matric'] === $matricNumber)) {
                        header('Location: ../Views/Home.php');
                        exit();
                        } else {
                            $this -> passwordError = 'Password or Matric Number is incorrect';
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