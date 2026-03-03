<?php
include_once '../../Models/Database.php';

class Delete {
    public function __construct($matric) {
        $db = new Database();
        $db -> deleteStudentData($matric);
    }    
}