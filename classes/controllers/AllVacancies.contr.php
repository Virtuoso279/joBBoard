<?php

class AllVacanciesContr extends AllVacanciesModel{
    private $category; 
    private $country;
    private $english;   
    private $experience;   
    private $salary;   
    private $empl_type;   

    public function __construct($category, $country, $english, $experience, $salary, $empl_type) {
        $this->category = $category;
        $this->country = $country;
        $this->english = $english;
        $this->experience = $experience;
        $this->salary = $salary;
        $this->empl_type = $empl_type;
    }

    public function getVacanciesList() {

        $arrayInput = [];

        $query = "SELECT * FROM vacancies WHERE "; 

        if (!empty($this->category)) {
            $this->category = $this->fetchCategoryId($this->category);
            $query = $query . "category_id = ?";
            $arrayInput[] = $this->category;
        }    
        
        if ($this->english != null) {
            $this->english = $this->fetchEnglishId($this->english);
            if (count($arrayInput) > 0) {
                $query = $query . " AND english_id = ?";
            } else {
                $query = $query . "english_id = ?";
            }
            $arrayInput[] = $this->english;
        }

        if ($this->experience != null) {
            $this->experience = $this->fetchExperienceId($this->experience);
            if (count($arrayInput) > 0) {
                $query = $query . " AND experience_id = ?";
            } else {
                $query = $query . "experience_id = ?";
            }
            $arrayInput[] = $this->experience;
        }

        if (!empty($this->country)) {
            $this->country = $this->fetchCountryId($this->country);
            if (count($arrayInput) > 0) {
                $query = $query . " AND country_id = ?";
            } else {
                $query = $query . "country_id = ?";
            }
            $arrayInput[] = $this->country;
        }

        if (!empty($this->empl_type)) {
            $this->empl_type = $this->fetchEmplTypeId($this->empl_type);
            if (count($arrayInput) > 0) {
                $query = $query . " AND empl_type_id = ?";
            } else {
                $query = $query . "empl_type_id = ?";
            }
            $arrayInput[] = $this->empl_type;
        }

        $salaryInput = false;
        if (!empty($this->salary)) {
            $salaryInput = true;
            if (count($arrayInput) > 0) {
                $query = $query . " AND " . $this->getSalary();
            } else {
                $query = $query . $this->getSalary();
            }
        }

        session_start();
        if (count($arrayInput) == 0 && !$salaryInput) {
            header("Location: ../pages/all_vacancies.php?error=emptyfilters");
            exit();
        } else {
            $result =  $this->grabFilteredVacancies($query, $arrayInput);
            if ($result !== "Empty search!") {
                $_SESSION["vacancies"] = $result;
            } else {
                $_SESSION["vacancies"] = "Not found vacancies";
            }
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

    private function getSalary() {
        switch ($this->salary) {
            case '500':
                return "salary > 0 AND salary < 500";
                break;
            case '1000':
                return "salary > 500 AND salary < 1000";
                break;
            case '1500':
                return "salary > 1000 AND salary < 1500";
                break;
            case '2000':
                return "salary > 1500 AND salary < 2000";
                break;
            case '3000':
                return "salary > 2000 AND salary < 3000";
                break;
            case '4000':
                return "salary > 3000 AND salary < 4000";
                break;
            case '4001':
                return "salary > 4000";
                break;
            default:
                header("Location: ../pages/all_vacancies.php?error=incorrectsalary");
                exit();
        }
    }
}