<?php

class ChatView extends ChatModel {

    public function getChat($chatId) {
        $chatInfo = $this->searchChat($chatId);
        return $chatInfo;
    }

    public function getMessages($chatId) {
        $chatInfo = $this->getChatMessages($chatId);
        return $chatInfo;
    }

    public function getPhoto($userType, $userId) {
        $profileInfo = $this->getUser($userType, $userId);
        if ($userType === "candidate") {
            $urlPhoto = str_replace("C:/xampp/htdocs", "http://localhost", $profileInfo[0]["photo_path"]);
        } elseif ($userType === "recruiter") {
            $urlPhoto = str_replace("C:/xampp/htdocs", "http://localhost", $profileInfo[0]["my_photo"]);
        }
        return $urlPhoto;
    }

    public function getUserName($chatId, $senderId) {
        $chatInfo = $this->searchChat($chatId);
        if ($chatInfo[0]["candidate_id"] == $senderId) {
            $userType = "candidate";
        } elseif ($chatInfo[0]["recruiter_id"] == $senderId) {
            $userType = "recruiter";
        }
        $profileInfo = $this->getUser($userType, $senderId);
        return $profileInfo[0]["full_name"];
    }

    public function getCandidateName($userId) {
        $profileInfo = $this->getUser("candidate", $userId);
        return $profileInfo[0]["full_name"];
    }

    public function getCandidatePosition($userId) {
        $profileInfo = $this->getUser("candidate", $userId);
        return $profileInfo[0]["position"];
    }

    public function getCandidateStatus($userId) {
        $profileInfo = $this->getUser("candidate", $userId);
        if ($profileInfo[0]["user_status"] === "active") {
            return "Активний пошук";
        } elseif ($profileInfo[0]["user_status"] === "passive") {
            return "Пасивний пошук";
        } elseif ($profileInfo[0]["user_status"] === "stopsearch") {
            return "Не шукає роботу";
        } else {
            return "Некоректний статус";
        }
    }

    public function getCategory($chat) {
        $categoryName = $this->getCategoryName($chat["category_id"]);
        return $categoryName[0]["category_name"];
    }

    public function getEnglish($chat) {
        $englishName = $this->getEnglishName($chat["english_id"]);
        return $englishName[0]["level_lang"];
    }

    public function getExperience($chat) {
        $experienceName = $this->getExperienceName($chat["experience_id"]);
        if ($experienceName[0]["months"] == "1") {
            return "Без досвіду";
        } elseif ($experienceName[0]["months"] == "6") {
            return "Менше 6 місяців";
        } elseif ($experienceName[0]["months"] == "12") {
            return "Від 6 до 12 місяців";
        } elseif ($experienceName[0]["months"] == "24") {
            return "Від 1 року до 2 років";
        } elseif ($experienceName[0]["months"] == "48") {
            return "Від 2 років до 4 років";
        } elseif ($experienceName[0]["months"] == "49") {
            return "Від 4 років і більше";
        }
    }

    public function getCountry($chat) {
        $countryName = $this->getCountryName($chat["country_id"]);
        return $countryName[0]["country_name"];
    }

    public function getEmplType($chat) {
        $emplTypeName = $this->getEmplTypeName($chat["empl_type_id"]);
        return $emplTypeName[0]["employment_type"];
    }

    public function getCompanyName($chat) {
        $companyInfo = $this->getCompanyInfo($chat["recruiter_id"]);
        return $companyInfo[0]["company_name"];
    }

    public function getRecruiterInfo($chat) {
        $recruiterInfo = $this->getCompanyInfo($chat["recruiter_id"]);
        return $recruiterInfo[0]["full_name"] . ", " . $recruiterInfo[0]["position"];
    }

    public function getCreationData($message) {
        $data = date('d.m.Y g:i a', strtotime($message["created_at"]));
        return $data;
    }

    public function getStatus($vacancy) {
        $status = $vacancy["vacancy_status"] === "active" ? "Активна" : "Неактивна";
        return $status;
    }

    public function messageInput() {

        echo '<label for="message">Надіслати повідомлення:</label><br>';
    
        if (isset($_SESSION["errors_chat"]["email"])) {        
            echo '<textarea name="message" id="message" rows="10" cols="50" placeholder="Message">' . $_SESSION["chat_data"]["message"] . '</textarea><br>';
        } else {
            echo '<textarea name="message" id="message" rows="10" cols="50" placeholder="Message"></textarea><br>';
        }
    }
    
    public function checkChatErrors() {
        if (isset($_SESSION["errors_chat"])) {
            $errors = $_SESSION["errors_chat"];
    
            foreach ($errors as $error) {
                echo '<p class="form-error">' . $error . '</p>';
            }
    
            unset($_SESSION["errors_chat"]);
        }
    }
}

