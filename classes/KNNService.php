<?php

class KNNService extends AllVacanciesModel {
    /**
     * Функція findBestVacancies – для заданого кандидата перебирає всі вакансії,
     * обчислює схожість та повертає топ k вакансій з найбільшою схожістю.
     */
    public function findBestVacancies(array $vacancies, array $candidate, int $k = 3) {
        $results = [];
        foreach($vacancies as $vacancy) {
            $sim = $this->overallSimilarity($vacancy, $candidate);
            $results[] = ['vacancy' => $vacancy, 'similarity' => $sim];
        }

        // Сортування за спаданням схожості
        usort($results, function($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        return array_slice($results, 0, $k);
    }

    /**
     * Функція textToVector – просте перетворення тексту у вектор (Bag-of-Words).
     * Текст приводиться до нижнього регістру, знаки пунктуації видаляються, а потім формується асоціативний масив,
     * де ключ – слово, значення – кількість входжень.
     */
    private function textToVector(string $text) {
        $text = strtolower($text);
        $text = preg_replace('/[^\w\s]/u', '', $text);
        $words = preg_split('/\s+/', $text);
        $vector = [];
        foreach($words as $word) {
            if (empty($word)) continue;
            if(isset($vector[$word])) {
                $vector[$word]++;
            } else {
                $vector[$word] = 1;
            }
        }
        return $vector;
    }

    /**
     * Функція cosineSimilarity – обчислення косинусної схожості між двома векторами.
     * Якщо хоча б один вектор має нульову норму, повертається 0.
     */
    private function cosineSimilarity(array $vec1, array $vec2) {
        $dotProduct = 0;
        $normA = 0;
        $normB = 0;

        foreach($vec1 as $key => $val) {
            $normA += $val * $val;
            if(isset($vec2[$key])) {
                $dotProduct += $val * $vec2[$key];
            }
        }
        foreach($vec2 as $val) {
            $normB += $val * $val;
        }

        if($normA == 0 || $normB == 0) {
            return 0;
        }

        return $dotProduct / (sqrt($normA) * sqrt($normB));
    }

    /**
     * Функція structuredSimilarity – обчислення схожості за структурованими полями.
     * Для рівня досвіду та англійської використовується нормалізована різниця (припускаємо, що рівні від 1 до 4),
     * для країни, категорії – просте порівняння (1 – збіг, 0 – різниця),
     * для зарплатного діапазону – чи попадає бажана ЗП в діапазон +-$500 ЗП вакансії.
     */
    private function structuredSimilarity(array $vacancy, array $candidate) {
        $score = 0;
        $total = 0;

        // Рівень досвіду (максимальна різниця, наприклад, 5, якщо рівні від 1 до 6)
        $maxExpDiff = 5;
        $score += 1 - (abs($vacancy['experience_id'] - $candidate['experience_id']) / $maxExpDiff);
        $total++;

        // Рівень англійської (максимальна різниця, наприклад, 3, якщо рівні від 1 до 4)
        $maxEngDiff = 3;
        $score += 1 - (abs($vacancy['english_id'] - $candidate['english_id']) / $maxEngDiff);
        $total++;

        // Країна
        if ($vacancy['country_id'] === $candidate['country_id']) {
            $score++;
        }
        $total++;

        // Категорія
        if ($vacancy['category_id'] === $candidate['category_id']) {
            $score++;
        }
        $total++;

        // Зарплата: чи попадає бажана ЗП в діапазон +-$500 ЗП вакансії
        if($candidate['salary'] <= ($vacancy['salary'] + 500) && $candidate['salary'] >= ($vacancy['salary'] - 500)) {
            $score += 1;
        } else {
            $score += 0;
        }
        $total++;

        return $score / $total;
    }

    /**
     * Функція overallSimilarity – обчислює загальну схожість як зважену суму
     * текстової схожості (опис вакансії + назва + навички vs. резюме + позиція + навички) та структурної схожості.
     * Параметри $weightText та $weightStruct дозволяють регулювати вагу кожного компоненту.
     */
    private function overallSimilarity(array $vacancy, array $candidate, float $weightText = 0.5, float $weightStruct = 0.5) {
        // Текстова схожість
        $vecVacancy = $this->textToVector($vacancy['vacancy_descr'] . ' ' . $vacancy['title'] . ' ' . $vacancy['skills']);
        $resumeContent = $this->readContentFromFile($candidate['resume_path']);
        $vecCandidate = $this->textToVector($resumeContent . ' ' . $candidate['position'] . ' ' . $candidate['skills']);
        $textSim = $this->cosineSimilarity($vecVacancy, $vecCandidate);

        // Структурована схожість
        $structSim = $this->structuredSimilarity($vacancy, $candidate);

        return $weightText * $textSim + $weightStruct * $structSim;
    }


    /**
     * Функція readContentFromFile - повертає вміст файлу як рядок (або null якщо шлях не встановлений)
     */
    private function readContentFromFile(string $filePath)
    {
        if (isset($filePath) && is_readable($filePath)) {
            // Зчитуємо файл в рядок
            $resumeContent = file_get_contents($filePath);
        
            if ($resumeContent === false) {
                // Обробка помилки зчитування
                throw new RuntimeException("Не вдалося прочитати файл за шляхом {$filePath}");
            }
        
            return $resumeContent;
        } else {
            return null;
        }
    }
}