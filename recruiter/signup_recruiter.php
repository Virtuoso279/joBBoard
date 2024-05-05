<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/recruiter/signup_recruiter.css">
    <title>joBBoard</title>
</head>
<body>
<header>
    <img src="http://localhost/joBBoard/uploads/images/logoWebsite.png" width="115" height="48" alt="logo">    
    <hr>    
</header>

<?php
    include "../classes/Dbh.php";
    include "../classes/models/SignUpRecruiter.model.php";
    include "../classes/views/SignUpRecruiter.view.php";

    $signupRecrObject = new SignUpViewRecruiter();
?>

<section class="main">
    <h3>Реєстрація роботодавця</h3>
    <form action="../includes/signup_recruiter.inc.php" method="post">
        <?php 
            $signupRecrObject->signupRecruiterInput();
            $signupRecrObject->checkSignupRecruiterErrors();
        ?>
        <button>Зберегти дані</button>
        </div>
    </form>
</section>

<?php
    include_once "../footer.php";
?>