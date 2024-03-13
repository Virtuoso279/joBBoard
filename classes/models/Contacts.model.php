<?php 

class ContactsModel extends Dbh{    

    protected function setContacts($userId, $userType, $full_name, $aboutme, $email, $phone, $telegram, $linkedin, $projects) {       
        
        try {
            //change data in contacts table
            //submit query to database without entered inform
            $query = "UPDATE contacts SET full_name = :full_name, about_me = :aboutme, phone = :phone,
            telegram = :telegram, linkedIn = :linkedin, links = :projects WHERE user_id = :userId AND 
            user_type = :userType;";

            //run query into database
            $stmt = parent::connect()->prepare($query);

            //initialize placeholders
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":aboutme", $aboutme);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":telegram", $telegram);
            $stmt->bindParam(":linkedin", $linkedin);
            $stmt->bindParam(":projects", $projects);
            $stmt->bindParam(":userType", $userType);
            $stmt->bindParam(":userId", $userId);

            //after send data that user submitted
            $stmt->execute();  

            //change data in user table
            if ($userType === "candidate") {
                //submit query to database without entered inform            
                $query = "UPDATE candidates SET full_name = :full_name, email = :email WHERE id = :userId;";
            } elseif ($userType === "recruiter") {
                //submit query to database without entered inform
                $query = "UPDATE recruiters SET full_name = :full_name, email = :email WHERE id = :userId;";
            } else {
                header("Location: ../pages/contacts.php?error=invalid_usertype");
                exit();
            }

            //run query into database
            $stmt = parent::connect()->prepare($query);

            //initialize placeholders
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":userId", $userId);

            //after send data that user submitted
            $stmt->execute();

        } catch (PDOException $e) {
            $stmt = null;
            header("Location: ../pages/contacts.php?error=stmtfailed" . $e->getMessage());
            exit();            
        }
    } 

    protected function getUser($userId, $userType) {
        if ($userType === "candidate") {
            //submit query to database without entered inform            
            $query = "SELECT full_name, email FROM candidates WHERE id = ?;";
        } elseif ($userType === "recruiter") {
            //submit query to database without entered inform
            $query = "SELECT full_name, email FROM recruiters WHERE id = ?;";
        } else {
            header("Location: ../index.php?error=invalid_usertype");
            exit();
        }

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$userId])) {
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

    protected function getContacts($userId, $userType) {
        //submit query to database without entered inform
        $query = "SELECT * FROM contacts WHERE user_id = ? AND user_type = ?;";  

        $stmt = $this->connect()->prepare($query);

        if (!$stmt->execute([$userId, $userType])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../index.php?error=contactsnotfound");
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $profileData;
    }
}