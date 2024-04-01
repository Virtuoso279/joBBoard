<?php 

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
        // Grabbing the data
        $vacancy = null;
    } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter") {
        // Grabbing the data
        $vacancy = $_POST["vacancy"] !== "all_vacancies" ? $_POST["vacancy"] : null;
    } else {
        header("Location: ../index.php?error=invalid_usertype");
        exit();
    }

    $type1 = $_POST["type1"] === "refusal" ? $_POST["type1"] : null;
    $type2 = $_POST["type2"] === "inactive" ? $_POST["type2"] : null;

    // Instantiate AllChats class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/AllChats.model.php";
    require_once "../classes/controllers/AllChats.contr.php";

    // Create user object
    $allChatsObject = new AllChatsContr($vacancy, $type1, $type2);

    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
        $allChatsObject->getChatsListCandidate();
    } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter") {
        $allChatsObject->getChatsListRecruiter();
    }

    // Redirect to Profile page
    header("Location: ../pages/all_chats.php");

} else {
    header("Location: ../pages/all_chats.php");
}
