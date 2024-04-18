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

    $vacancies = new AllVacanciesView();
?>

<h3>Вакансії</h3>
<section>
    <div class="vacancy_nav">
        <a href="../pages/all_vacancies.php">Всі вакансії</a>
        <?php
            if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
                echo '<a href="#">Рекомендовані вакансії</a>';
            } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter") {
                echo '<a href="../recruiter/my_vacancies.php">Мої вакансії</a>';
            }
        ?>
    </div>
</section>
<section class="filter">
    <form action="../includes/all_vacancies.inc.php" method="post">
        <label for="category">Категорія (сфера):</label><br>      
        <select name="category" id="category" size="1">
            <option value="EmptyValue" selected>Не вибрано</option>
            <?php $vacancies->getCategoriesList(); ?>
        </select>
        <p>Рівень англійської:</p>
            <input type="radio" id="EmptyValue" name="english" value="EmptyValue" checked>
            <label for="EmptyValue">Не вибрано</label><br>
            <?php $vacancies->getEnglishList(); ?>
        <p>Досвід роботи:</p>
            <input type="radio" id="EmptyValue" name="experience" value="EmptyValue" checked>
            <label for="EmptyValue">Не вибрано</label><br>
            <?php $vacancies->getExperienceList(); ?>
        <label for="country">Країна перебування:</label><br>        
        <select name="country" id="country" size="1">
            <option value="EmptyValue" selected>Не вибрано</option>
            <?php $vacancies->getCountriesList(); ?>
        </select><br>
        <label for="empl_type">Тип зайнятості:</label><br>        
        <select name="empl_type" id="empl_type" size="1">
            <option value="EmptyValue" selected>Не вибрано</option>
            <?php $vacancies->getEmplTypesList(); ?>
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
        <button>Пошук</button>
    </form>
</section>
    
<section class="vacancy_list">
<?php
    if (isset($_SESSION["vacancies"]) && $_SESSION["vacancies"] !== "Not found vacancies") {
        $vacanciesArray = $_SESSION["vacancies"];
    } elseif (isset($_SESSION["vacancies"]) && $_SESSION["vacancies"] === "Not found vacancies") {
        echo "Not found vacancies";
    } else {
        $vacanciesArray = $vacancies->getAllVacancies();
    }

    if (isset($vacanciesArray)) {
        foreach ($vacanciesArray as $vacancy) { 
            $vacancies->setResponseAmount($vacancy["id"]);
            ?>
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
        }
        unset($_SESSION["vacancies"]);
    }
?>
</section>

<?php
    include_once "../footer.php";
?>