<?php
include_once '../Models/Database.php';
include_once '../Controllers/SignIn.php';

class Enrollment {
    public $course;
    public $unit;
    public $matric;
    public $courseErrors = [];
    public $unitErrors = [];
    public $feedback = [];

    public function handleEnrollment() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $varExist = isset($_POST['courseCode']) && isset($_POST['unit']);
            if($varExist) {
                // print_r($_SESSION);
                $matric = $this -> matric = $_SESSION['matricNumber'];
                $this -> course = htmlspecialchars(trim($_POST['courseCode']));
                $this -> unit = htmlspecialchars(trim($_POST['unit']));

                if(!preg_match('/^[A-Za-z]{3}\s?[0-9]{3}$/', $this -> course)) {
                    $this -> courseErrors[] = 'Invalid Course';
                } else {
                    $course = $this -> course;
                }

                if(filter_var($this -> unit, FILTER_VALIDATE_INT) === 'false') {
                    $this -> unitErrors[] = 'Course Unit should be a number';
                } else {
                    $unit = $this -> unit;
                }

                if(empty($unitErrors) && empty($courseErrors)) {
                    try {
                        $newDB = new Database();
                        $newDB -> connectDatabase(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
                        $studentCourseData = $newDB -> fetchStudentCourse($matric, $course);
                        if(empty($studentCourseData)) {
                            $newDB -> insertStudentCourses($matric, $course, $unit);
                            $this -> feedback[] = 'Successful!';
                        } else {
                            $this -> feedback[] = 'You already registered for this course!';
                        }
                        } catch (PDOException $e) {
                        echo "Error => $e";
                    }
                } else {
                    $this -> feedback[] = 'All fields are required!';
                }
            }
        }
    }
}

$newEnrollment = new Enrollment();
$newEnrollment -> handleEnrollment();