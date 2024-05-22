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

if (isset($_GET["vacancy_id"])) {
    $vacancy = $vacancies->getVacancy($_GET["vacancy_id"]); 
    $vacancy = $vacancy[0]; 
    $vacancies->setResponseAmount($vacancy["id"]);
?>

<head>
    <link rel="stylesheet" href="http://localhost/joBBoard/styles/pages/vacancy.css">
</head>

    <h3>Вакансія</h3>
    <section class="vacancy-block">
        <div class="vacancy-info">
            <div class="card-header">
                <img src="<?php echo $vacancies->getLogo($vacancy); ?>" alt="Company logo" width="70" height="70">
                <span><?php echo $vacancies->getRecruiterInfo($vacancy); ?></span>
                <span><?php echo $vacancies->getCompanyName($vacancy); ?></span>
                <span><?php echo $vacancies->getStatus($vacancy); ?></span>
            </div><br>
            <div class="card-title">
                <strong class="vacancy-title"><?php echo $vacancy["title"]; ?></strong>
                <div class="responses-block">
                    <span><?php echo $vacancies->getCreationData($vacancy); ?></span>
                    <span><?php echo $vacancy["responses"]; ?> відгуків</span>
                </div>
            </div>
            <hr>
            <p><?php echo $vacancy["vacancy_descr"]; ?></p>
        </div>
            
        <div class="vacancy-features">
            <p><?php echo $vacancies->getEmplType($vacancy); ?></p><br>
            <p><?php echo $vacancies->getCountry($vacancy); ?></p><br>
            <p><?php echo $vacancies->getExperience($vacancy); ?></p><br>
            <p><?php echo $vacancies->getEnglish($vacancy); ?></p><br>
            <span class="skills-list">
                <?php
                    $skills = $vacancies->getSkills($vacancy);
                    foreach ($skills as $skill) {
                        echo '<span>' . $skill . '</span><br>';
                    }
                ?>
            </span>
        </div>
    </section>
    

<?php
    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
?>
        <section class="make-response">
            <h3>Зробити відгук</h3>
            <div class="block-response">
                <form action="../includes/chat.inc.php?chat_id=unknown&vacancy_id=<?php echo $vacancy["id"]; ?>" method="post">
                    <label for="cover-letter">Мотиваційний лист:</label><br>
                    <textarea name="message" id="message" rows="10" cols="50" placeholder="Message"></textarea><br>
                    <button>Відгукнутися</button>
                </form>
                <a href="all_vacancies.php">Назад</a>
            </div>
        </section>
<?php
    }

} else {
    echo "Vacancy not found!";
}

include_once "../footer.php";

?>