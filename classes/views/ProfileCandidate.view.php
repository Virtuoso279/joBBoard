<?php

class ProfileViewCandidate extends ProfileModelCandidate{
    public function getFullName($userId) {
        $profileInfo = $this->getUser($userId);
        echo $profileInfo[0]["full_name"];
    }

    public function getPosition($userId) {
        $profileInfo = $this->getUser($userId);
        echo $profileInfo[0]["position"];
    }

    public function getCategory($userId) {
        $profileInfo = $this->getUser($userId);
        $categoryId =  $profileInfo[0]["category_id"];
        $categoryName = $this->getCategoryName($categoryId);
        return $categoryName[0]["category_name"];
    }

    public function getEnglish($userId) {
        $profileInfo = $this->getUser($userId);
        $englishId =  $profileInfo[0]["english_id"];
        $englishName = $this->getEnglishName($englishId);
        return $englishName[0]["level_lang"];
    }

    public function getExperience($userId) {
        $profileInfo = $this->getUser($userId);
        $experienceId =  $profileInfo[0]["experience_id"];
        $experienceName = $this->getExperienceName($experienceId);
        return $experienceName[0]["months"];
    }

    public function getCountry($userId) {
        $profileInfo = $this->getUser($userId);
        $countryId =  $profileInfo[0]["country_id"];
        $countryName = $this->getCountryName($countryId);
        return $countryName[0]["country_name"];
    }

    public function getSkills($userId) {
        $profileInfo = $this->getUser($userId);
        $skillsArray = explode(",", $profileInfo[0]["skills"]);
        return $skillsArray;
    }   

    public function getPhoto($userId) {
        $profileInfo = $this->getUser($userId);
        $urlPhoto = str_replace("C:/xampp/htdocs", "http://localhost", $profileInfo[0]["photo_path"]);
        return $urlPhoto;
    }

    public function getSalary($userId) {
        $profileInfo = $this->getUser($userId);
        echo $profileInfo[0]["salary"];
    }

    public function getStatus($userId) {
        $profileInfo = $this->getUser($userId);
        return $profileInfo[0]["user_status"];
    }
}