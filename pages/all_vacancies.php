<?php
    session_start();
    
    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
        require_once "../candidate/header_candidate.php";
    } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter") {
        require_once "../recruiter/header_recruiter.php";
    } else {
        header("Location: ../index.php?error=invalid_usertype");
        exit();
    }

    include "../classes/models/AllVacancies.model.php";
    include "../classes/controllers/AllVacancies.contr.php";
    include "../classes/views/AllVacancies.view.php";
?>


<h3>Вакансії</h3>
<section>
    <div class="vacancy_nav">
        <a href="../pages/all_vacancies.php">Всі вакансії</a>
        <?php
            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
                echo '<a href="#">Рекомендовані вакансії</a>';
            } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter") {
                echo '<a href="#">Мої вакансії</a>';
            }
        ?>
    </div>
</section>
<section class="filter">
    <form action="../includes/all_vacancies.inc.php" method="post">
        <label for="category">Категорія (сфера):</label><br>      
        <select name="category" id="category" size="1">
            <option value="EmptyValue" selected>Не вибрано</option>
            <option value="JavaScript / Front-End">JavaScript / Front-End</option>
            <option value="Java">Java</option>
            <option value="C# / .NET">C# / .NET</option>
            <option value="Python">Python</option>
            <option value="PHP">PHP</option>
            <option value="Node.js">Node.js</option>
            <option value="QA Manual">QA Manual</option>
        </select>
        <p>Рівень англійської:</p>
            <input type="radio" id="EmptyValue" name="english" value="EmptyValue" checked>
            <label for="EmptyValue">Не вибрано</label><br>
            <input type="radio" id="beginner" name="english" value="Beginner">
            <label for="beginner">Beginner</label><br>
            <input type="radio" id="intermediate" name="english" value="Intermediate">
            <label for="intermediate">Intermediate</label><br>
            <input type="radio" id="upper-Intermediate" name="english" value="Upper-Intermediate">
            <label for="upper-Intermediate">Upper-Intermediate</label><br>
            <input type="radio" id="advanced" name="english" value="Advanced">
            <label for="advanced">Advanced</label>
        <p>Досвід роботи:</p>
            <input type="radio" id="EmptyValue" name="experience" value="EmptyValue" checked>
            <label for="EmptyValue">Не вибрано</label><br>
            <input type="radio" id="1" name="experience" value="1">
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
        <label for="country">Країна перебування:</label><br>        
        <select name="country" id="country" size="1">
            <option value="EmptyValue" selected>Не вибрано</option>
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
            <option value="EmptyValue" selected>Не вибрано</option>
            <option value="Тільки віддалено">Тільки віддалено</option>
            <option value="Офіс">Офіс</option>
            <option value="Офіс/віддалено">Офіс/віддалено</option>
        </select><br>
        <label for="salary">Заробітна плата $:</label><br>        
        <select name="salary" id="salary" size="1">
            <option value="EmptyValue" selected>Не вибрано</option>
            <option value="500">Від 0 до 500</option>
            <option value="1000">Від 500 до 1000</option>
            <option value="1500">Від 1000 до 1500</option>
            <option value="2000">Від 1500 до 2000</option>
            <option value="3000">Від 2000 до 3000</option>
            <option value="4000">Від 3000 до 4000</option>
            <option value="4001">Від 4000 і більше</option>
        </select><br>            
        <button>Зберегти дані</button>
    </form>
</section>
    
<section class="vacancy_list">
<?php
    $vacancies = new AllVacanciesView();
    if (isset($_SESSION["vacancies"]) && $_SESSION["vacancies"] !== "Not found vacancies") {
        $vacanciesArray = $_SESSION["vacancies"];
    } elseif (isset($_SESSION["vacancies"]) && $_SESSION["vacancies"] === "Not found vacancies") {
        echo "Not found vacancies";
    } else {
        $vacanciesArray = $vacancies->getAllVacancies();
    }

    if (isset($vacanciesArray)) {
        foreach ($vacanciesArray as $vacancy) { ?>

            <section class="card-header">
                <img src="<?php echo $vacancies->getLogo($vacancy); ?>" alt="Company logo" width="70" height="70">
                <span><?php echo $vacancies->getCompanyName($vacancy); ?></span>
                <span><?php echo $vacancies->getCreationData($vacancy); ?></span>
                <span><?php echo $vacancy["responses"]; ?></span>
            </section><br>
            <section class="card-title">
                <span><?php echo $vacancy["title"]; ?></span>
                <span><?php echo $vacancies->getEmplType($vacancy); ?></span>
                <span><?php echo $vacancies->getCountry($vacancy); ?></span>
                <span><?php echo $vacancies->getExperience($vacancy); ?></span>
                <span><?php echo $vacancies->getEnglish($vacancy); ?></span>
            </section>
            <hr>
            <p><?php echo $vacancies->getDescription($vacancy); ?></p>
            <a href="vacancy.php?vacancy_id=<?php echo $vacancy["id"]; ?>">Детальна інформація</a>

            <?php
            unset($_SESSION["vacancies"]);
        }
    }
?>
</section>

<?php
    include_once "../footer.php";
?>