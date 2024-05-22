<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/signup.css">
    <title>joBBoard</title>
</head>
<body>
<header>
    <img src="http://localhost/joBBoard/uploads/images/logoWebsite.png" width="115" height="48" alt="logo">    
</header>

<?php
    include "classes/views/SignUp.view.php";
?>

<hr>

<section class="main">
    <section class="signup">
        <h3>Реєстрація</h3>
        <form action="includes/signup.inc.php" method="post" class="signup-form">
            <?php
                $signupObject = new SignUpView();
                $signupObject->signupInput();
                $signupObject->checkSignupErrors();
            ?>
            <button>Далі</button>
        </form>
    </section>

    <section class="second">
        <p>Вже є акаунт?</p>
        <a href="login.php">Авторизація</a>
        <p>Бажаєте скасувати реєстрацію?</p>    
        <a href="index.php">На головну</a>
    </section>
</section>

<?php
    include_once "footer.php";
?>