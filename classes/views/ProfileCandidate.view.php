<?php

class ProfileViewCandidate extends ProfileModelCandidate{
    public function getCandidateInfo(string $userId) {
        $profileInfo = $this->getUser($userId);
        return $profileInfo[0];
    }

    public function getFullName($userId) {
        $profileInfo = $this->getUser($userId);
        echo $profileInfo[0]["full_name"];
    }

    public function getPosition($userId) {
        $profileInfo = $this->getUser($userId);
        echo $profileInfo[0]["position"];
    }

    public function getCategories($userId) {
        $categoriesList = $this->grabAllCategories();
        $categoryData = $this->getCategory($userId);
        foreach ($categoriesList as $category) {
            if ($categoryData == $category["category_name"]) {
                echo '<option value="' . $category["category_name"] . '" selected>' . $category["category_name"] . '</option>';
            } else {
                echo '<option value="' . $category["category_name"] . '">' . $category["category_name"] . '</option>';
            }
        }
    }

    private function getCategory($userId) {
        $profileInfo = $this->getUser($userId);
        $categoryId =  $profileInfo[0]["category_id"];
        $categoryName = $this->getCategoryName($categoryId);
        return $categoryName[0]["category_name"];
    }

    public function getEnglish($userId) {
        $englishList = $this->grabAllEnglish();
        $englishData = $this->getEnglishLevel($userId);
        foreach ($englishList as $english) {
            if ($englishData == $english["level_lang"]) {
                echo '<div class="radio-input-element">';
                    echo '<input type="radio" id="' . $english["level_lang"] . '" name="english" value="' . $english["level_lang"] . '" checked>';
                    echo '<label for="' . $english["level_lang"] . '">' . $english["level_lang"] . '</label><br>';
                echo '</div>';    
            } else {
                echo '<div class="radio-input-element">';
                    echo '<input type="radio" id="' . $english["level_lang"] . '" name="english" value="' . $english["level_lang"] . '">';  
                    echo '<label for="' . $english["level_lang"] . '">' . $english["level_lang"] . '</label><br>';
                echo '</div>';
            }
        }
    }

    private function getEnglishLevel($userId) {
        $profileInfo = $this->getUser($userId);
        $englishId =  $profileInfo[0]["english_id"];
        $englishName = $this->getEnglishName($englishId);
        return $englishName[0]["level_lang"];
    }

    public function getExperience($userId) {
        $experienceList = $this->grabAllExperience();
        $experienceData = $this->getExperienceMonth($userId);
        foreach ($experienceList as $experience) {
            if ($experienceData == $experience["months"]) {
                switch ($experience["months"]) {
                    case '1':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="1" name="experience" value="1" checked>';
                            echo '<label for="1">Без досвіду</label><br>';
                        echo '</div>';
                        break;
    
                    case '6':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="6" name="experience" value="6" checked>';
                            echo '<label for="6">Менше 6 місяців</label><br>';
                        echo '</div>';
                        break;
    
                    case '12':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="12" name="experience" value="12" checked>';
                            echo '<label for="12">Від 6 до 12 місяців</label><br>';
                        echo '</div>';
                        break;
    
                    case '24':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="24" name="experience" value="24" checked>';
                            echo '<label for="24">Від 1 року до 2 років</label><br>';
                        echo '</div>';
                        break;
    
                    case '48':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="48" name="experience" value="48" checked>';
                            echo '<label for="48">Від 2 років до 4 років</label><br>';
                        echo '</div>';
                        break;
    
                    case '49':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="49" name="experience" value="49" checked>';
                            echo '<label for="49">Від 4 років і більше</label><br>';
                        echo '</div>';
                        break;
                }
            } else {
                switch ($experience["months"]) {
                    case '1':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="1" name="experience" value="1">';
                            echo '<label for="1">Без досвіду</label><br>';
                        echo '</div>';
                        break;
    
                    case '6':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="6" name="experience" value="6">';
                            echo '<label for="6">Менше 6 місяців</label><br>';
                        echo '</div>';
                        break;
    
                    case '12':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="12" name="experience" value="12">';
                            echo '<label for="12">Від 6 до 12 місяців</label><br>';
                        echo '</div>';
                        break;
    
                    case '24':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="24" name="experience" value="24">';
                            echo '<label for="24">Від 1 року до 2 років</label><br>';
                        echo '</div>';
                        break;
    
                    case '48':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="48" name="experience" value="48">';
                            echo '<label for="48">Від 2 років до 4 років</label><br>';
                        echo '</div>';
                        break;
    
                    case '49':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="49" name="experience" value="49">';
                            echo '<label for="49">Від 4 років і більше</label><br>';
                        echo '</div>';
                        break;
                }
            }
        }
    }

    private function getExperienceMonth($userId) {
        $profileInfo = $this->getUser($userId);
        $experienceId =  $profileInfo[0]["experience_id"];
        $experienceName = $this->getExperienceName($experienceId);
        return $experienceName[0]["months"];
    }

    public function getCountries($userId) {
        $countriesList = $this->grabAllCountries();
        $countryData = $this->getCountry($userId);
        foreach ($countriesList as $country) {
            if ($countryData == $country["country_name"]) {
                echo '<option value="' . $country["country_name"] . '" selected>' . $country["country_name"] . '</option>';
            } else {
                echo '<option value="' . $country["country_name"] . '">' . $country["country_name"] . '</option>';
            }
        }
    }

    private function getCountry($userId) {
        $profileInfo = $this->getUser($userId);
        $countryId =  $profileInfo[0]["country_id"];
        $countryName = $this->getCountryName($countryId);
        return $countryName[0]["country_name"];
    }

    public function getSkills($userId) {
        $profileInfo = $this->getUser($userId);
        $skillsArray = explode(",", $profileInfo[0]["skills"]);

        $skillsList = $this->grabAllSkills();
        foreach ($skillsList as $skill) {
            if (in_array($skill["skill_title"], $skillsArray)) {
                echo '<option value="' . $skill["skill_title"] . '" selected>' . $skill["skill_title"] . '</option>';
            } else {
                echo '<option value="' . $skill["skill_title"] . '">' . $skill["skill_title"] . '</option>';
            }
        }
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

    public function checkProfileCandidateErrors() {
        if (isset($_SESSION["errors_profile_cand"])) {
            $errors = $_SESSION["errors_profile_cand"];
    
            foreach ($errors as $error) {
                echo '<p class="form-error">' . $error . '</p>';
            }
    
            unset($_SESSION["errors_profile_cand"]);
        }
    }
}