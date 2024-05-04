<?php

session_start();

class SignUpViewRecruiter extends SignUpModelRecruiter {
    
    public function signupRecruiterInput() {
        echo '<div class="left-column">';

        echo '<div class="column-item">';        
        echo '<label for="full_name">Введіть призвіще та ім’я:</label><br>';
        if (isset($_SESSION["signup_data_recr"]["full_name"])) {        
            echo '<input type="text" id="full_name" name="full_name" placeholder="Full name" value="' . $_SESSION["signup_data_recr"]["full_name"] . '" class="input-text"><br>';
        } else {
            echo '<input type="text" id="full_name" name="full_name" placeholder="Full name" class="input-text"><br>';
        }
        echo '</div>';

        echo '<div class="column-item">';
        echo '<label for="position">Введіть назву своєї посади:</label><br>';
        if (isset($_SESSION["signup_data_recr"]["position"])) {        
            echo '<input type="text" id="position" name="position" placeholder="Position" value="' . $_SESSION["signup_data_recr"]["position"] . '" class="input-text"><br>';
        } else {
            echo '<input type="text" id="position" name="position" placeholder="Position" class="input-text"><br>';
        }
        echo '</div>';

        echo '<div class="column-item">';
        echo '<label for="company">Введіть назву своєї компанії, де працюєте:</label><br>';
        if (isset($_SESSION["signup_data_recr"]["company"])) {        
            echo '<input type="text" id="company" name="company" placeholder="Company" value="' . $_SESSION["signup_data_recr"]["company"] . '" class="input-text"><br>';
        } else {
            echo '<input type="text" id="company" name="company" placeholder="Company" class="input-text"><br>';
        }
        echo '</div>';

        echo '<div class="column-item">';
        echo '<label for="country">Оберіть країну розташування компанії</label><br>';
        echo '<select name="country" id="country" size="1">';
        if (isset($_SESSION["signup_data_recr"]["country"])) {
            $this->getCountries($_SESSION["signup_data_recr"]["country"]);
        } else {
            $this->getCountries("notchoosed");
        }
        echo '</select><br>';
        echo '</div>';

        echo '<div class="column-item">';
        echo '<a href="../includes/delete_user.inc.php">Скасувати</a>';
        echo '</div>';

        echo '</div>';
        echo '<div class="right-column">';

        echo '<div class="column-item">';
        echo '<label for="description">Опис компанії:</label><br>';
        if (isset($_SESSION["signup_data_recr"]["description"])) {        
            echo '<textarea name="description" id="description" rows="10" cols="50" placeholder="Description" class="input-text">'. $_SESSION["signup_data_recr"]["description"] . '</textarea><br>';
        } else {
            echo '<textarea name="description" id="description" rows="10" cols="50" placeholder="Description" class="input-text"></textarea><br>';
        }
        echo '</div>';
    }
    
    public function checkSignupRecruiterErrors() {
        if (isset($_SESSION["errors_signup_recr"])) {
            $errors = $_SESSION["errors_signup_recr"];
    
            foreach ($errors as $error) {
                echo '<span class="form-error">' . $error . '</span>';
            }
    
            unset($_SESSION["errors_signup_recr"]);
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
}