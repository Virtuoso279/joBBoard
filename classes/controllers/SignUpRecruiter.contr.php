<?php

session_start();

class SignUpContrRecruiter extends SignUpModelRecruiter{
    private $full_name;
    private $position;
    private $company;
    private $description;
    private $country;    

    public function __construct($full_name, $position, $company, $description, $country) {
        $this->full_name = $full_name;
        $this->position = $position;
        $this->company = $company;
        $this->description = $description;
        $this->country = $country;        
    }

    public function addProfileInfo() {
        $errors = [];

        if ($this->isEmptySubmit()) {
            $errors["emptyInput"] = "Fill in all fields!";
            // header("Location: ../recruiter/signup_recruiter.php?error=emptyinput");
            // exit();
        }        

        if ($errors) {
            $_SESSION["errors_signup_recr"] = $errors; 

            $signupData = [
                "full_name" => $this->full_name,
                "position" => $this->position,
                "company" => $this->company,
                "description" => $this->description,
                "country" => $this->country
            ];
            $_SESSION["signup_data_recr"] = $signupData;

            header("Location: ../recruiter/signup_recruiter.php"); 
            die();
        } else {
            $this->country = $this->fetchCountryId($this->country);  
        
            //set default user photo
            $user_photo = 'C:/xampp/htdocs/joBBoard/img/default_photo.png';

            //set default logo photo
            $logo_photo = 'C:/xampp/htdocs/joBBoard/img/default_logo.png';

            $this->setUser($_SESSION["user_id"], $this->full_name, $this->position, $user_photo, $this->company, $this->description, $this->country, $logo_photo, "active");
            $this->setUserContacts($_SESSION["user_id"], $this->full_name);
        }
    }
    
    private function isEmptySubmit() {
        if (empty($this->full_name) || empty($this->position) || empty($this->company) 
            || empty($this->description) || empty($this->country)) {
            return true;
        } else {
            return false;
        }
    }   

    private function fetchCountryId($country) {
        $countryId = $this->getCountryId($country);
        return $countryId[0]["id"];
    }
}