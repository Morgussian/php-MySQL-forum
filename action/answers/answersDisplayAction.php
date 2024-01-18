<!-- Ce fichier gère l'affichage des réponses pour une question sélectionnée -->

<?php
require 'action/database.php';

$allAnswersSingleQuestion = $db->prepare('SELECT day, author_pseudo, author_id, answer FROM answers WHERE question_id = ? ORDER BY id DESC');
$allAnswersSingleQuestion->execute([$id]);