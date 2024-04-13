<?php

class LoginContr extends LoginModel{
    private $email;
    private $psw;

    public function __construct($email, $psw) {
        $this->email = $email;
        $this->psw = $psw;
    }

    public function loginUser() {
        session_start();
        $errors = [];

        if ($this->isEmptySubmit()) {
            $errors["emptyInput"] = "Fill in all fields!";
            // header("Location: ../index.php?error=emptyinput");
            // exit();
        }

        if ($this->invalidEmail()) {
            $errors["invalidEmail"] = "Invalid email used!";
        }     

        $isFound = $this->getUser($this->email, $this->psw);
        if (!$isFound) {
            $errors["userNotFound"] = "User wasn't registered!";
        }

        if ($errors) {
            $_SESSION["errors_login"] = $errors; 

            $loginData = [
                "email" => $this->email,
                "pwd" => $this->psw
            ];
            $_SESSION["login_data"] = $loginData;

            header("Location: ../login.php"); 
            die();
        }
    }
    
    private function isEmptySubmit() {
        if (empty($this->psw) || empty($this->email)) {
            return true;
        } else {
            return false;
        }
    }

    private function invalidEmail() {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }  

    private function getUser($email, $pwd) {
        //search user from candidates
        $isFound = $this->searchUser($email, $pwd, "candidates");

        if (!$isFound) {
            $isFound = $this->searchUser($email, $pwd, "recruiters");
        }

        if (!$isFound) {
            return false;
        } else {
            return true;
        }      
    }
}