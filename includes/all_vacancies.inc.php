<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grabbing the data
    $category = $_POST["category"] !== "EmptyValue" ? $_POST["category"] : null;
    $country = $_POST["country"] !== "EmptyValue" ? $_POST["country"] : null;
    $english = $_POST["english"] !== "EmptyValue" ? $_POST["english"] : null;
    $experience = $_POST["experience"] !== "EmptyValue" ? $_POST["experience"] : null;
    $salary = $_POST["salary"] !== "EmptyValue" ? $_POST["salary"] : null;
    $empl_type = $_POST["empl_type"] !== "EmptyValue" ? $_POST["empl_type"] : null;

    // Instantiate AllVacancies class
    require_once "../classes/Dbh.php";
    require_once "../classes/models/AllVacancies.model.php";
    require_once "../classes/controllers/AllVacancies.contr.php";

    // Create user object
    $allVacanciesObject = new AllVacanciesContr($category, $country, $english, $experience, $salary, $empl_type);

    // Running error handlers and user signup
    $allVacanciesObject->getVacanciesList();

    // Redirect to Profile page
    header("Location: ../pages/all_vacancies.php");

} else {
    header("Location: ../pages/all_vacancies.php");
}
