<?php 

class ChatModel extends Dbh{    

    protected function createMessage($chatId, $senderId, $messageBody) {
        //submit query to database without entered inform
        $isRead = false;
        $query = "INSERT INTO messages (conversation_id, sender_id, body, is_read) VALUES (:chatId, :senderId, :messageBody, :isRead);";

        //run query into database
        $stmt = parent::connect()->prepare($query);
      
        //initialize placeholders
        $stmt->bindParam(":chatId", $chatId);
        $stmt->bindParam(":senderId", $senderId);
        $stmt->bindParam(":messageBody", $messageBody);
        $stmt->bindParam(":isRead", $isRead);

        //after send data that user submitted
        $stmt->execute();

        $stmt = null;
    }

    protected function createChat($vacancyId, $candidateId, $recruiterId) {
        //submit query to database without entered inform
        $notAproachCand = false;
        $notAproachVac = false;
        $query = "INSERT INTO conversations (candidate_id, recruiter_id, vacancy_id, not_aproach_cand,
            not_aproach_vac) VALUES (:candidateId, :recruiterId, :vacancyId, :notAproachCand, :notAproachVac);";

        //run query into database
        $stmt = parent::connect()->prepare($query);
      
        //initialize placeholders
        $stmt->bindParam(":candidateId", $candidateId);
        $stmt->bindParam(":recruiterId", $recruiterId);
        $stmt->bindParam(":vacancyId", $vacancyId);
        $stmt->bindParam(":notAproachCand", $notAproachCand);
        $stmt->bindParam(":notAproachVac", $notAproachVac);

        //after send data that user submitted
        $stmt->execute();

        $stmt = null;
    }

    protected function getChatMessages($chatId) {
        //submit query to database without entered inform
        $query = "SELECT * FROM messages WHERE conversation_id = ? ORDER BY created_at;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$chatId])) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=messagesnotfound");
            exit();
        }

        $messagesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $messagesData;
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

    protected function searchChat($chatId) {             
        //submit query to database without entered inform
        $query = "SELECT *, conversations.id FROM conversations, vacancies WHERE conversations.vacancy_id = vacancies.id AND conversations.id = " . $chatId . ";";

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            $chatData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $chatData;
        }
    }

    protected function searchVacancy($vacancyId) {             
        //submit query to database without entered inform
        $query = "SELECT * FROM vacancies WHERE id = " . $vacancyId . ";";

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            $vacancyData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vacancyData;
        }
    }

    protected function getChatId($candidateId, $recruiterId, $vacancyId) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM conversations WHERE candidate_id = ? AND recruiter_id = ? AND vacancy_id = ?;";

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$candidateId, $recruiterId, $vacancyId])) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../pages/all_chats.php?error=chatidnotfound");
            exit();
        }

        $chatData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $chatData;
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