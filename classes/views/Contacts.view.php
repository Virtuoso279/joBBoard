<?php

class ContactsView extends ContactsModel{
    public function getFullName($userId, $userType) {
        $profileInfo = $this->getUser($userId, $userType);
        echo $profileInfo[0]["full_name"];
    }

    public function getEmail($userId, $userType) {
        $profileInfo = $this->getUser($userId, $userType);
        echo $profileInfo[0]["email"];
    }

    public function getPhone($userId, $userType) {
        $profileInfo = $this->getContacts($userId, $userType);
        echo $profileInfo[0]["phone"];
    }

    public function getTelegram($userId, $userType) {
        $profileInfo = $this->getContacts($userId, $userType);
        echo $profileInfo[0]["telegram"];
    }

    public function getLinkedIn($userId, $userType) {
        $profileInfo = $this->getContacts($userId, $userType);
        echo $profileInfo[0]["linkedIn"];
    }

    public function getLinks($userId, $userType) {
        $profileInfo = $this->getContacts($userId, $userType);
        echo $profileInfo[0]["links"];
    }

    public function getAboutMe($userId, $userType) {
        $profileInfo = $this->getContacts($userId, $userType);
        echo $profileInfo[0]["about_me"];
    }    

    public function checkContactsErrors() {
        if (isset($_SESSION["errors_contacts"])) {
            $errors = $_SESSION["errors_contacts"];
    
            foreach ($errors as $error) {
                echo '<p class="form-error">' . $error . '</p>';
            }
    
            unset($_SESSION["errors_contacts"]);
        }
    }
}