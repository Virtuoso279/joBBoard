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

    include "../classes/models/AllChats.model.php";
    include "../classes/controllers/AllChats.contr.php";
    include "../classes/views/AllChats.view.php";

    $chats = new AllChatsView();
?>

<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/pages/all_chats.css">
</head>

<section class="main">
    <h3>Спілкування</h3>
    <section class="filter-chats">
        <form action="../includes/all_chats.inc.php" method="post">
            <?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter") { ?>
                <label for="vacancy">Обрати вакансію:</label><br>      
                <select name="vacancy" id="vacancy" size="1">
                    <option value="all_vacancies" selected>Всі вакансії</option>
                    <?php foreach ($chats->getRecruiterVacancies($_SESSION["user_id"]) as $vacancy) {
                        echo '<option value="' . $vacancy["title"] . '">' . $vacancy["title"] . '</option>';
                    } ?>
                </select>
            <?php } ?>
            <div class="filter-item">
                <input type="checkbox" id="refusal" name="type1" value="refusal" checked>
                <label for="refusal">Відмова</label>
            </div>
            <div class="filter-item">
                <input type="checkbox" id="inactive" name="type2" value="inactive">
                <label for="inactive">Неактивні вакансії</label>        
            </div>
            <button>Пошук</button>
        </form>
    </section>
        
    <section class="chat_list">
    <?php
        if (isset($_SESSION["chats"]) && $_SESSION["chats"] !== "Not found chats") {
            $chatsArray = $_SESSION["chats"];
        } elseif (isset($_SESSION["chats"]) && $_SESSION["chats"] === "Not found chats") {
            echo "Not found chats";
        } else {
            $chatsArray = $chats->getAllChats($_SESSION["user_type"], $_SESSION["user_id"]);
        }

        if (isset($chatsArray) && $chatsArray !== "empty list") {
            foreach ($chatsArray as $chat) { ?>
                <div class="chat-item">
                    <div class="chat-top">
                        <div class="chat-card-info">
                <?php if ($_SESSION["user_type"] === "candidate") {  ?>
                            <div class="recruiter-info">
                                <img src="<?php echo $chats->getPhoto("recruiter", $chat["recruiter_id"]); ?>" alt="Recruiter photo" width="70" height="70">
                                <div class="card-header">
                                    <span><?php echo $chats->getCompanyName($chat); ?></span>
                                    <strong><?php echo $chats->getRecruiterInfo($chat); ?></strong>
                                    <span class="date"><?php echo $chats->getCreationData($chat); ?></span>
                                </div>
                            </div>
                <?php
                } elseif ($_SESSION["user_type"] === "recruiter") {  ?>
                            <div class="candidate-info">
                                <img src="<?php echo $chats->getPhoto("candidate", $chat["candidate_id"]); ?>" alt="Candidate photo" width="70" height="70">
                                <div class="card-header">
                                    <strong><?php echo $chats->getCandidateName($chat["candidate_id"]); ?></strong>
                                    <span><?php echo $chats->getCandidatePosition($chat["candidate_id"]); ?></span>
                                    <span class="date"><?php echo $chats->getCreationData($chat); ?></span>
                                </div>
                            </div>
                <?php
                } ?>
                        </div>
                        <div class="vacancy-info">
                            <strong><?php echo $chat["title"]; ?></strong>
                            <div class="vacancy-features">
                                <span><?php echo $chats->getEmplType($chat); ?></span>
                                <span><?php echo $chats->getCountry($chat); ?></span>
                                <span><?php echo $chats->getExperience($chat); ?></span>
                                <span><?php echo $chats->getEnglish($chat); ?></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="message">
                        <?php $message = $chats->getMessage($chat["id"]); ?>
                        <div class="message-body">
                            <strong><?php echo $chats->getUserName($chat["id"], $message[0]["sender_id"]); ?> :</strong>
                            <span><?php echo $message[0]["body"]; ?></span><br>
                        </div>
                        <a href="chat.php?chat_id=<?php echo $chat["id"]; ?>">Перейти в чат</a>
                    </div>
                </div>
                <?php
            }
            unset($_SESSION["chats"]);
        } elseif (isset($chatsArray) && $chatsArray === "empty list") {
            echo "<p>You don't have any chats</p>";
        }   

    ?>
    </section>
</section>

<?php
    include_once "../footer.php";
?>