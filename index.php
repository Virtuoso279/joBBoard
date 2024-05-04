<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/index.css">
    <title>joBBoard</title>
</head>
<body>
<header>
    <img src="http://localhost/joBBoard/uploads/images/logoWebsite.png" width="115" height="48" alt="logo" class="logo-photo">
    <a href="signup.php" class="signup-button">Реєстрація</a>
    <a href="login.php"><img src="http://localhost/joBBoard/uploads/images/signin.png" width="40" height="40" alt="signin"></a>
</header>

<section class="main">
    <hr>

    <section class="text-container">
        <h3>Почни свій шлях разом з joBBoard</h3>
        <div class="body-container">
            <p>
                Ринок праці постійно еволюціонує, і все більше людейшукають роботу онлайн. 
                Платформи з пошуку роботи стали важливими інструментамидля зв'язку роботодавців 
                з кваліфікованими кандидатами.
            </p>
            <a href="login.php" class="login-button">Розпочати пошук</a>
        </div>
    </section>

    <hr>

    <section>
        <h3>Компанії в пошуку кандидатів</h3>
        <div class="companies-list">
            <img src="http://localhost/joBBoard/uploads/images/amazon_logo.svg" width="70" height="70" alt="logo">
            <img src="http://localhost/joBBoard/uploads/images/tesla_logo.png" width="70" height="70" alt="logo">
            <img src="http://localhost/joBBoard/uploads/images/apple_logo.png" width="70" height="70" alt="logo">
            <img src="http://localhost/joBBoard/uploads/images/meta_logo.png" width="70" height="70" alt="logo">
            <img src="http://localhost/joBBoard/uploads/images/walmart_logo.jpg" width="70" height="70" alt="logo">
            <img src="http://localhost/joBBoard/uploads/images/nvidia_logo.png" width="70" height="70" alt="logo">
        </div>
    </section>

    <hr>

    <section class="text-container">
        <h3>Ти роботодавець? Тоді тобі до нас!</h3>
        <div class="body-container">
            <p>
                Починай пошук бажаних кандидатів зручно та ефективно. 
                Платформа дає змогу рекрутерам публікувати вакансії та спілкуватися з майбутніми працівниками компанії.
            </p>
            <a href="login.php" class="login-button">Знайти кандидата</a>
        </div>
    </section>

    <hr>

    <section>
        <h3>Відгуки</h3>
        <div class="response-list">
            <div class="response">
                <div class="response-header">
                    <img src="http://localhost/joBBoard/uploads/images/photoReviewer.png" width="90" height="85" alt="reviewer">
                    <span>Микола Олексійович Сидоренко</span>
                </div>
                <p>
                    Ця платформа стала для мене справжнім джерелом можливостей! Завдяки неї я знайшов ідеальну роботу, яку шукав уже давно. Дуже вдячний за такий корисний інструмент!
                </p>
            </div>
            <div class="response">
                <div class="response-header">
                    <img src="http://localhost/joBBoard/uploads/images/photoReviewer.png" width="90" height="85" alt="reviewer">
                    <span>Оксана Володимирівна Коваль</span>
                </div>
                <p>
                    Шукаючи роботу, я випадково натрапив на цю платформу. Вона змінила моє життя! Швидко, зручно і ефективно. Тепер я працюю на мріючому місці!
                </p>
            </div>
            <div class="response">
                <div class="response-header">
                    <img src="http://localhost/joBBoard/uploads/images/photoReviewer.png" width="90" height="85" alt="reviewer">
                    <span>Василь Петрович Іваненко</span>
                </div>
                <p>
                    Платформа пошуку роботи стала моїм найкращим другом у пошуку кар'єрного зростання. Завдяки їй я знайшов не просто роботу, але і власну стежину до успіху!
                </p>
            </div>
        </div>
    </section>
</section>

<?php
    include_once "footer.php";
?>