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
    include "../classes/models/SignUpCandidate.model.php";
    include "../classes/views/SignUpCandidate.view.php";

    $signupCandObject = new SignUpViewCandidate();
?>

<section>
    <h3>Реєстрація кандидата</h3>
    <form action="../includes/signup_candidate.inc.php" method="post" enctype="multipart/form-data">
        <?php 
            $signupCandObject->signupCandidateInput();
            $signupCandObject->checkSignupCandidateErrors();
        ?>
        <!-- <label for="full_name">Введіть призвіще та ім’я:</label><br>
        <input type="text" id="full_name" name="full_name" placeholder="Full name"><br>
        <label for="position">Введіть назву посади:</label><br>
        <input type="text" id="position" name="position" placeholder="Position"><br>
        <label for="category">Оберіть категорію (сферу):</label><br>      
        <select name="category" id="category" size="1">
            <option value="JavaScript / Front-End">JavaScript / Front-End</option>
            <option value="Java">Java</option>
            <option value="C# / .NET">C# / .NET</option>
            <option value="Python">Python</option>
            <option value="PHP">PHP</option>
            <option value="Node.js">Node.js</option>
            <option value="QA Manual">QA Manual</option>
        </select><br>
        <label for="skills">Оберіть навички:</label><br>        
        <select name="skills[]" id="skills" multiple>
            <option value="JavaScript">JavaScript</option>
            <option value="Java">Java</option>
            <option value=".NET">.NET</option>
            <option value="Python">Python</option>
            <option value="PHP">PHP</option>
            <option value="Node.js">Node.js</option>
            <option value="GitHub">GitHub</option>
            <option value="SQL">SQL</option>
            <option value="MVC">MVC</option>
        </select><br>
        <label for="country">Оберіть країну перебування</label><br>        
        <select name="country" id="country" size="1">
            <option value="Germany">Germany</option>
            <option value="Ukraine">Ukraine</option>
            <option value="Romania">Romania</option>
            <option value="Czech Republic (Czechia)">Czech Republic (Czechia)</option>
            <option value="Hungary">Hungary</option>
            <option value="Austria">Austria</option>
            <option value="Moldova">Moldova</option>
        </select><br>
        <label for="resume">Завантажте файл резюме:</label><br>
        <input type="file" id="resume" name="resume"><br>
        <label for="salary">Введіть зарплатні очікування в $:</label><br>
        <input type="number" id="salary" name="salary" placeholder="Salary"><br>
        <p>Рівень англійської:</p>
            <input type="radio" id="beginner" name="english" value="Beginner" checked>
            <label for="beginner">Beginner</label><br>
            <input type="radio" id="intermediate" name="english" value="Intermediate">
            <label for="intermediate">Intermediate</label><br>
            <input type="radio" id="upper-Intermediate" name="english" value="Upper-Intermediate">
            <label for="upper-Intermediate">Upper-Intermediate</label><br>
            <input type="radio" id="advanced" name="english" value="Advanced">
            <label for="advanced">Advanced</label><br>
        <p>Досвід роботи:</p>
            <input type="radio" id="1" name="experience" value="1" checked>
            <label for="1">Без досвіду</label><br>
            <input type="radio" id="6" name="experience" value="6">
            <label for="6">Менше 6 місяців</label><br>
            <input type="radio" id="12" name="experience" value="12">
            <label for="12">Від 6 до 12 місяців</label><br>
            <input type="radio" id="24" name="experience" value="24">
            <label for="24">Від 1 року до 2 років</label><br>
            <input type="radio" id="48" name="experience" value="48">
            <label for="48">Від 2 років до 4 років</label><br>
            <input type="radio" id="49" name="experience" value="49">
            <label for="49">Від 4 років і більше</label><br> -->
        <button>Зберегти дані</button>
    </form>
</section>

<section>
    <a href="../includes/delete_user.inc.php">Скасувати</a>
</section>

<?php
    include_once "../footer.php";
?>