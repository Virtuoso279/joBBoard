<?php
session_start();

if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
    require_once "../candidate/header_candidate.php";
} elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter") {
    require_once "../recruiter/header_recruiter.php";
} else {
    header("Location: ../index.php?error=invalid_usertype");
    exit();
}

include "../classes/models/Chat.model.php";
include "../classes/controllers/Chat.contr.php";
include "../classes/views/Chat.view.php";

$chatObject = new ChatView();

if (isset($_GET["chat_id"])) {
    $chat = $chatObject->getChat($_GET["chat_id"]);
    if (!$chat) {
        echo "<p>Chat not found</p>";
        exit();
    } 
    $chat = $chat[0]; 
?>

    <h3>Спілкування</h3>
<?php  
    if ($_SESSION["user_type"] === "candidate") {  ?>
        <section class="recruiter-info">
            <img src="<?php echo $chatObject->getPhoto("recruiter", $chat["recruiter_id"]); ?>" alt="Recruiter photo" width="70" height="70">
            <span><?php echo $chatObject->getCompanyName($chat); ?></span><br>
            <span><?php echo $chatObject->getRecruiterInfo($chat); ?></span>
        </section>
        <hr><br>
        <?php
    } elseif ($_SESSION["user_type"] === "recruiter") {  ?>
        <section class="candidate-info">
            <img src="<?php echo $chatObject->getPhoto("candidate", $chat["candidate_id"]); ?>" alt="Candidate photo" width="70" height="70">
            <span><?php echo $chatObject->getCandidateName($chat["candidate_id"]); ?></span>
            <span><?php echo $chatObject->getCandidateStatus($chat["candidate_id"]); ?></span>
            <span><?php echo $chatObject->getCandidatePosition($chat["candidate_id"]); ?></span>
        </section>
    <?php
    } ?>
    <section class="vacancy-info">
        <span><?php echo $chat["title"]; ?></span><br>
        <span><?php echo $chatObject->getEmplType($chat); ?></span>
        <span><?php echo $chatObject->getCountry($chat); ?></span>
        <span><?php echo $chatObject->getExperience($chat); ?></span>
        <span><?php echo $chatObject->getEnglish($chat); ?></span>
        <?php
        if ($_SESSION["user_type"] === "candidate") {  ?>
            <a href="../includes/change_status.inc.php?type=stopsearch&userId=<?php echo $_SESSION["user_id"]; ?>&chatId=<?php echo $chat["id"]; ?>">Повідомити про найм</a>
            <a href="../includes/change_status.inc.php?type=vacancynot&chatId=<?php echo $chat["id"]; ?>">Відмова від вакансії</a>
            <?php
        } elseif ($_SESSION["user_type"] === "recruiter") {  ?>
            <a href="../includes/change_status.inc.php?type=candidatenot&chatId=<?php echo $chat["id"]; ?>">Кандидат не підійшов</a>
        <?php
        } ?>
    </section>

    <section class="messages-list">
        <?php 
        $messagesArray = $chatObject->getMessages($_GET["chat_id"]);
        foreach ($messagesArray as $message) { ?>
            <span><?php echo $chatObject->getUserName($_GET["chat_id"], $message["sender_id"]); ?></span>
            <span><?php echo $chatObject->getCreationData($message); ?></span><br>
            <span><?php echo $message["body"] ?></span>
            <hr>
        <?php
        } ?>
    </section>

    <?php  
    if (!$chat["not_aproach_cand"] && !$chat["not_aproach_vac"]) { ?>
        <section class="send-message">
            <form action="../includes/chat.inc.php?chat_id=<?php echo $chat["id"]; ?>&vacancy_id=<?php echo $chat["vacancy_id"]; ?>" method="post">
                <?php
                    $chatObject->messageInput();
                    $chatObject->checkChatErrors();
                ?>
                <button>Надіслати</button>
            </form>
            <a href="all_chats.php">Назад</a>
        </section>
    <?php    
    } elseif ($chat["not_aproach_cand"]) {
        echo '<p>Кандидат не підійшов рекрутеру</p>';
    } else {
        echo '<p>Кандидат відмовився від вакансії</p>';
    } ?>

<?php

} else {
    echo "Chat not found!";
}

include_once "../footer.php";

?>