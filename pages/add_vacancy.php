<?php
session_start();

require_once "../recruiter/header_recruiter.php";

if (isset($_GET["vacancy_id"])) {

    include "../classes/models/AddVacancy.model.php";
    include "../classes/controllers/AddVacancy.contr.php";
    include "../classes/views/AddVacancy.view.php";

    $vacancyObject = new AddVacancyView();

    $vacancy = $vacancyObject->getVacancy($_GET["vacancy_id"]); 
    $vacancy = $vacancy[0]; 
?>
    <section>
        <h3>Редагування вакансії</h3>
        <form action="../includes/add_vacancy.inc.php?vacancy_id=<?php echo $_GET["vacancy_id"]; ?>" method="post">
            <label for="title">Назва вакансії:</label><br>
            <input type="text" id="title" name="title" placeholder="Title" value="<?php echo $vacancy["title"];?>"><br>
            <label for="description">Опис вакансії:</label><br>
            <textarea name="description" id="description" rows="20" cols="100" placeholder="Description"><?php echo $vacancy["vacancy_descr"];?></textarea><br>
            <label for="category">Категорія (сфера):</label><br>      
            <select name="category" id="category" size="1">
                <?php $vacancyObject->getCategoryList($vacancy); ?>
            </select><br>
            <label for="country">Країна розташування офісу:</label><br>        
            <select name="country" id="country" size="1">
                <?php $vacancyObject->getCountryList($vacancy); ?>
            </select><br>
            <label for="empl_type">Тип зайнятості:</label><br>        
            <select name="empl_type" id="empl_type" size="1">
                <?php $vacancyObject->getEmplTypeList($vacancy); ?>
            </select><br>
            <label for="salary">Зарплатні очікування в $:</label><br>
            <input type="number" id="salary" name="salary" placeholder="Salary" value="<?php echo $vacancy["salary"];?>"><br>
            <label for="skills">Оберіть навички:</label><br>        
            <select name="skills[]" id="skills" multiple>
                <?php $vacancyObject->getSkillsList($vacancy); ?>
            </select><br>
            <p>Рівень англійської:</p>
                <?php $vacancyObject->getEnglishList($vacancy); ?>
            <p>Досвід роботи:</p>
            <?php $vacancyObject->getExperienceList($vacancy); 
            $vacancyObject->checkAddVacancyErrors();?>      
            <button>Зберегти дані</button>
        </form>
    </section>
    <a href="../includes/delete_vacancy.inc.php?vacancy_id=<?php echo $_GET["vacancy_id"]; ?>">Деактивувати вакансію</a>
    <a href="../recruiter/my_vacancies.php">Скасувати</a>
<?php
} else { ?>
    <section>
        <h3>Створення вакансії</h3>
        <form action="../includes/add_vacancy.inc.php" method="post">
            <label for="title">Назва вакансії:</label><br>
            <input type="text" id="title" name="title" placeholder="Title"><br>
            <label for="description">Опис вакансії:</label><br>
            <textarea name="description" id="description" rows="20" cols="100" placeholder="Description"></textarea><br>
            <label for="category">Категорія (сфера):</label><br>      
            <select name="category" id="category" size="1">
                <?php $vacancyObject->getCategoryList("emptyVacancy"); ?>
            </select><br>
            <label for="country">Країна розташування офісу:</label><br>        
            <select name="country" id="country" size="1">
                <?php $vacancyObject->getCountryList("emptyVacancy"); ?>
            </select><br>
            <label for="empl_type">Тип зайнятості:</label><br>        
            <select name="empl_type" id="empl_type" size="1">
                <?php $vacancyObject->getEmplTypeList("emptyVacancy"); ?>
            </select><br>
            <label for="salary">Зарплатні очікування в $:</label><br>
            <input type="number" id="salary" name="salary" placeholder="Salary"><br>
            <label for="skills">Оберіть навички:</label><br>        
            <select name="skills[]" id="skills" multiple>
                <?php $vacancyObject->getSkillsList("emptyVacancy"); ?>
            </select><br>
            <p>Рівень англійської:</p>
                <?php $vacancyObject->getEnglishList("emptyVacancy"); ?>
            <p>Досвід роботи:</p>
            <?php $vacancyObject->getExperienceList("emptyVacancy"); 
            $vacancyObject->checkAddVacancyErrors(); ?>        
            <button>Зберегти дані</button>
        </form>
    </section>
    <a href="../recruiter/my_vacancies.php">Скасувати</a>
<?php
} 