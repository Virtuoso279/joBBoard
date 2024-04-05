<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grabbing the data
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');

    // Instantiate Chat class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/Chat.model.php";
    require_once "../classes/controllers/Chat.contr.php";

    // Running error handlers
    if (!isset($_GET["vacancy_id"]) || !isset($_GET["chat_id"])) {
        header("Location: ../pages/all_chats.php?error=undefinedvacancychat");
        exit();
    } 

    // Create chatMessage object
    session_start();
    $chatId = $_GET["chat_id"];
    $vacancyId = $_GET["vacancy_id"];    
    if (isset($_SESSION["user_id"])) {
        $senderId = $_SESSION["user_id"];
    }

    $chatMessage = new ChatContr($chatId, $senderId, $message, $vacancyId);

    if ($chatId === "unknown") {
        $chatMessage->sendInNewChat();
    } else {
        $chatMessage->sendInExistChat();
    }

    // Redirect to all chats page
    $chatId = $chatMessage->fetchChatId();
    header("Location: ../pages/chat.php?chat_id=" . $chatId);

} else {
    header("Location: ../pages/all_chats.php");
}
