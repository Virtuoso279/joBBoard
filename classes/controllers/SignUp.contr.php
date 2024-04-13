<?php

class SignUpContr extends SignUpModel{
    private $email;
    private $psw;

    public function __construct($email, $psw) {
        $this->email = $email;
        $this->psw = $psw;
    }

    public function signupUser() {
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

        if ($this->invalidUsertype()) {
            $errors["invalidUserType"] = "Invalid user type choosed!";
        }

        if ($this->isUserExist()) {
            $errors["userExist"] = "The user is already registered!";
        }

        if ($errors) {
            $_SESSION["errors_signup"] = $errors; 

            $signupData = [
                "email" => $this->email,
                "pwd" => $this->psw
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../signup.php"); 
            die();
        } else {
            $this->setUser($this->email, $this->psw);
        }
    }
    
    private function isEmptySubmit() {
        if (empty($this->psw) || empty($this->email) || !isset($_SESSION["user_type"])) {
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

    private function isUserExist() {
        if ($this->checkUser($this->email)) {
            return false;
        } else {
            return true;
        }
    }    

    private function invalidUsertype() {
        if ($_SESSION["user_type"] === "candidate" || $_SESSION["user_type"] === "recruiter") {
            return false;
        } else {
            return true;
        }
    }

    public function fetchUserId($userEmail) {
        $userId = $this->getUserId($userEmail);
        return $userId[0]["id"];
    }

    public function cancelReg() {
        if (isset($_SESSION["user_type"]) && isset($_SESSION["user_id"])) {
            $this->deleteUser();
        } else {
            header("Location: ../index.php?error=undefineduser");
            exit();
        }        
    }
}