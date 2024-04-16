<?php

class ProfileContrCandidate extends ProfileModelCandidate{
    private $full_name;
    private $position;
    private $status;  // add status
    private $category;
    private $skills;
    private $country;
    private $resume;
    private $photo;  // add photo
    private $salary;
    private $english;
    private $experience;

    public function __construct($full_name, $position, $status, $category, $skills, $country, $resume, $photo, $salary, $english, $experience) {
        $this->full_name = $full_name;
        $this->position = $position;
        $this->status = $status;
        $this->category = $category;
        $this->skills = $skills;
        $this->country = $country;
        $this->resume = $resume;
        $this->photo = $photo;
        $this->salary = $salary;
        $this->english = $english;
        $this->experience = $experience;
    }

    public function changeProfileInfo() {
        session_start();
        $errors = [];

        if ($this->isEmptySubmit()) {
            $errors["emptyInput"] = "Fill in all fields!";
            // header("Location: ../candidate/profile_candidate.php?error=emptyinput");
            // exit();
        }       

        if ($this->isSalaryNotPositive()) {
            $errors["salaryNotPositive"] = "Salary must be positive number!";
        }

        if ($this->invalidStatus()) {
            $errors["invalidStatus"] = "Invalid user status!";
        }

        if ($errors) {
            $_SESSION["errors_profile_cand"] = $errors; 
            header("Location: ../candidate/profile_candidate.php"); 
            die();
        } else {
            $this->category = $this->fetchCategoryId($this->category);
            $this->english = $this->fetchEnglishId($this->english);
            $this->experience = $this->fetchExperienceId($this->experience);
            $this->country = $this->fetchCountryId($this->country);

            // check if resume was send
            if ($this->isResumeExist() && basename($this->resume["name"]) == null) {
                $profileInfo = $this->getUser($_SESSION["user_id"]);
                $target_file_resume = $profileInfo[0]["resume_path"];
            } elseif (!$this->isResumeExist() && basename($this->resume["name"]) == null) {
                header("Location: ../candidate/profile_candidate.php?error=resumenotexist");
                exit();            
            } elseif (basename($this->resume["name"]) != null) {
                // error handler
                if ($this->invalidResumeFile()) {
                    header("Location: ../candidate/profile_candidate.php?error=invalidresumefile");
                    exit();
                }

                //upload file resume
                $target_dir_resume = 'C:/xampp/htdocs/joBBoard/uploads/resume/';
                $target_file_resume = $target_dir_resume . basename($this->resume["name"]);
                move_uploaded_file($this->resume["tmp_name"], $target_file_resume);
            }

            // check if photo was send
            if (basename($this->photo["name"]) == null && !$this->isPhotoExist()) {
                $target_file_photo = 'C:/xampp/htdocs/joBBoard/img/default_photo.png';
            }
            elseif (basename($this->photo["name"]) == null && $this->isPhotoExist()) {
                $profileInfo = $this->getUser($_SESSION["user_id"]);
                $target_file_photo = $profileInfo[0]["photo_path"];
            } elseif (basename($this->photo["name"]) != null) {
                // error handler
                if ($this->invalidPhotoFile()) {
                    header("Location: ../candidate/profile_candidate.php?error=invalidphotofile");
                    exit();
                }

                //upload file photo
                $target_dir_photo = 'C:/xampp/htdocs/joBBoard/uploads/photo/';
                $target_file_photo = $target_dir_photo . basename($this->photo["name"]);
                move_uploaded_file($this->photo["tmp_name"], $target_file_photo);
            }

            $this->setUser($_SESSION["user_id"], $this->full_name, $this->position, $this->category, $this->getRowSkills(), $this->country, $target_file_resume, $target_file_photo, $this->salary, $this->english, $this->experience, $this->status);
        }
    }
    
    private function isEmptySubmit() {
        if (empty($this->full_name) || empty($this->position) || empty($this->category) 
            || empty($this->skills) || empty($this->country) || empty($this->salary)
            || empty($this->english) || empty($this->experience) && $this->experience !== "0" 
            || empty($this->status)) {
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

    private function invalidPhotoFile() {
        // Перевірка розширення файлу
        $allowed_extensions = array('jpg', 'png', 'svg');
        $file_extension = pathinfo($this->photo['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($file_extension), $allowed_extensions)) {
            return true;
        } elseif ($this->photo['size'] > 100000000) { // Перевірка розміру файлу (приклад - не більше 100 МБ)
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

    private function invalidStatus() {
        // Перевірка розширення статусу юзера
        $allowed_status = array('active', 'passive', 'stopsearch');

        if (!in_array(strtolower($this->status), $allowed_status)) {
            return true;
        } else {
            return false;
        }   
    }

    private function isResumeExist() {
        $profileInfo = $this->getUser($_SESSION["user_id"]);
        if ($profileInfo[0]["resume_path"] != null) {
            return true;
        } else {
            return false;
        }
    }

    private function isPhotoExist() {
        $profileInfo = $this->getUser($_SESSION["user_id"]);
        if ($profileInfo[0]["photo_path"] != null) {
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