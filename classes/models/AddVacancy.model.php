<?php 

class AddVacancyModel extends Dbh{     

    protected function createVacancy($recruiterId, $title, $descriptionV, $category, $skills, $country, $english, $experience, $salary, $empl_type) {
        //submit query to database without entered inform
        $vacancyStatus = "active";
        $responses = 0;
        $query = "INSERT INTO vacancies (title, vacancy_descr, recruiter_id, english_id, salary, category_id, 
            skills, experience_id, country_id, empl_type_id, vacancy_status, responses) VALUES (:title, 
            :descriptionV, :recruiterId, :english, :salary, :category, :skills, :experience, :country, 
            :empl_type, :vacancyStatus, :responses);";

        //run query into database
        $stmt = parent::connect()->prepare($query);
      
        //initialize placeholders
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":descriptionV", $descriptionV);
        $stmt->bindParam(":recruiterId", $recruiterId);
        $stmt->bindParam(":english", $english);
        $stmt->bindParam(":salary", $salary);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":skills", $skills);
        $stmt->bindParam(":experience", $experience);
        $stmt->bindParam(":country", $country);
        $stmt->bindParam(":empl_type", $empl_type);
        $stmt->bindParam(":vacancyStatus", $vacancyStatus);
        $stmt->bindParam(":responses", $responses);

        //after send data that user submitted
        $stmt->execute();

        $stmt = null;
    }

    protected function changeVacancy($vacancyId, $title, $descriptionV, $category, $skills, $country, $english, $experience, $salary, $empl_type) {       
        
        try {
            //submit query to database without entered inform
            $query = "UPDATE vacancies SET title = :title, vacancy_descr = :descriptionV, english_id = :english,
                salary = :salary, category_id = :category, skills = :skills, experience_id = :experience, 
                country_id = :country, empl_type_id = :empl_type WHERE id = :vacancyId;";

            //run query into database
            $stmt = parent::connect()->prepare($query);

            //initialize placeholders
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":descriptionV", $descriptionV);
            $stmt->bindParam(":english", $english);
            $stmt->bindParam(":salary", $salary);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":skills", $skills);
            $stmt->bindParam(":experience", $experience);
            $stmt->bindParam(":country", $country);
            $stmt->bindParam(":empl_type", $empl_type);
            $stmt->bindParam(":vacancyId", $vacancyId);

            //after send data that user submitted
            $stmt->execute();  
        } catch (PDOException $e) {
            $stmt = null;
            header("Location: ../recruiter/my_vacancies.php?error=stmtfailed" . $e->getMessage());
            exit();            
        } 
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

    protected function removeVacancy($vacancyId) {
        try {
            //submit query to database without entered inform
            $query = "UPDATE vacancies SET vacancy_status = :v_status WHERE id = :vacancyId;";

            //run query into database
            $stmt = parent::connect()->prepare($query);

            $status = "inactive";
            //initialize placeholders
            $stmt->bindParam(":v_status", $status);
            $stmt->bindParam(":vacancyId", $vacancyId);

            //after send data that user submitted
            $stmt->execute();  
        } catch (PDOException $e) {
            $stmt = null;
            header("Location: ../pages/all_vacancies.php?error=stmtfailed" . $e->getMessage());
            exit();            
        } 
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
}