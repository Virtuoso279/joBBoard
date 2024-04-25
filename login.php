<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/login.css">
    <title>joBBoard</title>
</head>
<body>
<header>
    <img src="http://localhost/joBBoard/uploads/images/logoWebsite.png" width="115" height="48" alt="logo">    
    <hr>
</header>

<?php 
    include "classes/views/Login.view.php"; 
?>
<section class="main">
    <section class="login">
        <h3>Вхід в акаунт</h3>
        <form action="includes/login.inc.php" method="post" class="login-form">
            <?php
                $loginObject = new LoginView();
                $loginObject->loginInput();
                $loginObject->checkLoginErrors();
            ?>
            <!-- <input type="text" name="email" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password"> -->
            <button>Увійти</button>
        </form>
    </section>

    <section class="second">
        <p>Новий користувач?</p>    
        <a href="signup.php" class="registration">Реєстрація</a>
        <p>Повернутися назад?</p>    
        <a href="index.php">Вийти</a>
    </section>
</section>

<?php
    include_once "footer.php";
?>