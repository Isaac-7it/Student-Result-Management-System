<?php
include_once '../../Models/Database.php';

class Delete {
    public $matric;
    public $feedback;

    public function handleDelete() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['matric'])) {
                $this -> matric = htmlspecialchars(trim($_POST['matric']));

                if(empty($this -> matric)) {
                    $this -> feedback .= 'Matric Number cannot be empty! <br>';
                } elseif(strlen($this -> matric) !== 6) {
                    $this -> feedback .= 'Matric number should be exactly 6 digits<br>';
                } else {
                    $matric = $this -> matric;
                }

                if(empty($this -> feedback)) {
                    try {
                        $db = new Database();
                        $db -> deleteStudentData($matric);
                        $this -> feedback = 'Done!';
                        return 'Done';
                    } catch (PDOException $e) {
                        echo "Error => {$e}";
                    }
                }
            }
        }
    }    
}

$newDelete = new Delete();
$newDelete -> handleDelete();