<?php


// SECTION EXERCISE - QUERY WITH SELECT // 

// 1. Selezionare tutti gli studenti nati nel 1990
SELECT * FROM `students`
WHERE YEAR (`date_of_birth`) = 1990;

// 2. Selezionare tutti i corsi che valgono più di 10 crediti
SELECT * FROM `courses`
WHERE `cfu` > 10
ORDER BY `cfu` ASC;

// 3. Selezionare tutti gli studenti che hanno più di 30 anni
SELECT * FROM `students`
WHERE TIMESTAMPDIFF(YEAR, `date_of_birth`, CURDATE()) > 30;

// 4. Selezionare tutti i corsi del primo semestre del primo anno di un qualsiasi corso di laurea 
SELECT * FROM `courses` 
WHERE `year` = 1 AND `period` = 'I semestre';

// 5. Selezionare tutti gli appelli d'esame che avvengono nel pomeriggio (dopo le 14) del 20/06/2020
SELECT * FROM `exams`
WHERE HOUR(`hour`) >= 14 AND `date` = "2020-06-20";

// 6. Selezionare tutti i corsi di laurea magistrale
SELECT * FROM `degrees`
WHERE `level` = 'magistrale';

// 7. Da quanti dipartimenti è composta l'università?
SELECT COUNT(*)
AS `total_dipartimenti`
FROM `departments`;

// 8. Quanti sono gli insegnanti che non hanno un numero di telefono?
SELECT COUNT(`phone`)
AS `insegnanti_senza_telefono`
FROM `teachers`;

// SECTION EXERCISE - QUERY WITH SELECT // 


// SECTION EXERCISE - QUERY WITH GROUP BY // 

// 1. Contare quanti iscritti ci sono stati ogni anno
SELECT YEAR(`enrolment_date`) AS anno_universitario, COUNT(*) AS numero_iscrizioni
FROM `students`
GROUP BY YEAR(`enrolment_date`);

// 2. Contare gli insegnanti che hanno l'ufficio nello stesso edificio

SELECT `office_address` AS indirizzo_ufficio, COUNT(*) AS numero_insegnanti
FROM `teachers`
GROUP BY `office_address`
HAVING `numero_insegnanti` > 1;

// 3. Calcolare la media dei voti di ogni appello d'esame
SELECT `exam_id` AS appello_esame, ROUND(AVG(`vote`)) AS media_voto
FROM `exam_student`
GROUP BY `appello_esame`;


// 4. Contare quanti corsi di laurea ci sono per ogni dipartimento
SELECT `department_id` AS numero_dipartimento, COUNT(*) AS numero_corsi
FROM `degrees`
GROUP BY `numero_dipartimento`;

// SECTION EXERCISE - QUERY WITH GROUP BY // 

?>

