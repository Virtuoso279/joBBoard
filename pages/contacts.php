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

    include "../classes/models/Contacts.model.php";
    include "../classes/controllers/Contacts.contr.php";
    include "../classes/views/Contacts.view.php";

    $profileData = new ContactsView();

?>

<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/pages/contacts.css">
</head>

<section class="main">
    <h3>Мої контакти та посилання</h3>
    <form action="../includes/contacts.inc.php" method="post">
        <div class="columns">
            <div class="left-column">
                <div class="column-item">
                    <label for="full_name">Моє призвіще та ім’я:</label><br>
                    <input type="text" id="full_name" name="full_name" placeholder="Full name" class="input-text" value="<?php $profileData->getFullName($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="email">Електронна пошта:</label><br>
                    <input type="email" id="email" name="email" placeholder="Email" class="input-text" value="<?php $profileData->getEmail($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="phone">Номер телефону:</label><br>
                    <input type="tel" id="phone" name="phone" pattern="^\+380\d{9}$" class="input-text" value="<?php $profileData->getPhone($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="telegram">Telegram:</label><br>
                    <input type="url" id="telegram" name="telegram" placeholder="Telegram" class="input-text" value="<?php $profileData->getTelegram($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="linkedin">LinkedIn-профіль:</label><br>
                    <input type="url" id="linkedin" name="linkedin" placeholder="LinkedIn" class="input-text" value="<?php $profileData->getLinkedIn($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="projects">Посилання на проекти:</label><br>
                    <input type="url" id="projects" name="projects" placeholder="Projects link" class="input-text" value="<?php $profileData->getLinks($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>    
                </div>
                <div class="column-item">
                    <?php $profileData->checkContactsErrors(); ?>
                </div>
                <button>Зберегти дані</button>
            </div>
            <div class="right-column">
                <div class="column-item">
                    <label for="aboutme">Про мене:</label><br>
                    <textarea name="aboutme" id="aboutme" class="input-text" rows="10" cols="50"><?php $profileData->getAboutMe($_SESSION["user_id"], $_SESSION["user_type"]);?></textarea><br>
                </div>
            </div>
        </div>
    </form>
</section>



<?php
    include_once "../footer.php";
?>