<?php

class AddVacancyContr extends AddVacancyModel{
    private $title; 
    private $description; 
    private $category; 
    private $skills; 
    private $country;
    private $english;   
    private $experience;   
    private $salary;   
    private $empl_type;   

    public function __construct($title, $description, $category, $skills, $country, $english, $experience, $salary, $empl_type) {
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->skills = $skills;
        $this->country = $country;
        $this->english = $english;
        $this->experience = $experience;
        $this->salary = $salary;
        $this->empl_type = $empl_type;
    }

    public function addVacancy($vacancyId) {
        session_start();
        $errors = [];

        if ($this->isEmptySubmit()) {
            $errors["emptyInput"] = "Fill in all fields!";
            // header("Location: ../recruiter/my_vacancies.php?error=emptyinput");
            // exit();
        }             

        if ($this->isSalaryNotPositive()) {
            $errors["salaryNotPositive"] = "Salary must be positive number!";
        }

        if ($errors) {
            $_SESSION["errors_addvacancy"] = $errors; 

            if ($vacancyId === "new vacancy") {
                $vacancyData = [
                    "title" => $this->title,
                    "description" => $this->description,
                    "category" => $this->category,
                    "skills" => $this->skills,
                    "country" => $this->country,
                    "salary" => $this->salary,
                    "english" => $this->english,
                    "experience" => $this->experience,
                    "empl_type" => $this->empl_type
                ];
                $_SESSION["vacancy_data"] = $vacancyData;
                
                header("Location: ../pages/add_vacancy.php"); 
                die();
            } else {
                header("Location: ../pages/add_vacancy.php?vacancy_id=" . $vacancyId); 
                die();
            }
        } else {
            $this->category = $this->fetchCategoryId($this->category);
            $this->english = $this->fetchEnglishId($this->english);
            $this->experience = $this->fetchExperienceId($this->experience);
            $this->country = $this->fetchCountryId($this->country);
            $this->empl_type = $this->fetchEmplTypeId($this->empl_type);

            if (isset($_SESSION["user_id"])) {
                $recruiterId = $_SESSION["user_id"];
            }
            
            if ($vacancyId === "new vacancy") {
                $this->createVacancy($recruiterId, $this->title, $this->description, $this->category, $this->getRowSkills(), $this->country, $this->english, $this->experience, $this->salary, $this->empl_type);
            } else {
                $this->changeVacancy($vacancyId, $this->title, $this->description, $this->category, $this->getRowSkills(), $this->country, $this->english, $this->experience, $this->salary, $this->empl_type);
            }
        }
    }

    private function isEmptySubmit() {
        if (empty($this->title) || empty($this->description) || empty($this->category) 
            || empty($this->skills) || empty($this->country) || empty($this->salary)
            || empty($this->english) || empty($this->experience) || empty($this->empl_type)) {
            return true;
        } else {
            return false;
        }
    }

    private function isSalaryNotPositive() {
        if ($this->salary <= 0) {
            return true;
        } else {
            return false;
        }
    }

    private function fetchCategoryId($category) {
        $categoryId = $this->getCategoryId($category);
        return $categoryId[0]["id"];
    }   
    
    private function fetchEnglishId($english) {
        $englishId = $this->getEnglishId($english);
        return $englishId[0]["id"];
    }

    private function fetchExperienceId($experience) {
        $experienceId = $this->getExperienceId($experience);
        return $experienceId[0]["id"];
    }

    private function fetchCountryId($country) {
        $countryId = $this->getCountryId($country);
        return $countryId[0]["id"];
    } 
    
    private function fetchEmplTypeId($empl_type) {
        $emplTypeId = $this->getEmplTypeId($empl_type);
        return $emplTypeId[0]["id"];
    } 

    private function getRowSkills() {
        $rowSkills = "";
        foreach ($this->skills as $skill) {
            $rowSkills = $rowSkills . $skill . ",";
        }
        //grab string without last symbol = ','
        return substr($rowSkills, 0, -1);
    }

    public function deleteVacancy($vacancyId) {
        $this->removeVacancy($vacancyId);
    }
}