<?php
    session_start();
    
    require_once "header_candidate.php";

    include "../classes/models/AllVacancies.model.php";
    include "../classes/controllers/AllVacancies.contr.php";
    include "../classes/views/AllVacancies.view.php";
?>

<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/candidate/recommended_vacancies.css">
</head>

<section class="main">
    <div class="body-header">
        <h3>Рекомендовані вакансії</h3>
        <div class="vacancy_nav">
            <a href="../pages/all_vacancies.php">Всі вакансії</a>
            <a href="recommended_vacancies.php" class="recommended-vacancy-nav">Рекомендовані вакансії</a>
        </div>
    </div>

    <section class="vacancy_list">
    <?php
        $vacancies = new AllVacanciesView();
        if (isset($_SESSION["user_id"])) {
            $result = $vacancies->getRecommendedVacancies($_SESSION["user_id"]);
        } else {
            header("Location: ../index.php?error=invalid_userid");
            exit();
        }
    
        if ($result === "Empty list") {
            echo "<p>You don't have any recommended vacancies!</p>";
        } else {
            $vacanciesArray = $result;
            foreach ($vacanciesArray as $vacancy) { 
                $vacancies->setResponseAmount($vacancy["id"]);
                ?>
                <div class="vacancy-item">
                    <div class="card-header">
                        <img src="<?php echo $vacancies->getLogo($vacancy); ?>" alt="Company logo" width="40" height="40">
                        <span><?php echo $vacancies->getCompanyName($vacancy); ?></span>
                        <span><?php echo $vacancies->getCreationData($vacancy); ?></span>
                        <span><?php echo $vacancy["responses"]; ?> відгуків</span>
                    </div><br>
                    <div class="card-title">
                        <span><b><?php echo $vacancy["title"]; ?></b></span>
                        <div class="card-body">
                            <span><?php echo $vacancies->getEmplType($vacancy); ?></span>
                            <span><?php echo $vacancies->getCountry($vacancy); ?></span>
                            <span><?php echo $vacancies->getExperience($vacancy); ?></span>
                            <span><?php echo $vacancies->getEnglish($vacancy); ?></span>
                        </div>
                    </div>
                    <hr>
                    <p><?php echo $vacancies->getDescription($vacancy); ?></p>
                    <a href="../pages/vacancy.php?vacancy_id=<?php echo $vacancy["id"]; ?>">Детальна інформація</a>
                </div>

                <?php
            }
            unset($_SESSION["vacancies"]);
        }
    ?>

    </section>
</section>

<?php
    include_once "../footer.php";
?>