<?php 

class SignUpModelRecruiter extends Dbh{    

    protected function setUser($userId, $full_name, $position, $company, $description, $country, $status) {       
        
        try {
            //submit query to database without entered inform
            $query = "UPDATE recruiters SET full_name = :full_name, position = :position, 
            company_name = :company, company_descr = :description_company, country_id = :country, 
            user_status = :user_status WHERE id = :userId;";

            //run query into database
            $stmt = parent::connect()->prepare($query);

            //initialize placeholders
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":position", $position);
            $stmt->bindParam(":company", $company);
            $stmt->bindParam(":description_company", $description);
            $stmt->bindParam(":country", $country);
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

}