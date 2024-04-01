<?php

    include "../classes/Dbh.php";
    include "../classes/models/ProfileRecruiter.model.php";
    include "../classes/controllers/ProfileRecruiter.contr.php";
    include "../classes/views/ProfileRecruiter.view.php";

    $profileData = new ProfileViewRecruiter();
?>

<!DOCTYPE html>
<html>
<head>
    <title>joBBoard</title>
</head>
<body>
<header>
    <img src="#" alt="logo">
    <div class="topnav">
        <a href="../pages/all_vacancies.php">Вакансії</a>
        <a href="../pages/all_chats.php">Спілкування</a>
        <a href="../pages/contacts.php">Мої контакти</a>
    </div>
    <span>
        <?php 
            if ($profileData->getStatus($_SESSION["user_id"]) == "active") {
                echo "Активний";
            } elseif ($profileData->getStatus($_SESSION["user_id"]) == "passive") {
                echo "Пасивний";
            } else {
                echo "Некоректний статус";
            }
        ?>
    </span>
    <a href="../recruiter/profile_recruiter.php"><?php echo $profileData->getFullName($_SESSION["user_id"]) ?></a>
    <a href="../includes/logout.inc.php">LOGOUT</a>    
</header>