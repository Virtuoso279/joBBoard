<?php

class ChatContr extends ChatModel{
    private $chatId; 
    private $senderId; 
    private $message; 
    private $vacancyId; 

    public function __construct($chatId, $senderId, $message, $vacancyId) {
        $this->chatId = $chatId;
        $this->senderId = $senderId;
        $this->message = $message;
        $this->vacancyId = $vacancyId;
    }

    public function sendInExistChat() {
        session_start();
        $errors = [];

        if ($this->isEmptySubmit()) {
            $errors["emptyInput"] = "Empty submit!";
            // header("Location: ../pages/chat.php?chat_id=" . $this->chatId . "&error=emptyinput");
            // exit();
        }             

        if (!$this->isChatExist($this->chatId)) {
            header("Location: ../pages/chat.php?chat_id=" . $this->chatId . "&error=chatnotfound");
            exit();
        }

        if ($errors) {
            $_SESSION["errors_chat"] = $errors; 

            $chatData = [
                "message" => $this->message
            ];
            $_SESSION["chat_data"] = $chatData;

            header("Location: ../pages/chat.php?chat_id=" . $this->chatId); 
            die();
        } else {
            $this->createMessage($this->chatId, $this->senderId, $this->message);
        }
    }

    public function sendInNewChat() {
        session_start();
        $errors = [];

        if ($this->isEmptySubmit()) {
            $errors["emptyInput"] = "Empty submit!";
            // header("Location: ../pages/all_vacancies.php?error=emptyinput");
            // exit();
        }             

        if (!$this->isVacancyExist($this->vacancyId)) {
            header("Location: ../pages/all_vacancies.php?error=vacancynotfound");
            exit();
        }

        if ($errors) {
            $_SESSION["errors_chat"] = $errors; 

            $chatData = [
                "message" => $this->message
            ];
            $_SESSION["chat_data"] = $chatData;

            header("Location: ../pages/all_vacancies.php"); 
            die();
        } else {
            $vacancyInfo = $this->searchVacancy($this->vacancyId);
            $recruiterId = $vacancyInfo[0]["recruiter_id"];

            $this->createChat($this->vacancyId, $this->senderId, $recruiterId);

            $chatInfo = $this->getChatId($this->senderId, $recruiterId, $this->vacancyId);
            $this->chatId = $chatInfo[0]["id"];

            $this->createMessage($this->chatId, $this->senderId, $this->message);
        }
    }

    private function isEmptySubmit() {
        if (empty($this->chatId) || empty($this->senderId) || empty($this->message) || empty($this->vacancyId)) {
            return true;
        } else {
            return false;
        }
    }

    private function isChatExist($chatId) {
        $isFound = $this->searchChat($chatId);     
        return $isFound;
    }

    private function isVacancyExist($vacancyId) {
        $isFound = $this->searchVacancy($vacancyId);     
        return $isFound;
    }

    public function fetchChatId() {
        return $this->chatId;
    }

    public function setUserStatus($userId, $status) {
        $this->changeStatusUser($userId, $status);
    }

    public function setChatStatus($chatId, $type) {
        $this->changeStatusChat($chatId, $type);
    }
}