<?php 

class SignUpModelCandidate extends Dbh{    

    protected function setUser($userId, $full_name, $position, $category, $skills, $country, $resume_pth, $user_photo, $salary, $english, $experience, $status) {       
        
        try {
            //submit query to database without entered inform
            $query = "UPDATE candidates SET full_name = :full_name, position = :position, 
            category_id = :category, skills = :skills, country_id = :country, resume_path = :resume_pth,
            photo_path = :user_photo, salary = :salary, english_id = :english, experience_id = :experience, 
            user_status = :user_status WHERE id = :userId;";

            //run query into database
            $stmt = parent::connect()->prepare($query);

            //initialize placeholders
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":position", $position);
            $stmt->bindParam(":category", $category);
            $stmt->bindParam(":skills", $skills);
            $stmt->bindParam(":country", $country);
            $stmt->bindParam(":resume_pth", $resume_pth);
            $stmt->bindParam(":user_photo", $user_photo);
            $stmt->bindParam(":salary", $salary);
            $stmt->bindParam(":english", $english);
            $stmt->bindParam(":experience", $experience);
            $stmt->bindParam(":user_status", $status);
            $stmt->bindParam(":userId", $userId);

            //after send data that user submitted
            $stmt->execute();  
        } catch (PDOException $e) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed" . $e->getMessage());
            exit();            
        } 
    } 

    protected function getCategoryId($category) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM categories WHERE category_name = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$category])) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=categorynotfound");
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
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=englishnotfound");
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
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=experiencenotfound");
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
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=countrynotfound");
            exit();
        }

        $countryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $countryData;
    }

    protected function setUserContacts($userId, $full_name) {                
        //submit query to database without entered inform
        $query = "INSERT INTO contacts (full_name, user_id, user_type) VALUES (:full_name, :user_id, :userType);";

        //run query into database
        $stmt = parent::connect()->prepare($query);       

        $userType = "candidate";
        //initialize placeholders
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":userType", $userType);

        //after send data that user submitted
        $stmt->execute();

        $stmt = null;
    }

    protected function grabAllCategories() {             
        //submit query to database without entered inform
        $query = "SELECT category_name FROM categories;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=categoriesnotfound");
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
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=skillsnotfound");
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
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=countriesnotfound");
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
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=englishnotfound");
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
            header("Location: ../candidate/signup_candidate.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../candidate/signup_candidate.php?error=experiencenotfound");
            exit();
        }

        $experienceData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $experienceData;
    }
}