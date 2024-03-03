<?php 

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['resume'])) {

    // Grabbing the data
    $full_name = htmlspecialchars($_POST["full_name"], ENT_QUOTES, 'UTF-8');
    $position = htmlspecialchars($_POST["position"], ENT_QUOTES, 'UTF-8');
    $category = $_POST["category"];
    $skills = $_POST["skills"];
    $country = $_POST["country"];
    $resume = $_FILES["resume"];
    $salary = filter_input(INPUT_POST, "salary", FILTER_SANITIZE_NUMBER_INT);
    $english = $_POST["english"];
    $experience = $_POST["experience"];

    // Instantiate Signup class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/SignUpCandidate.model.php";
    require_once "../classes/controllers/SignUpCandidate.contr.php";

    // Create user object
    $signupUserCandidate = new SignUpContrCandidate($full_name, $position, $category, $skills, $country, $resume, $salary, $english, $experience);

    // Running error handlers and user signup
    $signupUserCandidate->addProfileInfo();
   
    //Redirect to profile page
    header("Location: ../profile.php");

} else {
    header("Location: ../signup_candidate.php");
}
