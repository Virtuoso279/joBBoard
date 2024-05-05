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
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/candidate/header_candidate.css">
    <title>joBBoard</title>
</head>
<body>
<header>
<img src="http://localhost/joBBoard/uploads/images/logoWebsite.png" width="115" height="48" alt="logo" class="logo">
    <div class="topnav">
        <a href="../pages/all_vacancies.php">Вакансії</a>
        <a href="../pages/all_chats.php">Спілкування</a>
        <a href="../pages/contacts.php">Мої контакти</a>
    </div>
    <div class="profile-nav">
        <span class="user-status">
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
        <a href="../recruiter/profile_recruiter.php" class="profile"><?php echo $profileData->getFullName($_SESSION["user_id"]) ?></a>
        <a href="../includes/logout.inc.php"><img src="http://localhost/joBBoard/uploads/images/logout.png" width="27" height="27" alt="logout"></a> 
    </div>   
</header>
<hr>