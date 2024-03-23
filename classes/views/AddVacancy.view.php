<?php

class AddVacancyView extends AddVacancyModel {
    
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
        return $experienceName[0]["months"];
    }

    public function getCountry($vacancy) {
        $countryName = $this->getCountryName($vacancy["country_id"]);
        return $countryName[0]["country_name"];
    }

    public function getEmplType($vacancy) {
        $emplTypeName = $this->getEmplTypeName($vacancy["empl_type_id"]);
        return $emplTypeName[0]["employment_type"];
    }

    public function getSkills($vacancy) {
        $skillsArray = explode(",", $vacancy["skills"]);
        return $skillsArray;
    }
}

