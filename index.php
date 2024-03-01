<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>joBBoard</title>
</head>
<body>
<header>
    <img src="#" alt="logo">
    <ul>
        <li><a href="signup.php">SIGN UP</a></li>
        <li><a href="login.php">LOGIN</a></li>
    </ul>
</header>

<section>
    <h3>Почни свій шлях разом з joBBoard</h3>
    <p>
        Ринок праці постійно еволюціонує, і все більше людейшукають роботу онлайн. 
        Платформи з пошуку роботи стали важливими інструментамидля зв'язку роботодавців 
        з кваліфікованими кандидатами.
    </p>
    <a href="login.php">Розпочати пошук</a>
</section>

<section>
    <h3>Компанії в пошуку кандидатів</h3>
    <ul>
        <li><img src="#" alt="companyLogo"></li>
        <li><img src="#" alt="companyLogo"></li>
        <li><img src="#" alt="companyLogo"></li>
        <li><img src="#" alt="companyLogo"></li>
        <li><img src="#" alt="companyLogo"></li>
        <li><img src="#" alt="companyLogo"></li>
    </ul>
</section>

<section>
    <h3>Ти роботодавець? Тоді тобі до нас!</h3>
    <p>
        Починай пошук бажаних кандидатів зручно та ефективно. 
        Платформа дає змогу рекрутерам публікувати вакансії та спілкуватися з майбутніми працівниками компанії.
    </p>
    <a href="login.php">Знайти кандидата</a>
</section>

<?php
    include_once "footer.php";
?>