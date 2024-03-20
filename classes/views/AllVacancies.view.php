<?php

class AllVacanciesView extends AllVacanciesModel {
    
    public function getAllVacancies() {
        $vacanciesData = $this->grabAllVacancies();
        return $vacanciesData;
    }

    public function getVacancy($vacancy_id) {
        $vacancyData = $this->grabVacancy($vacancy_id);
        return $vacancyData;
    }

    public function getCategory($vacancy) {
        $categoryName = $this->getCategoryName($vacancy["category_id"]);
        return $categoryName[0]["category_name"];
    }

    public function getEnglish($vacancy) {
        $englishName = $this->getEnglishName($vacancy["english_id"]);
        return $englishName[0]["level_lang"];
    }

    public function getExperience($vacancy) {
        $experienceName = $this->getExperienceName($vacancy["experience_id"]);
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

    public function getCountry($vacancy) {
        $countryName = $this->getCountryName($vacancy["country_id"]);
        return $countryName[0]["country_name"];
    }

    public function getEmplType($vacancy) {
        $emplTypeName = $this->getEmplTypeName($vacancy["empl_type_id"]);
        return $emplTypeName[0]["employment_type"];
    }

    public function getLogo($vacancy) {
        $companyInfo = $this->getCompanyInfo($vacancy["recruiter_id"]);
        $urlPhotoLogo = str_replace("C:/xampp/htdocs", "http://localhost", $companyInfo[0]["company_photo"]);
        return $urlPhotoLogo;
    }

    public function getCompanyName($vacancy) {
        $companyInfo = $this->getCompanyInfo($vacancy["recruiter_id"]);
        return $companyInfo[0]["company_name"];
    }

    public function getRecruiterInfo($vacancy) {
        $recruiterInfo = $this->getCompanyInfo($vacancy["recruiter_id"]);
        return $recruiterInfo[0]["full_name"] . ", " . $recruiterInfo[0]["position"];
    }

    public function getCreationData($vacancy) {
        $data = date('d.m.Y', strtotime($vacancy["created_at"]));
        return $data;
    }

    public function getDescription($vacancy) {
        $description = substr($vacancy["vacancy_descr"], 0, 50);
        return $description;
    }

    public function getSkills($vacancy) {
        $skillsArray = explode(",", $vacancy["skills"]);
        return $skillsArray;
    }
}

