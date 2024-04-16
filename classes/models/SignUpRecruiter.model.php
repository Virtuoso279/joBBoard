<?php 

class SignUpModelRecruiter extends Dbh{    

    protected function setUser($userId, $full_name, $position, $user_photo, $company, $description, $country, $logo_photo, $status) {       
        
        try {
            //submit query to database without entered inform
            $query = "UPDATE recruiters SET full_name = :full_name, position = :position, my_photo = :user_photo,
            company_name = :company, company_descr = :description_company, country_id = :country, 
            company_photo = :logo_photo, user_status = :user_status WHERE id = :userId;";

            //run query into database
            $stmt = parent::connect()->prepare($query);

            //initialize placeholders
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":position", $position);
            $stmt->bindParam(":user_photo", $user_photo);
            $stmt->bindParam(":company", $company);
            $stmt->bindParam(":description_company", $description);
            $stmt->bindParam(":country", $country);
            $stmt->bindParam(":logo_photo", $logo_photo);
            $stmt->bindParam(":user_status", $status);
            $stmt->bindParam(":userId", $userId);

            //after send data that user submitted
            $stmt->execute();  
        } catch (PDOException $e) {
            $stmt = null;
            header("Location: ../recruiter/signup_recruiter.php?error=stmtfailed" . $e->getMessage());
            exit();            
        } 
    } 

    protected function getCountryId($country) {             
        //submit query to database without entered inform
        $query = "SELECT id FROM countries WHERE country_name = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$country])) {
            $stmt = null;
            header("Location: ../recruiter/signup_recruiter.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../recruiter/signup_recruiter.php?error=countrynotfound");
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

        $userType = "recruiter";
        //initialize placeholders
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":userType", $userType);

        //after send data that user submitted
        $stmt->execute();

        $stmt = null;
    }

    protected function grabAllCountries() {             
        //submit query to database without entered inform
        $query = "SELECT country_name FROM countries;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../recruiter/signup_recruiter.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../recruiter/signup_recruiter.php?error=countriesnotfound");
            exit();
        }

        $countriesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $countriesData;
    }
}