<?php

class Database {
    public function __construct($dbHost, $dbName, $dbUser, $dbPass) {
        try {
            $db = new PDO("mysql:host={$dbHost}; dbname={$dbName}", $dbUser, $dbPass);
            $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOExecption $e) {
            exit ("Error: {$e -> getMessage()}");
        }
    }

    public function createStudentTable() {
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

    public function searchDatabase($key) {

    }
}