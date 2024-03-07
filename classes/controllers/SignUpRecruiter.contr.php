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
        if ($this->isEmptySubmit()) {
            header("Location: ../recruiter/signup_recruiter.php?error=emptyinput");
            exit();
        }        
        
        $this->country = $this->fetchCountryId($this->country);        

        $this->setUser($_SESSION["user_id"], $this->full_name, $this->position, $this->company, $this->description, $this->country, "active");
        $this->setUserContacts($_SESSION["user_id"], $this->full_name);
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