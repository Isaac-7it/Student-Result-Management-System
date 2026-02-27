<?php

class Edit {
    public $matricNumber;
    public $courseCode;
    public $academicSession;
    public $semester;
    public $score;
    public $letterGrade;
    public $gradePoint;
    public $unit;
    public $matricErrors=[];
    public $courseCodeErrors=[];
    public $scoreError=[];
    public $unitErrors=[];

    public function editCourse() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $varExist = isset($_POST['matric_number']) && isset($_POST['course_code']) && isset($_POST['unit']) && isset($_POST['session']) && isset($_POST['semester']) && isset($_POST['score']) && isset($_POST['unit']);

            if($varExist) {
                $this -> matricNumber = htmlspecialchars(trim($_POST['matric_number']));
                $this -> courseCode = htmlspecialchars(trim($_POST['course_code']));
                $session = $this -> academicSession = htmlspecialchars(trim($_POST['session']));
                $semester = $this -> semester = htmlspecialchars(trim($_POST['semester']));
                $this -> score = htmlspecialchars(trim($_POST['score']));
                $this -> unit = htmlspecialchars(trim($_POST['unit']));

                // Validate Matric Number
                if(empty($this -> matricNumber)) {
                    $this -> matricErrors[] = 'Matric number cannot be empty';
                } elseif(strlen($this -> matricNumber) !== 5) {
                        $this -> matricErrors[] = 'Matric number should be 5 digits'; 
                } else {
                    $matricNumber = $this -> matricNumber;
                }

                // Validate Course Code
                if(empty($this -> courseCode)) {
                    $this -> courseCodeErrors[] = "Course code cannot be empty";
                } elseif(!preg_match('/^[A-Za-z]{3}\s?[0-9]{3}$/', $this -> course)) {
                        $this -> courseCodeErrors[] = 'Invalid course code';
                } else {
                    $courseCode = $this -> courseCode;
                }

                // Validate Unit
                if(empty($this -> unit)) {
                    $this -> unitErrors[] = 'Unit cannot be empty';
                } elseif ($this -> unit > 6 && $this -> unit < 0) {
                    $this -> unitErrors[] = 'Invalid unit!';
                } else {
                    $unit = $this -> unit;
                }
                
                // Validate Score
                if(empty($this -> score)) {
                    $this -> scoreError[] = "Score cannot be empty";
                } elseif (filter_var($this -> score, FILTER_VALIDATE_INT) === false) {
                    $this -> scoreError[] = "Score is not valid";
                } else {
                    $score = $this -> score;
                    // Determine Grade

                    if($score <= 100 && $score >= 70) {
                        $letterGrade = $this -> letterGrade = 'A';
                    } elseif ($score <= 69 && $score >= 60) {
                        $letterGrade = $this -> letterGrade = 'B';
                    } elseif ($score <= 59 && $score >= 50) {
                        $letterGrade = $this -> letterGrade = 'C';
                    } elseif ($score <= 49 && $score >= 40) {
                        $letterGrade = $this -> letterGrade = 'D';
                    } elseif ($score <= 39 && $score >= 30) {
                        $letterGrade = $this -> letterGrade = 'E';
                    } elseif ($score <= 29 && $score >= 0) {
                        $letterGrade = $this -> letterGrade = 'F';
                    }

                    switch ($letterGrade) {
                        case 'A':
                            $gradePoint = $this -> gradePoint = 4;
                            break;
                        case 'B':
                            $gradePoint = $this -> gradePoint = 3;
                            break;
                        case 'C':
                            $gradePoint = $this -> gradePoint = 2;
                            break;
                        case 'D':
                            $gradePoint = $this -> gradePoint = 1;
                            break;
                        case 'E':
                        case 'F':
                        default:
                            $gradePoint = $this -> gradePoint = 0;
                    }
                }
                
                $allEmpty = empty($this -> unitErrors) && empty($this -> matricErrors) && empty($this -> unitErrors) && empty($this -> courseCodeErrors);
                
                if($allEmpty) {
                    $this -> requiredError[] = 'All fields are required';
                } else {
                     try {
                        $db = new Database();
                        $db -> updateStudentCourse($matricNumber, $courseCode, $session, $semester, $score, $letterGrade, $gradePoint, $unit);
                        echo 'Done';
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