<?php 

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grabbing the data
    $full_name = htmlspecialchars($_POST["full_name"], ENT_QUOTES, 'UTF-8');
    $aboutme = htmlspecialchars($_POST["aboutme"], ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_NUMBER_INT);
    $telegram = filter_input(INPUT_POST, "telegram", FILTER_SANITIZE_URL);
    $linkedin = filter_input(INPUT_POST, "linkedin", FILTER_SANITIZE_URL);
    $projects = filter_input(INPUT_POST, "projects", FILTER_SANITIZE_URL);

    // Instantiate Profile class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/Contacts.model.php";
    require_once "../classes/controllers/Contacts.contr.php";

    // Create Contacts object
    if (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"])) {
        $contacts = new ContactsContr($_SESSION["user_id"], $_SESSION["user_type"], $full_name, $aboutme, $email, $phone, $telegram, $linkedin, $projects);
    } else {
        header("Location: ../index.php?error=invalid_usertype_userid");
        exit();
    }

    // Running error handlers and user signup
    $contacts->changeContactsInfo();

    // Redirect to Contacts page
    header("Location: ../pages/contacts.php");

} else {
    header("Location: ../pages/contacts.php");
}
