<?php
include_once '../Models/Database.php';

class Remove {
    public $matricNumber;
    public $course;
    public $feedback = [];
    public $matricErrors = [];
    public $courseErrors = [];

    public function removeCourse() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $varExist = isset($_POST['matric']) && isset($_POST['coursecode']);

            if($varExist) {
                $this -> matricNumber = htmlspecialchars(trim($_POST['matric']));
                $this -> course = htmlspecialchars(trim($_POST['coursecode']));

                if (empty($this -> matricNumber)) {
                    $this -> matricErrors[] = 'Matric number cannot be empty';
                } elseif (strlen($this -> matricNumber) !== 6) {
                    $this -> matricErrors[] = 'Matric number should be exactly 6 digits';
                } else {
                    $matricNumber = $this -> matricNumber;
                }

                if (empty($this -> course)) {
                    $this -> courseErrors[] = 'Course cannot be empty';
                } elseif (!preg_match('/^[A-Za-z]{3}\s?[0-9]{3}$/', $this -> course)) {
                    $this -> courseErrors[] = 'Course Code is invalid';
                } else {
                    $course = $this -> course;
                }

                if(empty($this -> courseErrors) && empty($this -> matricErrors)) {
                    try {
                        $db = new Database();
                        $db -> deleteStudentCourse($matricNumber, $course);
                        $this -> feedback[] = 'Successful!';
                    } catch (PDOException $e) {
                        echo "Error => {$e}";
                    }
                } else {
                    $this -> feedback[] = 'All fields are required!!';
                }
            }
        }
    }
}

$newDelete = new Remove();
$newDelete -> removeCourse();