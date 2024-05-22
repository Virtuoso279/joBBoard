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

<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/pages/chat.css">
</head>

    <h3>Спілкування</h3>
    <section class="main">
        <div class="left-column">
<?php  
        if ($_SESSION["user_type"] === "candidate") {  ?>
            <div class="recruiter-info">
                <img src="<?php echo $chatObject->getPhoto("recruiter", $chat["recruiter_id"]); ?>" alt="Recruiter photo" width="70" height="70">
                <div class="interlocutor-info">
                    <span><?php echo $chatObject->getCompanyName($chat); ?></span>
                    <span><?php echo $chatObject->getRecruiterInfo($chat); ?></span>
                </div>
            </div>
            <hr>
            <?php
        } elseif ($_SESSION["user_type"] === "recruiter") {  ?>
            <div class="candidate-info">
                <img src="<?php echo $chatObject->getPhoto("candidate", $chat["candidate_id"]); ?>" alt="Candidate photo" width="70" height="70">
                <div class="interlocutor-info">
                    <span><?php echo $chatObject->getCandidateName($chat["candidate_id"]); ?></span>
                    <span><?php echo $chatObject->getCandidateStatus($chat["candidate_id"]); ?></span>
                    <span><?php echo $chatObject->getCandidatePosition($chat["candidate_id"]); ?></span>
                </div>
            </div>
            <hr>
        <?php
        } ?>
            <div class="vacancy">
                <strong><?php echo $chat["title"]; ?></strong>
                <div class="vacancy-info">
                    <span><?php echo $chatObject->getEmplType($chat); ?></span>
                    <span><?php echo $chatObject->getCountry($chat); ?></span>
                    <span><?php echo $chatObject->getExperience($chat); ?></span>
                    <span><?php echo $chatObject->getEnglish($chat); ?></span>
                </div>
                <?php
                if ($_SESSION["user_type"] === "candidate") {  ?>
                    <a href="../includes/change_status.inc.php?type=stopsearch&userId=<?php echo $_SESSION["user_id"]; ?>&chatId=<?php echo $chat["id"]; ?>">Повідомити про найм</a>
                    <a href="../includes/change_status.inc.php?type=vacancynot&chatId=<?php echo $chat["id"]; ?>">Відмова від вакансії</a>
                    <?php
                } elseif ($_SESSION["user_type"] === "recruiter") {  ?>
                    <a href="../includes/change_status.inc.php?type=candidatenot&chatId=<?php echo $chat["id"]; ?>">Кандидат не підійшов</a>
                <?php
                } ?>
            </div>
        </div>
        <div class="right-column">
            <div class="messages-list">
                <?php 
                $messagesArray = $chatObject->getMessages($_GET["chat_id"]);
                foreach ($messagesArray as $message) { ?>
                    <strong><?php echo $chatObject->getUserName($_GET["chat_id"], $message["sender_id"]); ?></strong>
                    <span class="date"><?php echo $chatObject->getCreationData($message); ?></span>
                    <br><hr>
                    <span><?php echo $message["body"] ?></span>
                    <br><br><br><br>
                <?php
                } ?>
            </div>

            <?php  
            if (!$chat["not_aproach_cand"] && !$chat["not_aproach_vac"]) { ?>
                <div class="send-message">
                    <form action="../includes/chat.inc.php?chat_id=<?php echo $chat["id"]; ?>&vacancy_id=<?php echo $chat["vacancy_id"]; ?>" method="post">
                        <?php
                            $chatObject->messageInput();
                            $chatObject->checkChatErrors();
                        ?>
                        <button>Надіслати</button>
                    </form>
                    <a href="all_chats.php">Назад</a>
                </div>
            <?php    
            } elseif ($chat["not_aproach_cand"]) {
                echo '<p>Кандидат не підійшов рекрутеру</p>';
            } else {
                echo '<p>Кандидат відмовився від вакансії</p>';
            } ?>
        </div>
    </section>

<?php

} else {
    echo "Chat not found!";
}

include_once "../footer.php";

?>