<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grabbing the data
    $full_name = htmlspecialchars($_POST["full_name"], ENT_QUOTES, 'UTF-8');
    $position = htmlspecialchars($_POST["position"], ENT_QUOTES, 'UTF-8');
    $status = $_POST["status"];   //add status
    $category = $_POST["category"];
    $skills = $_POST["skills"];
    $country = $_POST["country"];
    $resume = $_FILES["resume"];
    $photo = $_FILES["photo"];   //add photo
    $salary = filter_input(INPUT_POST, "salary", FILTER_SANITIZE_NUMBER_INT);
    $english = $_POST["english"];
    $experience = $_POST["experience"];

    // Instantiate Profile class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/ProfileCandidate.model.php";
    require_once "../classes/controllers/ProfileCandidate.contr.php";

    // Create user object
    $profileCandidate = new ProfileContrCandidate($full_name, $position, $status, $category, $skills, $country, $resume, $photo, $salary, $english, $experience);

    // Running error handlers and user signup
    $profileCandidate->changeProfileInfo();

    // Redirect to Profile page
    header("Location: ../candidate/profile_candidate.php");

} else {
    header("Location: ../candidate/profile_candidate.php");
}
