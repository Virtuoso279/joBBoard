<!DOCTYPE html>
<html>
<head>
    <title>joBBoard</title>
</head>
<body>
<header>
    <img src="#" alt="logo">    
</header>

<section>
    <h3>Вхід в акаунт</h3>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <button>Увійти</button>
    </form>
</section>

<section>
    <p>Забули пароль?</p>
    <a href="#">Отримати код</a>
</section>

<section>
    <p>Новий користувач?</p>    
    <a href="signup.php">Реєстрація</a>
</section>

<?php
    include_once "footer.php";
?>