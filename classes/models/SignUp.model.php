<?php 

class SignUpModel extends Dbh{
    
    protected function checkUser($email) {
        //check candidates table
        //submit query to database without entered inform
        $query = "SELECT id FROM candidates WHERE email = ?;";

        //run query into database
        $stmt = parent::connect()->prepare($query);

        //after send data that user submitted
        if(!$stmt->execute([$email])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        //user is founded in candidates
        if ($stmt->rowCount() > 0) {
            return false;
        } 

        //check recruiters table
        //submit query to database without entered inform
        $query = "SELECT id FROM recruiters WHERE email = ?;";

        //run query into database
        $stmt = parent::connect()->prepare($query);

        //after send data that user submitted
        if(!$stmt->execute([$email])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        //user is founded in recruiters
        if ($stmt->rowCount() > 0) {
            return false;
        } else {  //user is not founded
            return true;
        }
    }

    protected function setUser($email, $psw) {
        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
            //submit query to database without entered inform
            $query = "INSERT INTO candidates (email, pwd) VALUES (:email, :pwd);";
        } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter") {
            //submit query to database without entered inform
            $query = "INSERT INTO recruiters (email, pwd) VALUES (:email, :pwd);";
        } else {
            header("Location: ../index.php?error=invalid_usertype");
            exit();
        }        

        //run query into database
        $stmt = parent::connect()->prepare($query);

        //hash password
        $options = [
            'cost' => 12
        ];
        $hashedPassword = password_hash($psw, PASSWORD_BCRYPT, $options);

        //initialize placeholders
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":pwd", $hashedPassword);

        //after send data that user submitted
        $stmt->execute();

        $stmt = null;
    } 
    
    protected function getUserId($userEmail) {
        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "candidate") {
            //submit query to database without entered inform            
            $query = "SELECT id FROM candidates WHERE email = ?;";
        } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "recruiter") {
            //submit query to database without entered inform
            $query = "SELECT id FROM recruiters WHERE email = ?;";
        } else {
            header("Location: ../index.php?error=invalid_usertype");
            exit();
        }       

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$userEmail])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../index.php?error=usernotfound");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;
    }

}