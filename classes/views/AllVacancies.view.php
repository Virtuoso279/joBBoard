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

    public function getRecruiterVacancies($recruiterId) {
        $vacanciesData = $this->grabRecruiterVacancies($recruiterId);
        return $vacanciesData;
    }

    public function getRecommendedVacancies($candidateId) {
        $allVacanciesObject = new AllVacanciesContr(0, 0, 0, 0, 0, 0);
        $vacanciesData = $allVacanciesObject->checkRecommendedVacancies($candidateId);
        return $vacanciesData;
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
        $description = substr($vacancy["vacancy_descr"], 0, 400);
        return $description;
    }

    public function getSkills($vacancy) {
        $skillsArray = explode(",", $vacancy["skills"]);
        return $skillsArray;
    }

    public function getStatus($vacancy) {
        $status = $vacancy["vacancy_status"] === "active" ? "Активна" : "Неактивна";
        return $status;
    }

    public function setResponseAmount($vacancyId) {
        $this->setResponses($vacancyId);
    }

    public function getCategoriesList() {
        $categoriesList = $this->grabAllCategories();
        foreach ($categoriesList as $category) {
            echo '<option value="' . $category["category_name"] . '">' . $category["category_name"] . '</option>';
        }
    }

    public function getCountriesList() {
        $countriesList = $this->grabAllCountries();
        foreach ($countriesList as $country) {
            echo '<option value="' . $country["country_name"] . '">' . $country["country_name"] . '</option>';
        }
    }

    public function getExperienceList() {
        $experienceList = $this->grabAllExperience();
        foreach ($experienceList as $experience) {
            switch ($experience["months"]) {
                case '1':
                    echo '<input type="radio" id="1" name="experience" value="1">';
                    echo '<label for="1">Без досвіду</label><br>';
                    break;

                case '6':
                    echo '<input type="radio" id="6" name="experience" value="6">';
                    echo '<label for="6">Менше 6 місяців</label><br>';
                    break;

                case '12':
                    echo '<input type="radio" id="12" name="experience" value="12">';
                    echo '<label for="12">Від 6 до 12 місяців</label><br>';
                    break;

                case '24':
                    echo '<input type="radio" id="24" name="experience" value="24">';
                    echo '<label for="24">Від 1 року до 2 років</label><br>';
                    break;

                case '48':
                    echo '<input type="radio" id="48" name="experience" value="48">';
                    echo '<label for="48">Від 2 років до 4 років</label><br>';
                    break;

                case '49':
                    echo '<input type="radio" id="49" name="experience" value="49">';
                    echo '<label for="49">Від 4 років і більше</label><br>';
                    break;
            }
        }
    }

    public function getEnglishList() {
        $englishList = $this->grabAllEnglish();
        foreach ($englishList as $english) {
            echo '<input type="radio" id="' . $english["level_lang"] . '" name="english" value="' . $english["level_lang"] . '">';  
            echo '<label for="' . $english["level_lang"] . '">' . $english["level_lang"] . '</label><br>'; 
        }
    }  

    public function getEmplTypesList() {
        $emplTypesList = $this->grabAllEmplTypes();
        foreach ($emplTypesList as $emplType) {
            echo '<option value="' . $emplType["employment_type"] . '">' . $emplType["employment_type"] . '</option>';
        }
    }
}

