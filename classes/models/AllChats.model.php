<?php 

class AllChatsModel extends Dbh{     

    protected function grabFilteredChats($query) {
        $query = $query . " AND vacancy_id = vacancies.id ORDER BY conversations.created_at DESC;";
        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            return "Empty search!";
        } else {
            $chatsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $chatsData;
        }
    }

    protected function grabAllChats($userType, $userId) {             
        //submit query to database without entered inform
        if ($userType === "candidate") {
            $query = "SELECT *, conversations.id FROM conversations, vacancies WHERE candidate_id = " . $userId . " AND vacancies.vacancy_status = 'active' AND vacancy_id = vacancies.id ORDER BY conversations.created_at DESC;";
        }  elseif ($userType === "recruiter") {
            $query = "SELECT *, conversations.id FROM conversations, vacancies WHERE conversations.recruiter_id = " . $userId . " AND vacancies.vacancy_status = 'active' AND vacancy_id = vacancies.id ORDER BY conversations.created_at DESC;";
        }

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=chatsnotfound");
            exit();
        }

        $chatsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $chatsData;
    }

    protected function grabRecruiterVacancies($recruiterId) {             
        //submit query to database without entered inform
        $query = "SELECT * FROM vacancies WHERE recruiter_id = ? AND vacancy_status = 'active';";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$recruiterId])) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            return "Empty list";
        } else {
            $vacanciesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vacanciesData;
        }
    }

    protected function getUser($userType, $userId) {
        //submit query to database without entered inform
        if ($userType === "candidate") {
            $query = "SELECT * FROM candidates WHERE id = ?;";
        } elseif ($userType === "recruiter") {
            $query = "SELECT * FROM recruiters WHERE id = ?;";
        }  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$userId])) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=candidatenotfound");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;
    }

    protected function getVacancyId($vacancy) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM vacancies WHERE title = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$vacancy])) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=vacancynotfound");
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

    protected function getCompanyInfo($recruiterId) {             
        //submit query to database without entered inform
        $query = "SELECT company_name, full_name, position FROM recruiters WHERE id = ?;";  

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
}