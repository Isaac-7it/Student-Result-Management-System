<?php

class SignIn {
    public $actualUsername;
    public $actualPassword;
    public $username;
    public $password;
    public $feedback = [];

    public function __construct() {
        $this -> actualPassword = password_hash('123', PASSWORD_DEFAULT);
        $this -> actualUsername = "Admin";
    }

    public function handleRequest() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $varExist = isset($_POST['username']) && isset($_POST['pass']);

            if($varExist) {
                $this -> username = htmlspecialchars(trim($_POST['username']));
                $this -> password = htmlspecialchars(trim($_POST['pass']));

                if(($this -> username === $this -> actualUsername) && password_verify($this -> password, $this -> actualPassword)) {
                    header("Location: ../Views/Admin.Home.php");
                    exit();
                } else {
                    $this -> feedback[] = 'Incorrect Username or Password';
                }
            }
        }
    }
}

$newSignIn = new SignIn();
$newSignIn -> handleRequest();