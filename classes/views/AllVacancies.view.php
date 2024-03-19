<?php

class AllVacanciesView extends AllVacanciesModel {
    
    public function getAllVacancies() {
        $vacanciesArray = $this->grabAllVacancies();
        var_dump($vacanciesArray);
    }

    public function getFilteredVacancies($vacancies) {
       var_dump($vacancies); 
    }  
}