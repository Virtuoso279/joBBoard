<?php
    require_once "header_candidate.php";
?>

<section>
    <h3>Мій профіль</h3>
    <form action="../includes/profile_candidate.inc.php" method="post" enctype="multipart/form-data">
        <div>
            <input type="radio" id="active" name="status" value="active" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "active") echo "checked";?>>
            <label for="active">Активний пошук</label>
            <input type="radio" id="passive" name="status" value="passive" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "passive") echo "checked";?>>
            <label for="passive">Пасивний пошук</label>
            <input type="radio" id="stopSearch" name="status" value="stopsearch" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "stopsearch") echo "checked";?>>
            <label for="stopSearch">Не шукаю роботу</label>
        </div><br><br>
        <label for="full_name">Моє призвіще та ім’я:</label><br>
        <input type="text" id="full_name" name="full_name" placeholder="Full name" value="<?php $profileData->getFullName($_SESSION["user_id"]);?>"><br>
        <label for="position">Назва посади:</label><br>
        <input type="text" id="position" name="position" placeholder="Position" value="<?php $profileData->getPosition($_SESSION["user_id"]);?>"><br>
        <label for="category">Категорія (сфера):</label><br>      
        <select name="category" id="category" size="1">
            <option value="JavaScript / Front-End" <?php if ($profileData->getCategory($_SESSION["user_id"]) == "JavaScript / Front-End") echo 'selected';?>>JavaScript / Front-End</option>
            <option value="Java" <?php if ($profileData->getCategory($_SESSION["user_id"]) == "Java") echo 'selected';?>>Java</option>
            <option value="C# / .NET" <?php if ($profileData->getCategory($_SESSION["user_id"]) == "C# / .NET") echo 'selected';?>>C# / .NET</option>
            <option value="Python" <?php if ($profileData->getCategory($_SESSION["user_id"]) == "Python") echo 'selected';?>>Python</option>
            <option value="PHP" <?php if ($profileData->getCategory($_SESSION["user_id"]) == "PHP") echo 'selected';?>>PHP</option>
            <option value="Node.js" <?php if ($profileData->getCategory($_SESSION["user_id"]) == "Node.js") echo 'selected';?>>Node.js</option>
            <option value="QA Manual" <?php if ($profileData->getCategory($_SESSION["user_id"]) == "QA Manual") echo 'selected';?>>QA Manual</option>
        </select><br>
        <label for="skills">Мої навички:</label><br>        
        <select name="skills[]" id="skills" multiple>
            <option value="JavaScript" <?php if (in_array("JavaScript", $profileData->getSkills($_SESSION["user_id"]))) echo 'selected';?>>JavaScript</option>
            <option value="Java" <?php if (in_array("Java", $profileData->getSkills($_SESSION["user_id"]))) echo 'selected';?>>Java</option>
            <option value=".NET" <?php if (in_array(".NET", $profileData->getSkills($_SESSION["user_id"]))) echo 'selected';?>>.NET</option>
            <option value="Python" <?php if (in_array("Python", $profileData->getSkills($_SESSION["user_id"]))) echo 'selected';?>>Python</option>
            <option value="PHP" <?php if (in_array("PHP", $profileData->getSkills($_SESSION["user_id"]))) echo 'selected';?>>PHP</option>
            <option value="Node.js" <?php if (in_array("Node.js", $profileData->getSkills($_SESSION["user_id"]))) echo 'selected';?>>Node.js</option>
            <option value="GitHub" <?php if (in_array("GitHub", $profileData->getSkills($_SESSION["user_id"]))) echo 'selected';?>>GitHub</option>
            <option value="SQL" <?php if (in_array("SQL", $profileData->getSkills($_SESSION["user_id"]))) echo 'selected';?>>SQL</option>
            <option value="MVC" <?php if (in_array("MVC", $profileData->getSkills($_SESSION["user_id"]))) echo 'selected';?>>MVC</option>
        </select><br>
        <label for="resume">Завантажте файл резюме:</label><br>
        <input type="file" id="resume" name="resume"><br>
        <img src="<?php echo $profileData->getPhoto($_SESSION["user_id"]);?>" alt="User photo" width="160" height="160"><br>
        <input type="file" id="photo" name="photo"><br>
        <label for="salary">Зарплатні очікування в $:</label><br>
        <input type="number" id="salary" name="salary" placeholder="Salary" value="<?php $profileData->getSalary($_SESSION["user_id"]);?>"><br>
        <label for="country">Країна перебування:</label><br>        
        <select name="country" id="country" size="1">
            <option value="Germany" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Germany") echo 'selected';?>>Germany</option>
            <option value="Ukraine" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Ukraine") echo 'selected';?>>Ukraine</option>
            <option value="Romania" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Romania") echo 'selected';?>>Romania</option>
            <option value="Czech Republic (Czechia)" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Czech Republic (Czechia)") echo 'selected';?>>Czech Republic (Czechia)</option>
            <option value="Hungary" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Hungary") echo 'selected';?>>Hungary</option>
            <option value="Austria" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Austria") echo 'selected';?>>Austria</option>
            <option value="Moldova" <?php if ($profileData->getCountry($_SESSION["user_id"]) == "Moldova") echo 'selected';?>>Moldova</option>
        </select><br>
        <p>Рівень англійської:</p>
            <input type="radio" id="beginner" name="english" value="Beginner" <?php if ($profileData->getEnglish($_SESSION["user_id"]) == "Beginner") echo 'checked';?>>
            <label for="beginner">Beginner</label><br>
            <input type="radio" id="intermediate" name="english" value="Intermediate" <?php if ($profileData->getEnglish($_SESSION["user_id"]) == "Intermediate") echo 'checked';?>>
            <label for="intermediate">Intermediate</label><br>
            <input type="radio" id="upper-Intermediate" name="english" value="Upper-Intermediate" <?php if ($profileData->getEnglish($_SESSION["user_id"]) == "Upper-Intermediate") echo 'checked';?>>
            <label for="upper-Intermediate">Upper-Intermediate</label><br>
            <input type="radio" id="advanced" name="english" value="Advanced" <?php if ($profileData->getEnglish($_SESSION["user_id"]) == "Advanced") echo 'checked';?>>
            <label for="advanced">Advanced</label><br>
        <p>Досвід роботи:</p>
            <input type="radio" id="0" name="experience" value="0" <?php if ($profileData->getExperience($_SESSION["user_id"]) == "0") echo 'checked';?>>
            <label for="0">Без досвіду</label><br>
            <input type="radio" id="6" name="experience" value="6" <?php if ($profileData->getExperience($_SESSION["user_id"]) == "6") echo 'checked';?>>
            <label for="6">Менше 6 місяців</label><br>
            <input type="radio" id="12" name="experience" value="12" <?php if ($profileData->getExperience($_SESSION["user_id"]) == "12") echo 'checked';?>>
            <label for="12">Від 6 до 12 місяців</label><br>
            <input type="radio" id="24" name="experience" value="24" <?php if ($profileData->getExperience($_SESSION["user_id"]) == "24") echo 'checked';?>>
            <label for="24">Від 1 року до 2 років</label><br>
            <input type="radio" id="48" name="experience" value="48" <?php if ($profileData->getExperience($_SESSION["user_id"]) == "48") echo 'checked';?>>
            <label for="48">Від 2 років до 4 років</label><br>
            <input type="radio" id="49" name="experience" value="49" <?php if ($profileData->getExperience($_SESSION["user_id"]) == "49") echo 'checked';?>>
            <label for="49">Від 4 років і більше</label><br>
        <button>Зберегти дані</button>
    </form>
</section>

<?php
    include_once "../footer.php";
?>
