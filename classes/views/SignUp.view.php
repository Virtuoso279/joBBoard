<?php

session_start();

class SignUpView {
    
    public function signupInput() {
    
        if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["invalidEmail"]) && !isset($_SESSION["errors_signup"]["userExist"])) {        
            echo '<input type="text" name="email" placeholder="Email" value="' . $_SESSION["signup_data"]["email"] . '">';
        } else {
            echo '<input type="text" name="email" placeholder="Email">';
        }
    
        echo '<input type="password" name="pwd" placeholder="Password">';

        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate" && !isset($_SESSION["errors_signup"]["invalidUserType"])) {
            echo '<input type="radio" id="recruiter" name="userType" value="recruiter">';
            echo '<label for="recruiter">Я роботодавець</label>';
            echo '<input type="radio" id="candidate" name="userType" value="candidate" checked>';
            echo '<label for="candidate">Я кандидат</label>';
        } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter" && !isset($_SESSION["errors_signup"]["invalidUserType"])) {
            echo '<input type="radio" id="recruiter" name="userType" value="recruiter" checked>';
            echo '<label for="recruiter">Я роботодавець</label>';
            echo '<input type="radio" id="candidate" name="userType" value="candidate">';
            echo '<label for="candidate">Я кандидат</label>';
        } else {
            echo '<input type="radio" id="recruiter" name="userType" value="recruiter">';
            echo '<label for="recruiter">Я роботодавець</label>';
            echo '<input type="radio" id="candidate" name="userType" value="candidate">';
            echo '<label for="candidate">Я кандидат</label>';
        }
    }
    
    public function checkSignupErrors() {
        if (isset($_SESSION["errors_signup"])) {
            $errors = $_SESSION["errors_signup"];
    
            echo "<br>";
    
            foreach ($errors as $error) {
                echo '<p class="form-error">' . $error . '</p>';
            }
    
            unset($_SESSION["errors_signup"]);
        }
    }
}