<?php

session_start();

class SignUpViewCandidate extends SignUpModelCandidate {
    
    public function signupCandidateInput() {
        echo '<div class="left-column">';

        echo '<div class="column-item">';
        echo '<label for="full_name">Введіть призвіще та ім’я:</label><br>';
        if (isset($_SESSION["signup_data_cand"]["full_name"])) {        
            echo '<input type="text" id="full_name" name="full_name" placeholder="Full name" value="' . $_SESSION["signup_data_cand"]["full_name"] . '" class="input-text"><br>';
        } else {
            echo '<input type="text" id="full_name" name="full_name" placeholder="Full name" class="input-text"><br>';
        }
        echo '</div>';

        echo '<div class="column-item">';
        echo '<label for="position">Введіть назву посади:</label><br>';
        if (isset($_SESSION["signup_data_cand"]["position"])) {        
            echo '<input type="text" id="position" name="position" placeholder="Position" value="' . $_SESSION["signup_data_cand"]["position"] . '" class="input-text"><br>';
        } else {
            echo '<input type="text" id="position" name="position" placeholder="Position" class="input-text"><br>';
        }
        echo '</div>';
        
        echo '<div class="column-item">';
        echo '<label for="category">Оберіть категорію (сферу):</label><br>';
        echo '<select name="category" id="category" size="1">';
        if (isset($_SESSION["signup_data_cand"]["category"])) {
            $this->getCategories($_SESSION["signup_data_cand"]["category"]);
        } else {
            $this->getCategories("notchoosed");
        }
        echo '</select><br>';
        echo '</div>';

        echo '<div class="column-item">';
        echo '<label for="skills">Оберіть навички:</label><br>';
        echo '<select name="skills[]" id="skills" multiple>';
        if (isset($_SESSION["signup_data_cand"]["skills"])) {
            $this->getSkills($_SESSION["signup_data_cand"]["skills"]);
        } else {
            $this->getSkills("notchoosed");
        }
        echo '</select><br>';
        echo '</div>';

        echo '<div class="column-item">';
        echo '<label for="country">Оберіть країну перебування</label><br>';
        echo '<select name="country" id="country" size="1">';
        if (isset($_SESSION["signup_data_cand"]["country"])) {
            $this->getCountries($_SESSION["signup_data_cand"]["country"]);
        } else {
            $this->getCountries("notchoosed");
        }
        echo '</select><br>';
        echo '</div>';

        echo '<div class="column-item">';
        echo '<label for="resume">Завантажте файл резюме:</label><br>';
        echo '<input type="file" id="resume" name="resume" class="resume-input"><br>';
        echo '</div>';

        echo '<div class="column-item">';
        echo '<a href="../includes/delete_user.inc.php">Скасувати</a>';
        echo '</div>';

        echo '</div>';
        echo '<div class="right-column">';

        echo '<div class="column-item">';
        echo '<label for="salary">Введіть зарплатні очікування в $:</label><br>';
        if (isset($_SESSION["signup_data_cand"]["salary"]) && !isset($_SESSION["errors_signup_cand"]["salaryNotPositive"])) {
            echo '<input type="number" id="salary" name="salary" placeholder="Salary" value="'. $_SESSION["signup_data_cand"]["salary"] . '" class="input-text"><br>';
        } else {
            echo '<input type="number" id="salary" name="salary" placeholder="Salary" class="input-text"><br>';
        }
        echo '</div>';

        echo '<div class="column-item">';
        echo '<p>Рівень англійської:</p>';
        echo '<div class="radio-input">';
        if (isset($_SESSION["signup_data_cand"]["english"])) {
            $this->getEnglish($_SESSION["signup_data_cand"]["english"]);
        } else {
            $this->getEnglish("notchoosed");
        }
        echo '</div>';
        echo '</div>';

        echo '<div class="column-item">';
        echo '<p>Досвід роботи:</p>';
        echo '<div class="radio-input">';
        if (isset($_SESSION["signup_data_cand"]["experience"])) {
            $this->getExperience($_SESSION["signup_data_cand"]["experience"]);
        } else {
            $this->getExperience("notchoosed");
        }
        echo '</div>';
        echo '</div>';
    }
    
    public function checkSignupCandidateErrors() {
        if (isset($_SESSION["errors_signup_cand"])) {
            $errors = $_SESSION["errors_signup_cand"];
    
            foreach ($errors as $error) {
                echo '<span class="form-error">' . $error . '</span>';
            }
    
            unset($_SESSION["errors_signup_cand"]);
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
}