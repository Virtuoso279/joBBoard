<?php 

class AllVacanciesModel extends Dbh{     

    protected function grabFilteredVacancies($query, $arrayInput) {
        $query = $query . " AND vacancy_status = 'active' ORDER BY created_at DESC;";
        $stmt = $this->connect()->prepare($query);

        if (count($arrayInput) > 0) {
            if (!$stmt->execute($arrayInput)) {
                $stmt = null;
                header("Location: ../pages/all_vacancies.php?error=stmtfailed");
                exit();
            }
        } else { // for only salary input without array
            if (!$stmt->execute()) {
                $stmt = null;
                header("Location: ../pages/all_vacancies.php?error=stmtfailed");
                exit();
            }
        }

        if ($stmt->rowCount() == 0) {
            return "Empty search!";
        } else {
            $vacanciesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vacanciesData;
        }
    }

    protected function grabAllVacancies() {             
        //submit query to database without entered inform
        $query = "SELECT * FROM vacancies WHERE vacancy_status = 'active' ORDER BY created_at DESC LIMIT 5;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=vacanciesnotfound");
            exit();
        }

        $vacanciesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $vacanciesData;
    }

    protected function grabVacancy($vacancyId) {             
        //submit query to database without entered inform
        $query = "SELECT * FROM vacancies WHERE id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$vacancyId])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=vacancynotfound");
            exit();
        }

        $vacancyData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $vacancyData;
    }

    protected function grabRecruiterVacancies($recruiterId) {             
        //submit query to database without entered inform
        $query = "SELECT * FROM vacancies WHERE recruiter_id = ? AND vacancy_status = 'active';";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$recruiterId])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            return "Empty list";
        } else {
            $vacanciesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vacanciesData;
        }
    }

    protected function getCategoryId($category) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM categories WHERE category_name = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$category])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=categorynotfound");
            exit();
        }

        $categoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categoryData;
    }

    protected function getEnglishId($english) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM english WHERE level_lang = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$english])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=englishnotfound");
            exit();
        }

        $englishData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $englishData;
    }

    protected function getExperienceId($experience) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM experience WHERE months = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$experience])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=experiencenotfound");
            exit();
        }

        $experienceData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $experienceData;
    }

    protected function getCountryId($country) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM countries WHERE country_name = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$country])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=countrynotfound");
            exit();
        }

        $countryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $countryData;
    }

    protected function getEmplTypeId($empl_type) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM empltypes WHERE employment_type = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$empl_type])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=empltypenotfound");
            exit();
        }

        $emplTypeData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $emplTypeData;
    }

    protected function getCompanyInfo($recruiterId) {             
        //submit query to database without entered inform
        $query = "SELECT company_name, company_photo, full_name, position FROM recruiters WHERE id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$recruiterId])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=recruiternotfound");
            exit();
        }

        $companyData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $companyData;
    }

    protected function getEmplTypeName($emplTypeId) {             
        //submit query to database without entered inform
        $query = "SELECT employment_type FROM empltypes WHERE id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$emplTypeId])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=empltypenotfound");
            exit();
        }

        $emplTypeData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $emplTypeData;
    }

    protected function getCategoryName($categoryId) {             
        //submit query to database without entered inform
        $query = "SELECT category_name FROM categories WHERE id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$categoryId])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=categorynotfound");
            exit();
        }

        $categoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categoryData;
    }

    protected function getEnglishName($englishId) {             
        //submit query to database without entered inform
        $query = "SELECT level_lang FROM english WHERE id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$englishId])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=englishnotfound");
            exit();
        }

        $englishData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $englishData;
    }

    protected function getExperienceName($experienceId) {             
        //submit query to database without entered inform
        $query = "SELECT months FROM experience WHERE id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$experienceId])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=experiencenotfound");
            exit();
        }

        $experienceData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $experienceData;
    }

    protected function getCountryName($countryId) {             
        //submit query to database without entered inform
        $query = "SELECT country_name FROM countries WHERE id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$countryId])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=countrynotfound");
            exit();
        }

        $countryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $countryData;
    }

    protected function grabAllCategories() {             
        //submit query to database without entered inform
        $query = "SELECT category_name FROM categories;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=categoriesnotfound");
            exit();
        }

        $categoryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $categoryData;
    }

    protected function grabAllSkills() {             
        //submit query to database without entered inform
        $query = "SELECT skill_title FROM skills;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=skillsnotfound");
            exit();
        }

        $skillsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $skillsData;
    }

    protected function grabAllCountries() {             
        //submit query to database without entered inform
        $query = "SELECT country_name FROM countries;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=countriesnotfound");
            exit();
        }

        $countriesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $countriesData;
    }

    protected function grabAllEnglish() {             
        //submit query to database without entered inform
        $query = "SELECT level_lang FROM english;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=englishnotfound");
            exit();
        }

        $englishData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $englishData;
    }

    protected function grabAllExperience() {             
        //submit query to database without entered inform
        $query = "SELECT months FROM experience;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=experiencenotfound");
            exit();
        }

        $experienceData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $experienceData;
    }

    protected function grabAllEmplTypes() {             
        //submit query to database without entered inform
        $query = "SELECT employment_type FROM empltypes;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=empltypesnotfound");
            exit();
        }

        $empltypesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $empltypesData;
    }

    protected function setResponses($vacancyId) {             
        //submit query to database without entered inform
        $query = "SELECT * FROM conversations WHERE vacancy_id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$vacancyId])) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed");
            exit();
        }

        $responsesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $responsesAmount = count($responsesData);

        try {
            //submit query to database without entered inform
            $query = "UPDATE vacancies SET responses = :responsesAmount WHERE id = :vacancyId;";

            //run query into database
            $stmt = parent::connect()->prepare($query);

            //initialize placeholders
            $stmt->bindParam(":responsesAmount", $responsesAmount);
            $stmt->bindParam(":vacancyId", $vacancyId);

            //after send data that user submitted
            $stmt->execute();  

        } catch (PDOException $e) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed" . $e->getMessage());
            exit();            
        } 
    }
}