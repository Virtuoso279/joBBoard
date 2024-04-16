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
    include "../classes/Dbh.php";
    include "../classes/models/SignUpRecruiter.model.php";
    include "../classes/views/SignUpRecruiter.view.php";

    $signupRecrObject = new SignUpViewRecruiter();
?>

<section>
    <h3>Реєстрація роботодавця</h3>
    <form action="../includes/signup_recruiter.inc.php" method="post">
        <?php 
            $signupRecrObject->signupRecruiterInput();
            $signupRecrObject->checkSignupRecruiterErrors();
        ?>
        <!-- <label for="full_name">Введіть призвіще та ім’я:</label><br>
        <input type="text" id="full_name" name="full_name" placeholder="Full name"><br>
        <label for="position">Введіть назву своєї посади:</label><br>
        <input type="text" id="position" name="position" placeholder="Position"><br>
        <label for="company">Введіть назву своєї компанії, де працюєте:</label><br>
        <input type="text" id="company" name="company" placeholder="Company"><br>        
        <label for="country">Оберіть країну розташування компанії</label><br>        
        <select name="country" id="country" size="1">
            <option value="Germany">Germany</option>
            <option value="Ukraine">Ukraine</option>
            <option value="Romania">Romania</option>
            <option value="Czech Republic (Czechia)">Czech Republic (Czechia)</option>
            <option value="Hungary">Hungary</option>
            <option value="Austria">Austria</option>
            <option value="Moldova">Moldova</option>
        </select><br>
        <label for="description">Опис компанії:</label><br>
        <textarea name="description" id="description" rows="10" cols="50" placeholder="Description"></textarea><br> -->
        <!-- <input type="text" id="description" name="description" placeholder="Description"><br> -->
        <button>Зберегти дані</button>
    </form>
</section>

<section>
    <a href="../includes/delete_user.inc.php">Скасувати</a>
</section>

<?php
    include_once "../footer.php";
?>