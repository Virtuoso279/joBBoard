<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grabbing the data
    $title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');
    $category = $_POST["category"];
    $skills = $_POST["skills"];
    $country = $_POST["country"];
    $salary = filter_input(INPUT_POST, "salary", FILTER_SANITIZE_NUMBER_INT);
    $english = $_POST["english"];
    $experience = $_POST["experience"];
    $empl_type = $_POST["empl_type"];

    // Instantiate AddVacancy class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/AddVacancy.model.php";
    require_once "../classes/controllers/AddVacancy.contr.php";

    // Create addVacancy object
    $addVacancyObject = new AddVacancyContr($title, $description, $category, $skills, $country, $english, $experience, $salary, $empl_type);

    // Running error handlers and user signup
    if (isset($_GET["vacancy_id"])) {
        $vacancyId = $_GET["vacancy_id"];
        $addVacancyObject->addVacancy($vacancyId);
    } else {
        $vacancyId = "new vacancy";
        $addVacancyObject->addVacancy($vacancyId);
    }

    // Redirect to vacancy page
    header("Location: ../recruiter/my_vacancies.php?error=none");

} else {
    header("Location: ../recruiter/my_vacancies.php");
}
