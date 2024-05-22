<?php

class AddVacancyView extends AddVacancyModel {
    
    public function getVacancy($vacancy_id) {
        $vacancyData = $this->grabVacancy($vacancy_id);
        return $vacancyData;
    }

    public function getCategoryList($vacancy) {
        if ($vacancy === "emptyVacancy") {
            $this->getCategories("notchoosed");
        } else {
            $categoryName = $this->getCategoryName($vacancy["category_id"]);
            $categoryData = $categoryName[0]["category_name"];
            $this->getCategories($categoryData);
        }
    }

    public function getEnglishList($vacancy) {
        if ($vacancy === "emptyVacancy") {
            $this->getEnglish("notchoosed");
        } else {
            $englishName = $this->getEnglishName($vacancy["english_id"]);
            $englishData = $englishName[0]["level_lang"];
            $this->getEnglish($englishData);
        }
    }

    public function getExperienceList($vacancy) {
        if ($vacancy === "emptyVacancy") {
            $this->getExperience("notchoosed");
        } else {
            $experienceName = $this->getExperienceName($vacancy["experience_id"]);
            $experienceData = $experienceName[0]["months"];
            $this->getExperience($experienceData);
        }
    }

    public function getCountryList($vacancy) {
        if ($vacancy === "emptyVacancy") {
            $this->getCountries("notchoosed");
        } else {
            $countryName = $this->getCountryName($vacancy["country_id"]);
            $countryData = $countryName[0]["country_name"];
            $this->getCountries($countryData);
        }
    }
  
    public function getEmplTypeList($vacancy) {
        if ($vacancy === "emptyVacancy") {
            $this->getEmplTypes("notchoosed");
        } else {
            $emplTypeName = $this->getEmplTypeName($vacancy["empl_type_id"]);
            $emplTypeData = $emplTypeName[0]["employment_type"];
            $this->getEmplTypes($emplTypeData);
        }
    }

    public function getSkillsList($vacancy) {
        if ($vacancy === "emptyVacancy") {
            $this->getSkills("notchoosed");
        } else {
            $skillsArray = explode(",", $vacancy["skills"]);
            $this->getSkills($skillsArray);
        }
    }

    public function checkAddVacancyErrors() {
        if (isset($_SESSION["errors_addvacancy"])) {
            $errors = $_SESSION["errors_addvacancy"];
    
            foreach ($errors as $error) {
                echo '<span class="form-error">' . $error . '</span>';
            }
    
            unset($_SESSION["errors_addvacancy"]);
        }
    }

    private function getCategories($categoryData) {
        $categoriesList = $this->grabAllCategories();
        if ($categoryData === "notchoosed") {
            foreach ($categoriesList as $category) {
                echo '<option value="' . $category["category_name"] . '">' . $category["category_name"] . '</option>';
            }
        } else {
            foreach ($categoriesList as $category) {
                if ($categoryData == $category["category_name"]) {
                    echo '<option value="' . $category["category_name"] . '" selected>' . $category["category_name"] . '</option>';
                } else {
                    echo '<option value="' . $category["category_name"] . '">' . $category["category_name"] . '</option>';
                }                
            }
        }
    }

    private function getSkills($skills) {
        $skillsList = $this->grabAllSkills();
        if ($skills === "notchoosed") {
            foreach ($skillsList as $skill) {
                echo '<option value="' . $skill["skill_title"] . '">' . $skill["skill_title"] . '</option>';
            }
        } else {
            foreach ($skillsList as $skill) {
                $isFind = false;
                foreach ($skills as $value) {
                    if ($value == $skill["skill_title"]) {
                        echo '<option value="' . $skill["skill_title"] . '" selected>' . $skill["skill_title"] . '</option>';
                        $isFind = true;
                        break;
                    }
                }
                if (!$isFind) {
                    echo '<option value="' . $skill["skill_title"] . '">' . $skill["skill_title"] . '</option>';
                }                              
            }
        }
    }

    private function getCountries($countryData) {
        $countriesList = $this->grabAllCountries();
        if ($countryData === "notchoosed") {
            foreach ($countriesList as $country) {
                echo '<option value="' . $country["country_name"] . '">' . $country["country_name"] . '</option>';
            }
        } else {
            foreach ($countriesList as $country) {
                if ($countryData == $country["country_name"]) {
                    echo '<option value="' . $country["country_name"] . '" selected>' . $country["country_name"] . '</option>';
                } else {
                    echo '<option value="' . $country["country_name"] . '">' . $country["country_name"] . '</option>';
                }                
            }
        }
    }

    private function getExperience($experienceData) {
        $experienceList = $this->grabAllExperience();
        if ($experienceData === "notchoosed") {
            foreach ($experienceList as $experience) {
                switch ($experience["months"]) {
                    case '1':
                        echo '<div class="radio-input-element">';
                            echo '<input type="radio" id="1" name="experience" value="1" checked>';
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
        } else {
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
    }

    private function getEnglish($englishData) {
        $englishList = $this->grabAllEnglish();
        if ($englishData === "notchoosed") {
            foreach ($englishList as $english) {
                if ($english["level_lang"] === "Beginner") {
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
        } else {
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
    }

    private function getEmplTypes($emplTypeData) {
        $emplTypesList = $this->grabAllEmplTypes();
        if ($emplTypeData === "notchoosed") {
            foreach ($emplTypesList as $emplType) {
                echo '<option value="' . $emplType["employment_type"] . '">' . $emplType["employment_type"] . '</option>';
            }
        } else {
            foreach ($emplTypesList as $emplType) {
                if ($emplTypeData == $emplType["employment_type"]) {
                    echo '<option value="' . $emplType["employment_type"] . '" selected>' . $emplType["employment_type"] . '</option>';
                } else {
                    echo '<option value="' . $emplType["employment_type"] . '">' . $emplType["employment_type"] . '</option>';
                }                
            }
        }
    }
}

