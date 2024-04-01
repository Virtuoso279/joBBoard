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
?>

    <h3>Вакансії</h3>
    <section class="vacancy-info">
        <section class="card-header">
            <img src="<?php echo $vacancies->getLogo($vacancy); ?>" alt="Company logo" width="70" height="70">
            <span><?php echo $vacancies->getRecruiterInfo($vacancy); ?></span>
            <span><?php echo $vacancies->getCompanyName($vacancy); ?></span>
            <span><?php echo $vacancies->getStatus($vacancy); ?></span>
        </section><br>
        <section class="card-title">
            <span><?php echo $vacancy["title"]; ?></span>
            <span><?php echo $vacancies->getCreationData($vacancy); ?></span>
            <span><?php echo $vacancy["responses"]; ?></span>
        </section>
        <hr>
        <p><?php echo $vacancy["vacancy_descr"]; ?></p>
    </section>
        
    <section class="vacancy-features">
        <span><?php echo $vacancies->getEmplType($vacancy); ?></span><br>
        <span><?php echo $vacancies->getCountry($vacancy); ?></span><br>
        <span><?php echo $vacancies->getExperience($vacancy); ?></span><br>
        <span><?php echo $vacancies->getEnglish($vacancy); ?></span><br>
        <?php
            $skills = $vacancies->getSkills($vacancy);
            foreach ($skills as $skill) {
                echo '<span>' . $skill . '</span><br>';
            }
        ?>
    </section>

<?php
    if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
?>
        <section class="make-response">
            <h3>Зробити відгук</h3>
            <form action="#" method="post">
                <label for="cover-letter">Мотиваційний лист:</label><br>
                <textarea name="cover_letter" id="cover-letter" rows="10" cols="50" placeholder="Message"></textarea><br>
                <label for="resume">Файл резюме:</label><br>
                <input type="file" id="resume" name="resume"><br>
                <button>Відгукнутися</button>
            </form>
            <a href="all_vacancies.php">Назад</a>
        </section>
<?php
    }

} else {
    echo "Vacancy not found!";
}

include_once "../footer.php";

?>