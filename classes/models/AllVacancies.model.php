<?php 

class AllVacanciesModel extends Dbh{     

    protected function grabFilteredVacancies($query, $arrayInput) {
        $query = $query . " ORDER BY created_at DESC;";
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
        $query = "SELECT * FROM vacancies ORDER BY created_at DESC LIMIT 5;";  

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
}