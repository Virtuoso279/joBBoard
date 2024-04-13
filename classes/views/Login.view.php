<?php

session_start();

class LoginView {
    
    public function loginInput() {
    
        if (isset($_SESSION["login_data"]["email"]) && !isset($_SESSION["errors_login"]["invalidEmail"])) {        
            echo '<input type="text" name="email" placeholder="Email" value="' . $_SESSION["login_data"]["email"] . '">';
        } else {
            echo '<input type="text" name="email" placeholder="Email">';
        }
    
        echo '<input type="password" name="pwd" placeholder="Password">';
    }
    
    public function checkLoginErrors() {
        if (isset($_SESSION["errors_login"])) {
            $errors = $_SESSION["errors_login"];
    
            echo "<br>";
    
            foreach ($errors as $error) {
                echo '<p class="form-error">' . $error . '</p>';
            }
    
            unset($_SESSION["errors_login"]);
        }
    }
}