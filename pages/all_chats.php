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
        <input type="checkbox" id="refusal" name="type1" value="refusal" checked>
        <label for="refusal">Відмова</label>
        <input type="checkbox" id="inactive" name="type2" value="inactive">
        <label for="inactive">Неактивні вакансії</label>          
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

    if (isset($chatsArray)) {
        foreach ($chatsArray as $chat) { 
            if ($_SESSION["user_type"] === "candidate") {  ?>
                <section class="recruiter-info">
                    <img src="<?php echo $chats->getPhoto("recruiter", $chat["recruiter_id"]); ?>" alt="Recruiter photo" width="70" height="70">
                    <span><?php echo $chats->getCompanyName($chat); ?></span><br>
                    <span><?php echo $chats->getRecruiterInfo($chat); ?></span><br>
                    <span><?php echo $chats->getCreationData($chat); ?></span>
                </section><br>
            <?php
            } elseif ($_SESSION["user_type"] === "recruiter") {  ?>
                <section class="candidate-info">
                    <img src="<?php echo $chats->getPhoto("candidate", $chat["candidate_id"]); ?>" alt="Candidate photo" width="70" height="70">
                    <span><?php echo $chats->getCandidateName($chat["candidate_id"]); ?></span><br>
                    <span><?php echo $chats->getCandidatePosition($chat["candidate_id"]); ?></span><br>
                    <span><?php echo $chats->getCreationData($chat); ?></span>
                </section><br>
            <?php
            }
            ?>
            <section class="vacancy-info">
                <span><?php echo $chat["title"]; ?></span><br>
                <span><?php echo $chats->getEmplType($chat); ?></span>
                <span><?php echo $chats->getCountry($chat); ?></span>
                <span><?php echo $chats->getExperience($chat); ?></span>
                <span><?php echo $chats->getEnglish($chat); ?></span>
            </section>
            <hr>
            <section class="message">
                <p>Last message Last message Last message Last message Last message Last message</p>
                <a href="chat.php?chat_id=<?php echo $chat["id"]; ?>">Перейти в чат</a>
            </section>
            <?php
        }
        unset($_SESSION["chats"]);
    }

?>
</section>

<?php
    include_once "../footer.php";
?>