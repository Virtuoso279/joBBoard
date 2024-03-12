<?php

class ProfileContrRecruiter extends ProfileModelRecruiter{
    private $full_name;
    private $position;
    private $photo;  // add photo
    private $company;
    private $description;
    private $logo;  // add logo
    private $country;    
    private $status;  // add status

    public function __construct($full_name, $position, $status, $photo, $company, $description, $country, $logo) {
        $this->full_name = $full_name;
        $this->position = $position;
        $this->status = $status;
        $this->photo = $photo;
        $this->company = $company;
        $this->description = $description;
        $this->country = $country;  
        $this->logo = $logo;      
    }

    public function changeProfileInfo() {
        session_start();

        if ($this->isEmptySubmit()) {
            header("Location: ../recruiter/signup_recruiter.php?error=emptyinput");
            exit();
        }      
        
        if ($this->invalidStatus()) {
            header("Location: ../recruiter/signup_recruiter.php?error=invalidstatus");
            exit();
        }
        
        $this->country = $this->fetchCountryId($this->country);  
        
        // check if photo was send
        if (basename($this->photo["name"]) == null && !$this->isPhotoExist()) {
            $target_file_photo = 'C:/xampp/htdocs/joBBoard/img/default_photo.png';
        } elseif (basename($this->photo["name"]) == null && $this->isPhotoExist()) {
            $profileInfo = $this->getUser($_SESSION["user_id"]);
            $target_file_photo = $profileInfo[0]["my_photo"];
        } elseif (basename($this->photo["name"]) != null) {
            // error handler
            if ($this->invalidPhotoFile()) {
                header("Location: ../recruiter/signup_recruiter.php?error=invalidphotofile");
                exit();
            }

            //upload file photo
            $target_dir_photo = 'C:/xampp/htdocs/joBBoard/uploads/photo/';
            $target_file_photo = $target_dir_photo . basename($this->photo["name"]);
            move_uploaded_file($this->photo["tmp_name"], $target_file_photo);
        }

        // check if logo was send
        if (basename($this->logo["name"]) == null && !$this->isLogoExist()) {
            $target_file_logo = 'C:/xampp/htdocs/joBBoard/img/default_logo.png';
        }
        elseif (basename($this->logo["name"]) == null && $this->isLogoExist()) {
            $profileInfo = $this->getUser($_SESSION["user_id"]);
            $target_file_logo = $profileInfo[0]["company_photo"];
        } elseif (basename($this->logo["name"]) != null) {
            // error handler
            if ($this->invalidLogoFile()) {
                header("Location: ../candidate/profile_candidate.php?error=invalidlogofile");
                exit();
            }

            //upload file logo
            $target_dir_logo = 'C:/xampp/htdocs/joBBoard/uploads/logo/';
            $target_file_logo = $target_dir_logo . basename($this->logo["name"]);
            move_uploaded_file($this->logo["tmp_name"], $target_file_logo);
        }

        $this->setUser($_SESSION["user_id"], $this->full_name, $this->position, $target_file_photo, $this->company, $this->description, $target_file_logo, $this->country, $this->status);
    }
    
    private function isEmptySubmit() {
        if (empty($this->full_name) || empty($this->position) || empty($this->company) 
            || empty($this->description) || empty($this->country)) {
            return true;
        } else {
            return false;
        }
    }   

    private function invalidStatus() {
        // Перевірка розширення статусу юзера
        $allowed_status = array('active', 'passive');

        if (!in_array(strtolower($this->status), $allowed_status)) {
            return true;
        } else {
            return false;
        }   
    }

    private function invalidPhotoFile() {
        // Перевірка розширення файлу
        $allowed_extensions = array('jpg', 'png', 'svg');
        $file_extension = pathinfo($this->photo['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($file_extension), $allowed_extensions)) {
            return true;
        } elseif ($this->photo['size'] > 100000000) { // Перевірка розміру файлу (приклад - не більше 100 МБ)
            return true;
        } else {
            return false;
        }        
    }

    private function invalidLogoFile() {
        // Перевірка розширення файлу
        $allowed_extensions = array('jpg', 'png', 'svg');
        $file_extension = pathinfo($this->logo['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($file_extension), $allowed_extensions)) {
            return true;
        } elseif ($this->photo['size'] > 100000000) { // Перевірка розміру файлу (приклад - не більше 100 МБ)
            return true;
        } else {
            return false;
        }        
    }

    private function isPhotoExist() {
        $profileInfo = $this->getUser($_SESSION["user_id"]);
        if ($profileInfo[0]["my_photo"] != null) {
            return true;
        } else {
            return false;
        }
    }

    private function isLogoExist() {
        $profileInfo = $this->getUser($_SESSION["user_id"]);
        if ($profileInfo[0]["company_photo"] != null) {
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