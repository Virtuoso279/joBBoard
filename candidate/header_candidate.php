<?php
    session_start();

    include "../classes/Dbh.php";
    include "../classes/models/ProfileCandidate.model.php";
    include "../classes/controllers/ProfileCandidate.contr.php";
    include "../classes/views/ProfileCandidate.view.php";

    $profileData = new ProfileViewCandidate();
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
        <a href="#">Вакансії</a>
        <a href="#">Спілкування</a>
        <a href="#">Мої контакти</a>
    </div>
    <span>
        <?php 
            if ($profileData->getStatus($_SESSION["user_id"]) == "active") {
                echo "Активний пошук";
            } elseif ($profileData->getStatus($_SESSION["user_id"]) == "passive") {
                echo "Пасивний пошук";
            } elseif ($profileData->getStatus($_SESSION["user_id"]) == "stopsearch") {
                echo "Не шукаю роботу";
            } else {
                echo "Некоректний статус";
            }
        ?>
    </span>
    <a href="profile_candidate.php"><?php echo $profileData->getFullName($_SESSION["user_id"]) ?></a>
    <a href="../includes/logout.inc.php">LOGOUT</a>    
</header>