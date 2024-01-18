<?php 
    require 'action/database.php';

    //ORDER by id DESC == ordre antéchronologique d'affichage
    //d'où l'importance de créer un id autoincrémenté pour chaque question...
    $getAllQuestions = $db->prepare('SELECT id, titre, question, date_publication FROM questions WHERE id_author = :author ORDER BY id DESC');
    $getAllQuestions->execute(array('author' => $_SESSION['id']));