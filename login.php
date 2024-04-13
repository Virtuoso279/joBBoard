<!DOCTYPE html>
<html>
<head>
    <title>joBBoard</title>
</head>
<body>
<header>
    <img src="#" alt="logo">    
</header>

<?php 
    include "classes/views/Login.view.php"; 
?>

<section>
    <h3>Вхід в акаунт</h3>
    <form action="includes/login.inc.php" method="post">
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

<section>
    <p>Новий користувач?</p>    
    <a href="signup.php">Реєстрація</a>
</section>

<?php
    include_once "footer.php";
?>