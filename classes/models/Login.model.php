<?php 

session_start();

class LoginModel extends Dbh{

    protected function searchUser($email, $pwd, $userType) {
        //submit query to database without entered inform
        $query = "SELECT pwd FROM " . $userType . " WHERE email = ?;";

        //run query into database
        $stmt = parent::connect()->prepare($query);

        //after send data that user submitted
        if(!$stmt->execute([$email])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            return false;
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["pwd"]);

        $errors = [];

        if (!$checkPwd) {
            $stmt = null;
            $errors["wrongPassword"] = "Wrong password!";
            // header("Location: ../index.php?error=wrongpassword");
            // exit();   
        } else {
            $query = "SELECT * FROM " . $userType . " WHERE email = ? AND pwd = ?;";
            $stmt = parent::connect()->prepare($query);

            //after send data that user submitted
            if(!$stmt->execute([$email, $pwdHashed[0]["pwd"]])) {
                $stmt = null;
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                $errors["userNotFound"] = "User not found!";
                // header("Location: ../index.php?error=usernotfound");
                // exit();   
            } else {
                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $_SESSION["user_id"] = $user[0]["id"];
                //change name of user type
                $_SESSION["user_type"] = substr($userType, 0, -1);

                $stmt = null;
                return true;
            }    
        }

        if ($errors) {
            $_SESSION["errors_login"] = $errors; 
            header("Location: ../login.php"); 
            die();
        }
    }  
}