<?php

class ProfileViewRecruiter extends ProfileModelRecruiter{
    public function getFullName($userId) {
        $profileInfo = $this->getUser($userId);
        echo $profileInfo[0]["full_name"];
    }

    public function getPosition($userId) {
        $profileInfo = $this->getUser($userId);
        echo $profileInfo[0]["position"];
    }

    public function getCompanyName($userId) {
        $profileInfo = $this->getUser($userId);
        echo $profileInfo[0]["company_name"];
    }

    public function getCompanyDescr($userId) {
        $profileInfo = $this->getUser($userId);
        echo $profileInfo[0]["company_descr"];
    }

    public function getCountries($userId) {
        $countriesList = $this->grabAllCountries();
        $countryData = $this->getCountry($userId);
        foreach ($countriesList as $country) {
            if ($countryData == $country["country_name"]) {
                echo '<option value="' . $country["country_name"] . '" selected>' . $country["country_name"] . '</option>';
            } else {
                echo '<option value="' . $country["country_name"] . '">' . $country["country_name"] . '</option>';
            }
        }
    }

    private function getCountry($userId) {
        $profileInfo = $this->getUser($userId);
        $countryId =  $profileInfo[0]["country_id"];
        $countryName = $this->getCountryName($countryId);
        return $countryName[0]["country_name"];
    }

    public function getPhoto($userId) {
        $profileInfo = $this->getUser($userId);
        $urlPhoto = str_replace("C:/xampp/htdocs", "http://localhost", $profileInfo[0]["my_photo"]);
        return $urlPhoto;
    }

    public function getLogo($userId) {
        $profileInfo = $this->getUser($userId);
        $urlPhotoLogo = str_replace("C:/xampp/htdocs", "http://localhost", $profileInfo[0]["company_photo"]);
        return $urlPhotoLogo;
    }

    public function getStatus($userId) {
        $profileInfo = $this->getUser($userId);
        return $profileInfo[0]["user_status"];
    }

    public function checkProfileRecruiterErrors() {
        if (isset($_SESSION["errors_profile_recr"])) {
            $errors = $_SESSION["errors_profile_recr"];
    
            foreach ($errors as $error) {
                echo '<p class="form-error">' . $error . '</p>';
            }
    
            unset($_SESSION["errors_profile_recr"]);
        }
    }
}