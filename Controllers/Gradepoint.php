<?php
include_once '../Models/Database.php';

class GradePoint {
    public $matricNumber;

    public function __construct($matricNumber) {
        $this -> matricNumber = $matricNumber;
    }

    public function getCredits () {
        $totalCredits = 0;
        try {
            $db = new Database();
            $courseDetails = $db -> fetchAllStudentCourse($this -> matricNumber);

        foreach($courseDetails as $courseDetail) {
            $totalCredits += $courseDetail['unit'];
        }

        return $totalCredits;
        } catch(PDOException $e) {
            echo "Error => {$e}";
        }
    }

    public function getNumberOfCourses() {
        try {
            $db = new Database();
            $courses = $db -> fetchAllStudentCourse($this -> matricNumber);
            return count($courses);
        } catch(PDOException $e) {
            echo "Error => {$e}";
        }
    }

    public function getCGPA() {
        try {
            $db = new Database();
            $courses = $db -> fetchAllStudentCourseDetails($this -> matricNumber);
            $totalUnits = $this -> getCredits();
            $totalCredits = 0;

            foreach($courses as $course) {
                $totalCredits += ($course['unit'] * $course['grade_point']);
            }

            return $totalCredits / $totalUnits;

        } catch(PDOException $e) {

        }
    }
}
