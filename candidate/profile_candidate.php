<?php
    session_start();

    require_once "header_candidate.php";
?>

<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/candidate/profile_candidate.css">
</head>

<section class="main">
    <h3>Мій профіль</h3>
    <form action="../includes/profile_candidate.inc.php" method="post" enctype="multipart/form-data">
        <div class="user-status-block">
            <div>
                <input type="radio" id="active" name="status" value="active" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "active") echo "checked";?>>
                <label for="active">Активний пошук</label>
            </div>
            <div>
                <input type="radio" id="passive" name="status" value="passive" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "passive") echo "checked";?>>
                <label for="passive">Пасивний пошук</label>
            </div>
            <div>
                <input type="radio" id="stopSearch" name="status" value="stopsearch" <?php if ($profileData->getStatus($_SESSION["user_id"]) == "stopsearch") echo "checked";?>>
                <label for="stopSearch">Не шукаю роботу</label>
            </div>
        </div>
        <div class="columns">
            <div class="left-column">
                <div class="column-item">
                    <label for="full_name">Моє призвіще та ім’я:</label><br>
                    <input type="text" id="full_name" name="full_name" placeholder="Full name" class="input-text" value="<?php $profileData->getFullName($_SESSION["user_id"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="position">Назва посади:</label><br>
                    <input type="text" id="position" name="position" placeholder="Position" class="input-text" value="<?php $profileData->getPosition($_SESSION["user_id"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="category">Категорія (сфера):</label><br>      
                    <select name="category" id="category" size="1">
                        <?php $profileData->getCategories($_SESSION["user_id"]); ?>
                    </select><br>
                </div>
                <div class="column-item">
                <label for="skills">Мої навички:</label><br>        
                    <select name="skills[]" id="skills" multiple>
                        <?php $profileData->getSkills($_SESSION["user_id"]); ?>
                    </select><br>
                </div>
                <div class="column-item">
                    <label for="resume">Завантажте файл резюме:</label><br>
                    <input type="file" id="resume" name="resume" class="resume-input"><br>
                </div>
                <div class="column-item">
                    <?php $profileData->checkProfileCandidateErrors(); ?>
                </div>
                <button>Зберегти дані</button>
            </div>
            <div class="right-column">
                <div class="column-item">   
                    <img src="<?php echo $profileData->getPhoto($_SESSION["user_id"]);?>" alt="User photo" width="160" height="160"><br>
                    <input type="file" id="photo" name="photo" class="resume-input"><br>
                </div>
                <div class="column-item">
                    <label for="salary">Зарплатні очікування в $:</label><br>
                    <input type="number" id="salary" name="salary" placeholder="Salary" class="input-text" value="<?php $profileData->getSalary($_SESSION["user_id"]);?>"><br>
                </div>
                <div class="column-item">
                    <label for="country">Країна перебування:</label><br>        
                    <select name="country" id="country" size="1">
                        <?php $profileData->getCountries($_SESSION["user_id"]); ?>
                    </select><br>
                </div>
                <div class="column-item">
                    <p>Рівень англійської:</p>
                        <?php $profileData->getEnglish($_SESSION["user_id"]); ?>
                </div>
                <div class="column-item">
                    <p>Досвід роботи:</p>
                        <?php $profileData->getExperience($_SESSION["user_id"]); ?>
                </div>
            </div>
        </div>
        
    </form>
</section>

<?php
    include_once "../footer.php";
?>
