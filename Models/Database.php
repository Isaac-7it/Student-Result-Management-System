<?php
include_once '../Config/config.php';

class Database {
    public $db;

    public function connectDatabase($dbHost, $dbPort, $dbName, $dbUser, $dbPass) {
            $this -> db = new PDO("mysql:host={$dbHost}; port={$dbPort}; dbname={$dbName}", $dbUser, $dbPass);
            $this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this -> db;
    }

    public function createStudentDetails() {
        $createTableQuery = "CREATE TABLE students(
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(50) NOT NULL,
            middlename VARCHAR(50) NOT NULL,
            lastname VARCHAR(50) NOT NULL,
            matric VARCHAR(50) NOT NULL,
            password VARCHAR(50) NOT NULL,
            department VARCHAR(50) NOT NULL,
            status VARCHAR(100) NOT NULL
        )";

        $this -> db -> exec($createTableQuery);
    }

    public function createStudentCourse() {
        $createTableQuery = "CREATE TABLE students(
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(50) NOT NULL,
            middlename VARCHAR(50) NOT NULL,
            lastname VARCHAR(50) NOT NULL,
            matric VARCHAR(50) NOT NULL,
            password VARCHAR(50) NOT NULL,
            department VARCHAR(50) NOT NULL,
            status VARCHAR(100) NOT NULL
        )";
    }

    public function insertStudentTable($firstName, $middleName, $lastName, $matric, $password, $department, $status) {
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

    public function fetchStudentData($key) {
        $selectQuery = "SELECT * 
        FROM `students` 
        WHERE matric=:matric";

        $query = $this -> db -> prepare($selectQuery);

        $query -> bindParam(":matric", $key, PDO::PARAM_STR);

        $query -> execute();

        $matchCases = $query -> fetchAll(PDO::FETCH_ASSOC);

        return $matchCases;
    }

    public function updateStudentTable() {
        $updateQuery = "UPDATE result_management_system";
    }

    public function searchDatabase($key) {

    }
}

try {

} catch(PDOException $e) {
    echo "Error: {$e}";
}