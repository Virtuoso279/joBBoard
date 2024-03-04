<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grabbing the data
    $full_name = htmlspecialchars($_POST["full_name"], ENT_QUOTES, 'UTF-8');
    $position = htmlspecialchars($_POST["position"], ENT_QUOTES, 'UTF-8');
    $company = htmlspecialchars($_POST["company"], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
    $country = $_POST["country"];    

    // Instantiate Signup class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/SignUpRecruiter.model.php";
    require_once "../classes/controllers/SignUpRecruiter.contr.php";

    // Create user object
    $signupUserRecruiter = new SignUpContrRecruiter($full_name, $position, $company, $description, $country);

    // Running error handlers and user signup
    $signupUserRecruiter->addProfileInfo();
   
    //Redirect to profile page
    header("Location: ../recruiter/profile_recruiter.php");

} else {
    header("Location: ../recruiter/signup_recruiter.php");
}
