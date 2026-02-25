<?php
include_once '../Models/Database.php';

class Home {
    public $userData;
    public function handleData($matric) {
        $newDB = new Database();
        $newDB -> connectDatabase(DB_HOST, DB_PORT, DB_NAME, DB_USER, DB_PASSWORD);
        $this -> userData = ($newDB -> fetchStudentDataByMatric($matric))[0];
        return $this -> userData;
    }
}