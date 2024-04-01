<?php

class AllChatsContr extends AllChatsModel{
    private $vacancy; 
    private $type1;
    private $type2;   

    public function __construct($vacancy, $type1, $type2) {
        $this->vacancy = $vacancy;
        $this->type1 = $type1;
        $this->type2 = $type2;
    }

    public function getChatsListCandidate() {

        $count = 0;

        session_start();
        if (isset($_SESSION["user_id"])) {
            $candidateId = $_SESSION["user_id"];
        } else {
            header("Location: ../index.php?error=invalid_userid");
            exit();
        }

        $query = "SELECT *, conversations.id FROM conversations, vacancies WHERE candidate_id = " . $candidateId; 
        
        if ($this->type1 === null) {
            $query = $query . " AND not_aproach_cand = false AND not_aproach_vac = false";
            $count++;
        }

        if ($this->type2 === "inactive") {
            $count++;
        } else {
            $query = $query . " AND vacancies.vacancy_status != 'inactive'";
        }

        if ($count === 0) {
            header("Location: ../pages/all_chats.php?error=emptyfilters");
            exit();
        } else {
            $result =  $this->grabFilteredChats($query);
            if ($result !== "Empty search!") {
                $_SESSION["chats"] = $result;
            } else {
                $_SESSION["chats"] = "Not found chats";
            }
        }        
    }

    public function getChatsListRecruiter() {

        $count = 0;

        if (isset($_SESSION["user_id"])) {
            $recruiterId = $_SESSION["user_id"];
        } else {
            header("Location: ../index.php?error=invalid_userid");
            exit();
        }

        $query = "SELECT *, conversations.id FROM conversations, vacancies WHERE conversations.recruiter_id = " . $recruiterId; 

        if ($this->vacancy !== null) {
            $this->vacancy = $this->fetchVacancyId($this->vacancy);
            $query = $query . " AND vacancy_id = " . $this->vacancy;
            $count++;
        }
        
        if ($this->type1 === null) {
            $query = $query . " AND not_aproach_cand = false AND not_aproach_vac = false";
            $count++;
        }

        if ($this->type2 === "inactive") {
            $count++;
        } else {
            $query = $query . " AND vacancies.vacancy_status != 'inactive'";
        }

        if ($count === 0) {
            header("Location: ../pages/all_chats.php?error=emptyfilters");
            exit();
        } else {
            $result =  $this->grabFilteredChats($query);
            if ($result !== "Empty search!") {
                $_SESSION["chats"] = $result;
            } else {
                $_SESSION["chats"] = "Not found chats";
            }
        }                
    }

    private function fetchVacancyId($vacancy) {
        $vacancyId = $this->getVacancyId($vacancy);
        return $vacancyId[0]["id"];
    }           
}