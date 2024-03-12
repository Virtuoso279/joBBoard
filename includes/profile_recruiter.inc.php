<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grabbing the data
    $full_name = htmlspecialchars($_POST["full_name"], ENT_QUOTES, 'UTF-8');
    $position = htmlspecialchars($_POST["position"], ENT_QUOTES, 'UTF-8');
    $company = htmlspecialchars($_POST["company"], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
    $status = $_POST["status"];   //add status
    $country = $_POST["country"];    
    $photo = $_FILES["photo"];   //add photo
    $logo = $_FILES["logo"];   //add logo

    // Instantiate Signup class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/ProfileRecruiter.model.php";
    require_once "../classes/controllers/ProfileRecruiter.contr.php";

    // Create user object
    $profileRecruiter = new ProfileContrRecruiter($full_name, $position, $status, $photo, $company, $description, $country, $logo);

    // Running error handlers and user signup
    $profileRecruiter->changeProfileInfo();
   
    //Redirect to profile page
    header("Location: ../recruiter/profile_recruiter.php");

} else {
    header("Location: ../recruiter/signup_recruiter.php");
}
