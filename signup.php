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
    include "classes/views/SignUp.view.php";
?>

<section>
    <h3>Реєстрація</h3>
    <form action="includes/signup.inc.php" method="post">
        <?php
            $signupObject = new SignUpView();
            $signupObject->signupInput();
            $signupObject->checkSignupErrors();
        ?>
        <!-- <input type="text" name="email" placeholder="Email">
        <input type="password" name="pwd" placeholder="Password">
        <input type="radio" id="recruiter" name="userType" value="recruiter">
        <label for="recruiter">Я роботодавець</label>
        <input type="radio" id="candidate" name="userType" value="candidate">
        <label for="candidate">Я кандидат</label> -->
        <button>Далі</button>
    </form>
</section>

<section>
    <p>Вже є акаунт?</p>
    <a href="login.php">Авторизація</a>
</section>

<section>
    <p>Бажаєте скасувати реєстрацію?</p>    
    <a href="index.php">На головну</a>
</section>

<?php
    include_once "footer.php";
?>