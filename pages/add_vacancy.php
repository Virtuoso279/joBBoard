<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/pages/add_vacancy.css">
</head>

<?php
session_start();

require_once "../recruiter/header_recruiter.php";

include "../classes/models/AddVacancy.model.php";
include "../classes/controllers/AddVacancy.contr.php";
include "../classes/views/AddVacancy.view.php";

$vacancyObject = new AddVacancyView();

if (isset($_GET["vacancy_id"])) {

    $vacancy = $vacancyObject->getVacancy($_GET["vacancy_id"]); 
    $vacancy = $vacancy[0]; 
?>
    <section class="main">
        <h3>Редагування вакансії</h3>
        <form action="../includes/add_vacancy.inc.php?vacancy_id=<?php echo $_GET["vacancy_id"]; ?>" method="post">
            <div class="descr-block">
                <label for="title">Назва вакансії:</label><br>
                <input type="text" id="title" name="title" class="input-text" placeholder="Title" value="<?php echo $vacancy["title"];?>"><br>
                <label for="description">Опис вакансії:</label><br>
                <textarea name="description" id="description" class="input-text" rows="20" cols="100" placeholder="Description"><?php echo $vacancy["vacancy_descr"];?></textarea><br>
            </div>
            <div class="input-block">
                <div class="left-column">
                    <div class="column-item">
                        <label for="category">Категорія (сфера):</label><br>      
                        <select name="category" id="category" size="1">
                            <?php $vacancyObject->getCategoryList($vacancy); ?>
                        </select><br>
                    </div>
                    <div class="column-item">
                        <label for="country">Країна розташування офісу:</label><br>        
                        <select name="country" id="country" size="1">
                            <?php $vacancyObject->getCountryList($vacancy); ?>
                        </select><br>
                    </div>
                    <div class="column-item">
                        <label for="empl_type">Тип зайнятості:</label><br>        
                        <select name="empl_type" id="empl_type" size="1">
                            <?php $vacancyObject->getEmplTypeList($vacancy); ?>
                        </select><br>
                    </div>
                    <div class="column-item">
                        <label for="salary">Зарплатні очікування в $:</label><br>
                        <input type="number" id="salary" name="salary" class="input-salary" placeholder="Salary" value="<?php echo $vacancy["salary"];?>">
                    </div>
                    <div class="column-item">
                        <label for="skills">Оберіть навички:</label><br>        
                        <select name="skills[]" id="skills" multiple>
                            <?php $vacancyObject->getSkillsList($vacancy); ?>
                        </select>
                    </div>
                </div>
                <div class="right-column">
                    <div class="column-item">
                        <p>Рівень англійської:</p>
                        <div class="radio-input">
                            <?php $vacancyObject->getEnglishList($vacancy); ?>
                        </div>
                    </div>
                    <div class="column-item">
                        <p>Досвід роботи:</p>
                        <div class="radio-input">
                            <?php $vacancyObject->getExperienceList($vacancy); ?>
                        </div>
                    </div>
                    <?php $vacancyObject->checkAddVacancyErrors();?>
                </div>
            </div>
            <input type="submit" class="input-submit" value="Зберегти дані">
        </form>
    </section>
    <a class="link-button" href="../includes/delete_vacancy.inc.php?vacancy_id=<?php echo $_GET["vacancy_id"]; ?>">Деактивувати вакансію</a>
    <a class="link-button" href="../recruiter/my_vacancies.php">Скасувати</a>
<?php
} else { ?>
    <section class="main">
        <h3>Створення вакансії</h3>
        <form action="../includes/add_vacancy.inc.php" method="post">
            <div class="descr-block">
                <label for="title">Назва вакансії:</label><br>
                <?php 
                    if (isset($_SESSION["vacancy_data"]["title"])) {
                        echo '<input type="text" id="title" name="title" class="input-text" placeholder="Title" value="' . $_SESSION["vacancy_data"]["title"] . '"><br>';
                    } else {
                        echo '<input type="text" id="title" name="title" class="input-text" placeholder="Title"><br>';
                    }
                ?>
                <label for="description">Опис вакансії:</label><br>
                <?php 
                    if (isset($_SESSION["vacancy_data"]["description"])) {
                        echo '<textarea name="description" id="description" class="input-text" rows="20" cols="100" placeholder="Description">'. $_SESSION["vacancy_data"]["description"] . '</textarea><br>';
                    } else {
                        echo '<textarea name="description" id="description" class="input-text" rows="20" cols="100" placeholder="Description"></textarea><br>';
                    }
                ?>
            </div>
            <div class="input-block">
                <div class="left-column">
                    <div class="column-item">
                        <label for="category">Категорія (сфера):</label><br>  
                        <select name="category" id="category" size="1">
                            <?php $vacancyObject->getCategoryList("emptyVacancy"); ?>
                        </select><br>
                    </div>
                    <div class="column-item">
                        <label for="country">Країна розташування офісу:</label><br>        
                        <select name="country" id="country" size="1">
                            <?php $vacancyObject->getCountryList("emptyVacancy"); ?>
                        </select><br>
                    </div>
                    <div class="column-item">    
                        <label for="empl_type">Тип зайнятості:</label><br>        
                        <select name="empl_type" id="empl_type" size="1">
                            <?php $vacancyObject->getEmplTypeList("emptyVacancy"); ?>
                        </select><br>
                    </div>
                    <div class="column-item">    
                        <label for="salary">Зарплатні очікування в $:</label><br>
                        <?php 
                            if (isset($_SESSION["vacancy_data"]["salary"]) && !isset($_SESSION["errors_addvacancy"]["salaryNotPositive"])) {
                                echo '<input type="number" id="salary" name="salary" class="input-salary" placeholder="Salary" value="' . $_SESSION["vacancy_data"]["salary"] . '">';
                            } else {
                                echo '<input type="number" id="salary" name="salary" class="input-salary" placeholder="Salary">';
                            }
                        ?>
                    </div>
                    <div class="column-item"> 
                        <label for="skills">Оберіть навички:</label><br>        
                        <select name="skills[]" id="skills" multiple>
                            <?php $vacancyObject->getSkillsList("emptyVacancy"); ?>
                        </select>
                    </div>
                </div>
                <div class="right-column">
                    <div class="column-item"> 
                        <p>Рівень англійської:</p>
                        <div class="radio-input">
                            <?php $vacancyObject->getEnglishList("emptyVacancy"); ?>
                        </div>
                    </div>
                    <div class="column-item"> 
                        <p>Досвід роботи:</p>
                        <div class="radio-input">
                            <?php $vacancyObject->getExperienceList("emptyVacancy"); ?> 
                        </div> 
                    </div>
                    <?php $vacancyObject->checkAddVacancyErrors();?>
                </div>
            </div>      
            <input type="submit" class="input-submit" value="Зберегти дані">
        </form>
    </section>
    <a class="link-button" href="../recruiter/my_vacancies.php">Скасувати</a>
<?php
} 