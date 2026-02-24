<?php
include_once '../Models/Database.php';

class SignIn {
    public $matricNumber;
    public $password;
    public $passwordError;
    public $matricError;

    public function handleRequest() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this -> matricNumber = htmlspecialchars(trim($_POST['matric_number']));
            $this -> password = trim($_POST['password'])

            if(empty($this -> matricNumber)) {
                $this -> matricError .= 'Matric Number cannot be empty';
            } else {
                $matricNumber = $this -> matricNumber;
            }

            if(empty($this -> password)) {
                 $this -> passwordError = 'Password is required!';
            } else {
                $password = $this -> password;
            }

            if(empty($matricError) && empty($passwordError)) {
                try {
                    $db = new Database();
                    $db -> connectDatabase(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
                    $matchingData = $db -> fetchStudentDataByMatric($matricNumber);
                    print_r($matchingData);
                    if($matchingData["password"] === $password) {
                        header('Location: ../Views/Home.php');
                    }
                } catch(PDOException $e) {
                    echo "Error => {$e}";
                }
            }
        }
    }
}

$newSignIn = new SignIn();
$newSignIn -> handleRequest();