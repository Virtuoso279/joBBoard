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
                <option value="JavaScript / Front-End" <?php if ($vacancyObject->getCategory($vacancy) == "JavaScript / Front-End") echo 'selected';?>>JavaScript / Front-End</option>
                <option value="Java" <?php if ($vacancyObject->getCategory($vacancy) == "Java") echo 'selected';?>>Java</option>
                <option value="C# / .NET" <?php if ($vacancyObject->getCategory($vacancy) == "C# / .NET") echo 'selected';?>>C# / .NET</option>
                <option value="Python" <?php if ($vacancyObject->getCategory($vacancy) == "Python") echo 'selected';?>>Python</option>
                <option value="PHP" <?php if ($vacancyObject->getCategory($vacancy) == "PHP") echo 'selected';?>>PHP</option>
                <option value="Node.js" <?php if ($vacancyObject->getCategory($vacancy) == "Node.js") echo 'selected';?>>Node.js</option>
                <option value="QA Manual" <?php if ($vacancyObject->getCategory($vacancy) == "QA Manual") echo 'selected';?>>QA Manual</option>
            </select><br>
            <label for="country">Країна розташування офісу:</label><br>        
            <select name="country" id="country" size="1">
                <option value="Germany" <?php if ($vacancyObject->getCountry($vacancy) == "Germany") echo 'selected';?>>Germany</option>
                <option value="Ukraine" <?php if ($vacancyObject->getCountry($vacancy) == "Ukraine") echo 'selected';?>>Ukraine</option>
                <option value="Romania" <?php if ($vacancyObject->getCountry($vacancy) == "Romania") echo 'selected';?>>Romania</option>
                <option value="Czech Republic (Czechia)" <?php if ($vacancyObject->getCountry($vacancy) == "Czech Republic (Czechia)") echo 'selected';?>>Czech Republic (Czechia)</option>
                <option value="Hungary" <?php if ($vacancyObject->getCountry($vacancy) == "Hungary") echo 'selected';?>>Hungary</option>
                <option value="Austria" <?php if ($vacancyObject->getCountry($vacancy) == "Austria") echo 'selected';?>>Austria</option>
                <option value="Moldova" <?php if ($vacancyObject->getCountry($vacancy) == "Moldova") echo 'selected';?>>Moldova</option>
            </select><br>
            <label for="empl_type">Тип зайнятості:</label><br>        
            <select name="empl_type" id="empl_type" size="1">
                <option value="Тільки віддалено" <?php if ($vacancyObject->getEmplType($vacancy) == "Тільки віддалено") echo 'selected';?>>Тільки віддалено</option>
                <option value="Офіс" <?php if ($vacancyObject->getEmplType($vacancy) == "Офіс") echo 'selected';?>>Офіс</option>
                <option value="Офіс/віддалено" <?php if ($vacancyObject->getEmplType($vacancy) == "Офіс/віддалено") echo 'selected';?>>Офіс/віддалено</option>
            </select><br>
            <label for="salary">Зарплатні очікування в $:</label><br>
            <input type="number" id="salary" name="salary" placeholder="Salary" value="<?php echo $vacancy["salary"];?>"><br>
            <label for="skills">Оберіть навички:</label><br>        
            <select name="skills[]" id="skills" multiple>
                <option value="JavaScript" <?php if (in_array("JavaScript", $vacancyObject->getSkills($vacancy))) echo 'selected';?>>JavaScript</option>
                <option value="Java" <?php if (in_array("Java", $vacancyObject->getSkills($vacancy))) echo 'selected';?>>Java</option>
                <option value=".NET" <?php if (in_array(".NET", $vacancyObject->getSkills($vacancy))) echo 'selected';?>>.NET</option>
                <option value="Python" <?php if (in_array("Python", $vacancyObject->getSkills($vacancy))) echo 'selected';?>>Python</option>
                <option value="PHP" <?php if (in_array("PHP", $vacancyObject->getSkills($vacancy))) echo 'selected';?>>PHP</option>
                <option value="Node.js" <?php if (in_array("Node.js", $vacancyObject->getSkills($vacancy))) echo 'selected';?>>Node.js</option>
                <option value="GitHub" <?php if (in_array("GitHub", $vacancyObject->getSkills($vacancy))) echo 'selected';?>>GitHub</option>
                <option value="SQL" <?php if (in_array("SQL", $vacancyObject->getSkills($vacancy))) echo 'selected';?>>SQL</option>
                <option value="MVC" <?php if (in_array("MVC", $vacancyObject->getSkills($vacancy))) echo 'selected';?>>MVC</option>
            </select><br>
            <p>Рівень англійської:</p>
                <input type="radio" id="beginner" name="english" value="Beginner" <?php if ($vacancyObject->getEnglish($vacancy) == "Beginner") echo 'checked';?>>
                <label for="beginner">Beginner</label><br>
                <input type="radio" id="intermediate" name="english" value="Intermediate" <?php if ($vacancyObject->getEnglish($vacancy) == "Intermediate") echo 'checked';?>>
                <label for="intermediate">Intermediate</label><br>
                <input type="radio" id="upper-Intermediate" name="english" value="Upper-Intermediate" <?php if ($vacancyObject->getEnglish($vacancy) == "Upper-Intermediate") echo 'checked';?>>
                <label for="upper-Intermediate">Upper-Intermediate</label><br>
                <input type="radio" id="advanced" name="english" value="Advanced" <?php if ($vacancyObject->getEnglish($vacancy) == "Advanced") echo 'checked';?>>
                <label for="advanced">Advanced</label><br>
            <p>Досвід роботи:</p>
                <input type="radio" id="1" name="experience" value="1" <?php if ($vacancyObject->getExperience($vacancy) == "1") echo 'checked';?>>
                <label for="1">Без досвіду</label><br>
                <input type="radio" id="6" name="experience" value="6" <?php if ($vacancyObject->getExperience($vacancy) == "6") echo 'checked';?>>
                <label for="6">Менше 6 місяців</label><br>
                <input type="radio" id="12" name="experience" value="12" <?php if ($vacancyObject->getExperience($vacancy) == "12") echo 'checked';?>>
                <label for="12">Від 6 до 12 місяців</label><br>
                <input type="radio" id="24" name="experience" value="24" <?php if ($vacancyObject->getExperience($vacancy) == "24") echo 'checked';?>>
                <label for="24">Від 1 року до 2 років</label><br>
                <input type="radio" id="48" name="experience" value="48" <?php if ($vacancyObject->getExperience($vacancy) == "48") echo 'checked';?>>
                <label for="48">Від 2 років до 4 років</label><br>
                <input type="radio" id="49" name="experience" value="49" <?php if ($vacancyObject->getExperience($vacancy) == "49") echo 'checked';?>>
                <label for="49">Від 4 років і більше</label><br>      
            <button>Зберегти дані</button>
        </form>
    </section>
    <a href="../includes/delete_vacancy.inc.php?vacancy_id=<?php echo $_GET["vacancy_id"]; ?>">Видалити вакансію</a>
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
                <option value="JavaScript / Front-End">JavaScript / Front-End</option>
                <option value="Java">Java</option>
                <option value="C# / .NET">C# / .NET</option>
                <option value="Python">Python</option>
                <option value="PHP">PHP</option>
                <option value="Node.js">Node.js</option>
                <option value="QA Manual">QA Manual</option>
            </select><br>
            <label for="country">Країна розташування офісу:</label><br>        
            <select name="country" id="country" size="1">
                <option value="Germany">Germany</option>
                <option value="Ukraine">Ukraine</option>
                <option value="Romania">Romania</option>
                <option value="Czech Republic (Czechia)">Czech Republic (Czechia)</option>
                <option value="Hungary">Hungary</option>
                <option value="Austria">Austria</option>
                <option value="Moldova">Moldova</option>
            </select><br>
            <label for="empl_type">Тип зайнятості:</label><br>        
            <select name="empl_type" id="empl_type" size="1">
                <option value="Тільки віддалено">Тільки віддалено</option>
                <option value="Офіс">Офіс</option>
                <option value="Офіс/віддалено">Офіс/віддалено</option>
            </select><br>
            <label for="salary">Зарплатні очікування в $:</label><br>
            <input type="number" id="salary" name="salary" placeholder="Salary"><br>
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
            <p>Рівень англійської:</p>
                <input type="radio" id="beginner" name="english" value="Beginner" checked>
                <label for="beginner">Beginner</label><br>
                <input type="radio" id="intermediate" name="english" value="Intermediate">
                <label for="intermediate">Intermediate</label><br>
                <input type="radio" id="upper-Intermediate" name="english" value="Upper-Intermediate">
                <label for="upper-Intermediate">Upper-Intermediate</label><br>
                <input type="radio" id="advanced" name="english" value="Advanced">
                <label for="advanced">Advanced</label>
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
                <label for="49">Від 4 років і більше</label><br>        
            <button>Зберегти дані</button>
        </form>
    </section>
    <a href="../recruiter/my_vacancies.php">Скасувати</a>
<?php
} 