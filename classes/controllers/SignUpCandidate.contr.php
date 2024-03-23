<?php

session_start();

class SignUpContrCandidate extends SignUpModelCandidate{
    private $full_name;
    private $position;
    private $category;
    private $skills;
    private $country;
    private $resume;
    private $salary;
    private $english;
    private $experience;

    public function __construct($full_name, $position, $category, $skills, $country, $resume, $salary, $english, $experience) {
        $this->full_name = $full_name;
        $this->position = $position;
        $this->category = $category;
        $this->skills = $skills;
        $this->country = $country;
        $this->resume = $resume;
        $this->salary = $salary;
        $this->english = $english;
        $this->experience = $experience;
    }

    public function addProfileInfo() {
        if ($this->isEmptySubmit()) {
            header("Location: ../candidate/signup_candidate.php?error=emptyinput");
            exit();
        }       

        if ($this->invalidResumeFile()) {
            header("Location: ../candidate/signup_candidate.php?error=invalidresumefile");
            exit();
        }      

        if ($this->isSalaryNotPositive()) {
            header("Location: ../candidate/signup_candidate.php?error=salarynotpositive");
            exit();
        }
        
        $this->category = $this->fetchCategoryId($this->category);
        $this->english = $this->fetchEnglishId($this->english);
        $this->experience = $this->fetchExperienceId($this->experience);
        $this->country = $this->fetchCountryId($this->country);

        //upload file resume
        $target_dir = 'C:/xampp/htdocs/joBBoard/uploads/resume/';
        $target_file = $target_dir . basename($this->resume["name"]);
        move_uploaded_file($this->resume["tmp_name"], $target_file);

        //set default user photo
        $user_photo = 'C:/xampp/htdocs/joBBoard/img/default_photo.png';

        $this->setUser($_SESSION["user_id"], $this->full_name, $this->position, $this->category, $this->getRowSkills(), $this->country, $target_file, $user_photo, $this->salary, $this->english, $this->experience, "active");
        $this->setUserContacts($_SESSION["user_id"], $this->full_name);
    }
    
    private function isEmptySubmit() {
        if (empty($this->full_name) || empty($this->position) || empty($this->category) 
            || empty($this->skills) || empty($this->country) || empty($this->resume) || empty($this->salary)
            || empty($this->english) || empty($this->experience) || empty($this->experience)) {
            return true;
        } else {
            return false;
        }
    }      
      
    private function invalidResumeFile() {
        // Перевірка розширення файлу
        $allowed_extensions = array('pdf', 'doc', 'docx', 'txt');
        $file_extension = pathinfo($this->resume['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($file_extension), $allowed_extensions)) {
            return true;
        } elseif ($this->resume['size'] > 100000000) { // Перевірка розміру файлу (приклад - не більше 100 МБ)
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

    private function getRowSkills() {
        $rowSkills = "";
        foreach ($this->skills as $skill) {
            $rowSkills = $rowSkills . $skill . ",";
        }
        //grab string without last symbol = ','
        return substr($rowSkills, 0, -1);
    }
}