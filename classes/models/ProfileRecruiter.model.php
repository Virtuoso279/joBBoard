<?php 

class ProfileModelRecruiter extends Dbh{    

    protected function setUser($userId, $full_name, $position, $photo_path, $company, $description, $logo, $country, $status) {       
        
        try {
            //submit query to database without entered inform
            $query = "UPDATE recruiters SET full_name = :full_name, position = :position, my_photo = :photo_path,
            company_name = :company, company_descr = :description_company, company_photo = :logo,
            country_id = :country, user_status = :user_status WHERE id = :userId;";

            //run query into database
            $stmt = parent::connect()->prepare($query);

            //initialize placeholders
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":position", $position);
            $stmt->bindParam(":photo_path", $photo_path);
            $stmt->bindParam(":company", $company);
            $stmt->bindParam(":description_company", $description);
            $stmt->bindParam(":logo", $logo);
            $stmt->bindParam(":country", $country);
            $stmt->bindParam(":user_status", $status);
            $stmt->bindParam(":userId", $userId);

            //after send data that user submitted
            $stmt->execute();  

            //change data in contacts table
            //submit query to database without entered inform
            $userType = "recruiter";
            $query = "UPDATE contacts SET full_name = :full_name WHERE user_id = :userId AND user_type = :userType;";

            //run query into database
            $stmt = parent::connect()->prepare($query);

            //initialize placeholders
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":userId", $userId);
            $stmt->bindParam(":userType", $userType);

            //after send data that user submitted
            $stmt->execute();
        } catch (PDOException $e) {
            $stmt = null;
            header("Location: ../recruiter/profile_recruiter.php?error=stmtfailed" . $e->getMessage());
            exit();            
        }
    } 

    protected function getUser($userId) {
        //submit query to database without entered inform
        $query = "SELECT * FROM recruiters WHERE id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$userId])) {
            $stmt = null;
            header("Location: ../recruiter/profile_recruiter.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../recruiter/profile_recruiter.php?error=candidatenotfound");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;
    }

    protected function getCountryId($country) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM countries WHERE country_name = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$country])) {
            $stmt = null;
            header("Location: ../recruiter/profile_recruiter.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../recruiter/profile_recruiter.php?error=countrynotfound");
            exit();
        }

        $countryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $countryData;
    }

    protected function getCountryName($countryId) {             
        //submit query to database without entered inform
        $query = "SELECT country_name FROM countries WHERE id = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$countryId])) {
            $stmt = null;
            header("Location: ../recruiter/profile_recruiter.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../recruiter/profile_recruiter.php?error=countrynotfound");
            exit();
        }

        $countryData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $countryData;
    }
}