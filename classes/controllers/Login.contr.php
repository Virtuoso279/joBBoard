<?php

class LoginContr extends LoginModel{
    private $email;
    private $psw;

    public function __construct($email, $psw) {
        $this->email = $email;
        $this->psw = $psw;
    }

    public function loginUser() {
        if ($this->isEmptySubmit()) {
            header("Location: ../index.php?error=emptyinput");
            exit();
        }

        if ($this->invalidEmail()) {
            header("Location: ../index.php?error=invalidemail");
            exit();
        }     

        $isFound = $this->getUser($this->email, $this->psw);
        if (!$isFound) {
            header("Location: ../index.php?error=usernotfoundconstr");
            exit();
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