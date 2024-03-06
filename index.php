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

// SECTION EXERCISE - QUERY CON JOIN //

// 1. Selezionare tutti gli studenti iscritti al Corso di Laurea in Economia
SELECT `students`.`id`, `students`.`name`, `students`.`surname`, `students`.`degree_id`, `degrees`.`name`
FROM `students`
JOIN `degrees`
ON `degrees`.`id` = `students`.`degree_id`
WHERE `degrees`.`name` = 'Corso di Laurea in Economia';

// 2. Selezionare tutti i Corsi di Laurea Magistrale del Dipartimento di Neuroscienze
SELECT * FROM `degrees`
JOIN `departments` 
ON `departments`.`id`=`degrees`.`department_id`
WHERE `departments`.`name`= 'Dipartimento di Neuroscienze';

// 3. Selezionare tutti i corsi in cui insegna Fulvio Amato
SELECT `teachers`.`id`, `teachers`.`name`, `teachers`.`surname`, `degrees`.`name` 
FROM `teachers`
JOIN `course_teacher`
ON `teachers`.`id`= `course_teacher`.`teacher_id`
JOIN `courses`
ON `courses`.`id` = `course_teacher`.`course_id`
JOIN `degrees`
ON `degrees`.`id` = `courses`.`degree_id`
WHERE `teachers`. `name` = 'Fulvio'
AND `teachers`.`surname`= 'Amato';

// 4. Selezionare tutti gli studenti con i dati relativi al corso di laurea a cui sono iscritti e il relativo dipartimento, in ordine alfabetico per cognome e nome
SELECT `students`.`surname` AS cognome, `students`.`name` AS nome, `degrees`.`name` AS corso, `departments`.`name`
FROM `students`
JOIN `degrees` 
ON `students`.`degree_id`=`degrees`.`id`
JOIN `departments`
ON `degrees`.`department_id`=`departments`.`id`
ORDER BY cognome, nome;

// 5. Selezionare tutti i corsi di laurea con i relativi corsi e insegnanti
SELECT `degrees`.`name` AS corso_laurea, `courses`.`name` AS nome_corso, `teachers`.`name` AS nome_insegnante, `teachers`.`surname` AS cognome_insegnante
FROM `degrees`
JOIN `courses` 
ON `degrees`.`id`=`courses`.`degree_id`
JOIN `course_teacher` 
ON `course_teacher`.`course_id` = `courses`.`id`
JOIN `teachers` 
ON `teachers`.`id` = `course_teacher`.`teacher_id`
ORDER BY corso_laurea;

// 6. Selezionare tutti i docenti che insegnano nel Dipartimento di Matematica
SELECT DISTINCT `teachers`.`name` AS nome, `teachers`.`surname` AS cognome, `departments`.`name` AS dipartimento 
FROM `teachers`
JOIN `course_teacher` 
ON `teachers`.`id` = `course_teacher`.`teacher_id`
JOIN `courses` 
ON `course_teacher`.`course_id` = `courses`.`id`
JOIN `degrees` 
ON `courses`.`degree_id`=`degrees`.`id`
JOIN `departments` 
ON `degrees`.`department_id`=`departments`.`id`
WHERE `departments`.`name`= 'Dipartimento di Matematica';

// 7. BONUS: Selezionare per ogni studente il numero di tentativi sostenuti per ogni esame, stampando anche il voto massimo. Successivamente, filtrare i tentativi con voto minimo 18
SELECT `students`.`name`, `students`.`surname`, `courses`.`name` AS 'nome_corso', COUNT(`exam_student`.`vote`) AS 'numero_tentativi', MAX(`exam_student`.`vote`) AS `voto_massimo` 
FROM `students` 
JOIN `exam_student` 
ON `exam_student`.`student_id`=`students`.`id` 
JOIN `exams` 
ON `exam_student`.`exam_id`=`exams`.`id` 
JOIN `courses` 
ON `courses`.`id`=`exams`.`course_id` 
GROUP BY `students`.`id`, `courses`.`id` 
HAVING `voto_massimo` >= 18;

// SECTION EXERCISE - QUERY CON JOIN //

?>

