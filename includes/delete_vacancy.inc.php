<?php

require_once "../classes/Dbh.php";
require_once "../classes/models/AddVacancy.model.php";
require_once "../classes/controllers/AddVacancy.contr.php";

if (isset($_GET["vacancy_id"])) {
    $vacancyId = $_GET["vacancy_id"];
} else {
    header("Location: ../recruiter/my_vacancies.php?error=vacancyidnotfound"); 
    exit();
}

//create temp add vacancy object
$tempAddVacancy = new AddVacancyContr("", "", 1, 1, 1, 1, 1, 1, 1);
$tempAddVacancy->deleteVacancy($vacancyId);

// Going back to the signup page
header("Location: ../recruiter/my_vacancies.php?error=none");   