<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grabbing the data
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');
    $userType = $_POST["userType"];

    // Instantiate Signup class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/SignUp.model.php";
    require_once "../classes/controllers/SignUp.contr.php";

    // Create user object
    $_SESSION["user_type"] = $userType;
    $signupUser = new SignUpContr($email, $pwd);

    // Running error handlers and user signup
    $signupUser->signupUser();

    // Get user id
    $userId = $signupUser->fetchUserId($name);
    $_SESSION["user_id"] = $userId;

    // Redirect to signup page
    if ($_SESSION["user_type"] === "candidate") {
        header("Location: ../signup_candidate.php");
    } elseif ($_SESSION["user_type"] === "recruiter") {
        header("Location: ../signup_recruiter.php");
    } else {
        header("Location: ../index.php?error=invalid_usertype");
        exit();
    }

} else {
    header("Location: ../index.php");
}
