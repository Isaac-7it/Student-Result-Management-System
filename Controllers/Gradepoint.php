<?php
include_once '../Models/Database.php';

class GradePoint {
    public $matricNumber;

    public function __construct($matricNumber) {
        $this -> matricNumber = $matricNumber;
    }

    public function getTotalUnits () {
        $totalUnits = 0;
        try {
            $db = new Database();
            $courseDetails = $db -> fetchAllStudentCourse($this -> matricNumber);

        foreach($courseDetails as $courseDetail) {
            $totalUnits += $courseDetail['unit'];
        }

        return $totalUnits;
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
            $totalUnits = $this -> getTotalUnits();
            $totalCredits = 0;

            foreach($courses as $course) {
                $totalCredits += ($course['unit'] * $course['grade_point']);
            }

            if($totalCredits === 0) {
                return 0;
            }

            return $totalCredits / $totalUnits;

        } catch(PDOException $e) {

        }
    }
}
