<?php

class ContactsContr extends ContactsModel{
    private $full_name;
    private $aboutme;
    private $email;
    private $phone;
    private $telegram;
    private $linkedin;
    private $projects; 
    private $userId;
    private $userType;   

    public function __construct($userId, $userType, $full_name, $aboutme, $email, $phone, $telegram, $linkedin, $projects) {
        $this->full_name = $full_name;
        $this->aboutme = $aboutme;
        $this->email = $email;
        $this->phone = $phone;
        $this->telegram = $telegram;
        $this->linkedin = $linkedin;
        $this->projects = $projects;  
        $this->userId = $userId;   
        $this->userType = $userType;   
    }

    public function changeContactsInfo() {
        session_start();
        $errors = [];

        if ($this->invalidUserType()) {
            header("Location: ../index.php?error=invalidusertype");
            exit();
        }

        if ($this->isEmptySubmit()) {
            $errors["emptyInput"] = "Fill in all fields!";
            // header("Location: ../pages/contacts.php?error=emptyinput");
            // exit();
        }  
        
        if ($this->invalidEmail()) {
            $errors["invalidEmail"] = "Invalid email entered!";
        } 

        if (!empty($this->phone)) {
            if ($this->invalidPhone()) {
                $errors["invalidPhone"] = "Invalid phone number entered!";
            }
        }    
        
        if ($errors) {
            $_SESSION["errors_contacts"] = $errors; 
            header("Location: ../pages/contacts.php"); 
            die();
        } else {
            $this->setContacts($this->userId, $this->userType, $this->full_name, $this->aboutme, $this->email, $this->phone, $this->telegram, $this->linkedin, $this->projects);
        }
    }

    private function invalidUserType() {
        // Перевірка типу юзера
        $allowed_types = array('candidate', 'recruiter');

        if (!in_array($this->userType, $allowed_types)) {
            return true;
        } else {
            return false;
        }   
    }
    
    private function isEmptySubmit() {
        if (empty($this->full_name) || empty($this->email)) {
            return true;
        } else {
            return false;
        }
    }   

    private function invalidPhone() {
        $countryCode = substr($this->phone, 0, 4);
        $phoneNumber = substr($this->phone, 4);
        if ($countryCode === "+380" && strlen($phoneNumber) === 9) {
            return false;
        } else {
            return true;
        }
    }

    private function invalidEmail() {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }    
}