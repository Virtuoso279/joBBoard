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

<section>
    <h3>Мої контакти та посилання</h3>
    <form action="../includes/contacts.inc.php" method="post">
        <label for="full_name">Моє призвіще та ім’я:</label><br>
        <input type="text" id="full_name" name="full_name" placeholder="Full name" value="<?php $profileData->getFullName($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
        <label for="email">Електронна пошта:</label><br>
        <input type="email" id="email" name="email" placeholder="Email" value="<?php $profileData->getEmail($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
        <label for="phone">Номер телефону:</label><br>
        <input type="tel" id="phone" name="phone" pattern="^\+380\d{9}$" value="<?php $profileData->getPhone($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
        <label for="telegram">Telegram:</label><br>
        <input type="url" id="telegram" name="telegram" placeholder="Telegram" value="<?php $profileData->getTelegram($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
        <label for="linkedin">LinkedIn-профіль:</label><br>
        <input type="url" id="linkedin" name="linkedin" placeholder="LinkedIn" value="<?php $profileData->getLinkedIn($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>
        <label for="projects">Посилання на проекти:</label><br>
        <input type="url" id="projects" name="projects" placeholder="Projects link" value="<?php $profileData->getLinks($_SESSION["user_id"], $_SESSION["user_type"]);?>"><br>    
        <label for="aboutme">Про мене:</label><br>
        <textarea name="aboutme" id="aboutme" rows="10" cols="50"><?php $profileData->getAboutMe($_SESSION["user_id"], $_SESSION["user_type"]);?></textarea><br>
            <?php $profileData->checkContactsErrors(); ?>
        <button>Зберегти дані</button>
    </form>
</section>



<?php
    include_once "../footer.php";
?>