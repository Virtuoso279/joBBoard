<?php
    session_start();
    
    require_once "header_recruiter.php";

    include "../classes/models/AllVacancies.model.php";
    include "../classes/controllers/AllVacancies.contr.php";
    include "../classes/views/AllVacancies.view.php";
?>

<h3>Вакансії</h3>
<section>
    <div class="vacancy_nav">
        <a href="../pages/add_vacancy.php">Додати вакансію</a>
        <a href="../pages/all_vacancies.php">Всі вакансії</a>
        <a href="my_vacancies.php">Мої вакансії</a>
    </div>
</section>
    
<section class="vacancy_list">
<?php
    $vacancies = new AllVacanciesView();
    if (isset($_SESSION["user_id"])) {
        $result = $vacancies->getRecruiterVacancies($_SESSION["user_id"]);
    } else {
        header("Location: ../index.php?error=invalid_userid");
        exit();
    }

    if ($result === "Empty list") {
        echo "You don't have any vacancies!";
    } else {
        $vacanciesArray = $result;
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
            <a href="../pages/add_vacancy.php?vacancy_id=<?php echo $vacancy["id"]; ?>">Редагувати</a>

            <?php
        }
    }
?>
    
</section>

<?php
    include_once "../footer.php";
?>