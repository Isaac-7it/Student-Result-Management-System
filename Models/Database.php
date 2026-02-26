<?php
include_once '../Config/config.php';

class Database {
    public $db;

    public function connectDatabase($dbHost, $dbPort, $dbName, $dbUser, $dbPass) {
            $this -> db = new PDO("mysql:host={$dbHost}; port={$dbPort}; dbname={$dbName}", $dbUser, $dbPass);
            $this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this -> db;
    }

    public function createStudentData() {
        $createTableQuery = "CREATE TABLE students(
            id INT(11) AUTO_INCREMENT PRIMARY matric,
            firstname VARCHAR(50) NOT NULL,
            middlename VARCHAR(50) NOT NULL,
            lastname VARCHAR(50) NOT NULL,
            matric VARCHAR(50) NOT NULL,
            password VARCHAR(255) NOT NULL,
            department VARCHAR(50) NOT NULL,
            status VARCHAR(100) NOT NULL
        )";

        $this -> db -> exec($createTableQuery);
    }

    public function createStudentEnrollment() {
        $createTableQuery = "CREATE TABLE enrollments(
            id INT(11) AUTO_INCREMENT PRIMARY matric,
            matric_number VARCHAR(50),
            course_code VARCHAR(50),
            academic_session VARCHAR(50),
            semester VARCHAR(50),
            score VARCHAR(50),
            letter_grade VARCHAR(50),
            grade_point VARCHAR(100)
        )";

        $this -> db -> exec($createTableQuery);
    }

    public function insertStudentData($firstName, $middleName, $lastName, $matric, $password, $department, $status) {
        $insertQuery = "INSERT INTO `students`
        (`firstname`, `middlename`, `lastname`, `matric`, `password`, `department`, `status`)
        VALUES (:firstname, :middlename, :lastname, :matric, :pass, :department, :status)";
        $query = $this -> db -> prepare($insertQuery);
        
        $query -> bindParam(':firstname', $firstName, PDO::PARAM_STR);
        $query -> bindParam(':middlename', $middleName, PDO::PARAM_STR);
        $query -> bindParam(':lastname', $lastName, PDO::PARAM_STR);
        $query -> bindParam(':matric', $matric, PDO::PARAM_STR);
        $query -> bindParam(':pass', $password, PDO::PARAM_STR);
        $query -> bindParam(':department', $department, PDO::PARAM_STR);
        $query -> bindParam(':status', $status, PDO::PARAM_STR);

        $query -> execute();

        $lastInsertedRowId = $this -> db -> lastInsertId();

        if($lastInsertedRowId > 0) {
            return "OK";
        } else {
            return "Failed!";
        }
    }

    public function insertStudentCourses($matric, $course, $unit) {
        $insertQuery = "INSERT INTO `enrollments`
        (`matric_number`, `course_code`, `unit`)
        VALUES (:matric, :course, :unit)";

        $query = $this -> db -> prepare($insertQuery);

        $query -> bindParam(':matric', $matric, PDO::PARAM_STR);
        $query -> bindParam(':course', $course, PDO::PARAM_STR);
        $query -> bindParam(':unit', $unit, PDO::PARAM_STR);

        $query -> execute();
    }

    public function fetchStudentCourse($matric, $course) {
        $selectQuery = "SELECT matric_number, course_code, unit
        FROM `enrollments`
        WHERE `matric_number`=:matric AND `course_code`=:course";

        $query = $this -> db -> prepare($selectQuery);

        $query -> bindParam(':matric', $matric, PDO::PARAM_STR);
        $query -> bindParam(':course', $course, PDO::PARAM_STR);

        $query -> execute();

        $matchCases = $query -> fetchAll(PDO::FETCH_ASSOC);

        return $matchCases;
    }

    public function fetchStudentDataByMatric($matric) {
        $selectQuery = "SELECT * 
        FROM `students` 
        WHERE `matric`=:matric";

        $query = $this -> db -> prepare($selectQuery);

        $query -> bindParam(":matric", $matric, PDO::PARAM_STR);

        $query -> execute();

        $matchCases = $query -> fetchAll(PDO::FETCH_ASSOC);

        return $matchCases;
    }

    public function fetchStudentDataByMiddlename($matric) {
        $selectQuery = "SELECT * 
        FROM `students` 
        WHERE `middlename`=:middlename";

        $query = $this -> db -> prepare($selectQuery);

        $query -> bindParam(":middlename", $matric, PDO::PARAM_STR);

        $query -> execute();

        $matchCases = $query -> fetchAll(PDO::FETCH_ASSOC);

        return $matchCases;
    }

    public function updateStudentTable() {
        $updateQuery = "UPDATE result_management_system";
    }

    public function deleteStudentData($matric) {
        $deleteQuery = "DELETE FROM `students` WHERE `matric`=:matric";

        $query = ($this -> db) -> prepare($deleteQuery);
        $query -> bindParam(":matric", $matric, PDO::PARAM_STR);
        $query -> execute();
    }
}