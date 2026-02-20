<?php

class User {
    public $firstName;
    public $middleName;
    public $lastName;
    public $matricNumber;
    public $department;
    public $password;
    public $status;

    public function __construct($firstName, $middleName, $lastName, $matricNumber, $password, $department, $status) {
        $this -> firstName = $firstName;
        $this -> middleName = $middleName;
        $this -> lastName = $lastName;
        $this -> matricNumber = $matricNumber;
        $this -> password = $password;
        $this -> department = $department;
        $this -> status = $status;
    }
}