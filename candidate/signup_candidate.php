<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/candidate/signup_candidate.css">
    <title>joBBoard</title>
</head>
<body>
<header>
    <img src="http://localhost/joBBoard/uploads/images/logoWebsite.png" width="115" height="48" alt="logo">    
    <hr>    
</header>

<?php
    include "../classes/Dbh.php";
    include "../classes/models/SignUpCandidate.model.php";
    include "../classes/views/SignUpCandidate.view.php";

    $signupCandObject = new SignUpViewCandidate();
?>

<section class="main">
    <h3>Реєстрація кандидата</h3>
    <form action="../includes/signup_candidate.inc.php" method="post" enctype="multipart/form-data">
        <?php 
            $signupCandObject->signupCandidateInput();
            $signupCandObject->checkSignupCandidateErrors();
        ?>
        <button>Зберегти дані</button>
        </div>
    </form>
</section>

<?php
    include_once "../footer.php";
?>