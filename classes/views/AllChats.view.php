<?php

class AllChatsView extends AllChatsModel {
    
    public function getAllChats($userType, $userId) {
        $chatsData = $this->grabAllChats($userType, $userId);
        return $chatsData;
    }

    public function getRecruiterVacancies($recruiterId) {
        $vacanciesData = $this->grabRecruiterVacancies($recruiterId);
        return $vacanciesData;
    }

    public function getPhoto($userType, $userId) {
        $profileInfo = $this->getUser($userType, $userId);
        if ($userType === "candidate") {
            $urlPhoto = str_replace("C:/xampp/htdocs", "http://localhost", $profileInfo[0]["photo_path"]);
        } elseif ($userType === "recruiter") {
            $urlPhoto = str_replace("C:/xampp/htdocs", "http://localhost", $profileInfo[0]["my_photo"]);
        }
        return $urlPhoto;
    }

    public function getCandidateName($userId) {
        $profileInfo = $this->getUser("candidate", $userId);
        return $profileInfo[0]["full_name"];
    }

    public function getCandidatePosition($userId) {
        $profileInfo = $this->getUser("candidate", $userId);
        return $profileInfo[0]["position"];
    }

    public function getCategory($chat) {
        $categoryName = $this->getCategoryName($chat["category_id"]);
        return $categoryName[0]["category_name"];
    }

    public function getEnglish($chat) {
        $englishName = $this->getEnglishName($chat["english_id"]);
        return $englishName[0]["level_lang"];
    }

    public function getExperience($chat) {
        $experienceName = $this->getExperienceName($chat["experience_id"]);
        if ($experienceName[0]["months"] == "1") {
            return "Без досвіду";
        } elseif ($experienceName[0]["months"] == "6") {
            return "Менше 6 місяців";
        } elseif ($experienceName[0]["months"] == "12") {
            return "Від 6 до 12 місяців";
        } elseif ($experienceName[0]["months"] == "24") {
            return "Від 1 року до 2 років";
        } elseif ($experienceName[0]["months"] == "48") {
            return "Від 2 років до 4 років";
        } elseif ($experienceName[0]["months"] == "49") {
            return "Від 4 років і більше";
        }
    }

    public function getCountry($chat) {
        $countryName = $this->getCountryName($chat["country_id"]);
        return $countryName[0]["country_name"];
    }

    public function getEmplType($chat) {
        $emplTypeName = $this->getEmplTypeName($chat["empl_type_id"]);
        return $emplTypeName[0]["employment_type"];
    }

    public function getCompanyName($chat) {
        $companyInfo = $this->getCompanyInfo($chat["recruiter_id"]);
        return $companyInfo[0]["company_name"];
    }

    public function getRecruiterInfo($chat) {
        $recruiterInfo = $this->getCompanyInfo($chat["recruiter_id"]);
        return $recruiterInfo[0]["full_name"] . ", " . $recruiterInfo[0]["position"];
    }

    public function getCreationData($chat) {
        $data = date('d.m.Y', strtotime($chat["created_at"]));
        return $data;
    }

    public function getStatus($vacancy) {
        $status = $vacancy["vacancy_status"] === "active" ? "Активна" : "Неактивна";
        return $status;
    }
}

