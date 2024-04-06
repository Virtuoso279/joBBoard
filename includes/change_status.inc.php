<?php

require_once "../classes/Dbh.php";
require_once "../classes/models/Chat.model.php";
require_once "../classes/controllers/Chat.contr.php";

//create temp chat object
$tempChat = new ChatContr(1, 1, "", 1);

if (isset($_GET["type"]) && $_GET["type"] === "stopsearch" && isset($_GET["userId"])) {
    $tempChat->setUserStatus($_GET["userId"], "stopsearch");
} elseif (isset($_GET["type"]) && $_GET["type"] === "vacancynot" && isset($_GET["chatId"])) {
    $tempChat->setChatStatus($_GET["chatId"], "vacancynot");
} elseif (isset($_GET["type"]) && $_GET["type"] === "candidatenot" && isset($_GET["chatId"])) {
    $tempChat->setChatStatus($_GET["chatId"], "candidatenot");
} else {
    header("Location: ../pages/all_chats.php?error=incorrectsenddata");
    exit();
}

// Going back to the chat page
header("Location: ../pages/chat.php?chat_id=" . $_GET["chatId"]); 