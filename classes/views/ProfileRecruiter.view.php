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

    public function getCountry($userId) {
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
}