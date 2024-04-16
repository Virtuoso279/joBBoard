<?php
    session_start();

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
            <?php $profileData->getCategories($_SESSION["user_id"]) ?>
        </select><br>
        <label for="skills">Мої навички:</label><br>        
        <select name="skills[]" id="skills" multiple>
            <?php $profileData->getSkills($_SESSION["user_id"]) ?>
        </select><br>
        <label for="resume">Завантажте файл резюме:</label><br>
        <input type="file" id="resume" name="resume"><br>
        <img src="<?php echo $profileData->getPhoto($_SESSION["user_id"]);?>" alt="User photo" width="160" height="160"><br>
        <input type="file" id="photo" name="photo"><br>
        <label for="salary">Зарплатні очікування в $:</label><br>
        <input type="number" id="salary" name="salary" placeholder="Salary" value="<?php $profileData->getSalary($_SESSION["user_id"]);?>"><br>
        <label for="country">Країна перебування:</label><br>        
        <select name="country" id="country" size="1">
            <?php $profileData->getCountries($_SESSION["user_id"]) ?>
        </select><br>
        <p>Рівень англійської:</p>
            <?php $profileData->getEnglish($_SESSION["user_id"]) ?>
        <p>Досвід роботи:</p>
            <?php $profileData->getExperience($_SESSION["user_id"]) ?>
        <button>Зберегти дані</button>
    </form>
</section>

<?php
    include_once "../footer.php";
?>
