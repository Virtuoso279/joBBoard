<?php 

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grabbing the data
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');

    // Instantiate Signup class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/Login.model.php";
    require_once "../classes/controllers/Login.contr.php";

    // Create user object
    $loginUser = new LoginContr($email, $pwd);

    // Running error handlers and user signup
    $loginUser->loginUser();

    // Redirect to profile page
    if ($_SESSION["user_type"] === "candidate") {
        header("Location: ../candidate/profile_candidate.php");
    } elseif ($_SESSION["user_type"] === "recruiter") {
        header("Location: ../recruiter/profile_recruiter.php");
    } else {
        header("Location: ../index.php?error=invalid_usertype");
        exit();
    }

} else {
    header("Location: ../index.php");
}
