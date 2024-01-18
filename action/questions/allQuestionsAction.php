<!-- récupérer toutes les questions de tous les users -->
<!-- sert à display les questions dans index.php -->

<?php
    require 'action/database.php';
    
    //récupérer absolument tout
    $getAllQuestions = $db->query('SELECT * FROM questions ORDER BY id DESC');

    //une recherche a-t-elle été soumise?
    if(isset($_GET['search']) && !empty($_GET['search'])){

        $search = $_GET['search'];
        //Modifier la variable avec une nouvelle requête. "LIKE" va comparer tous les titres avec la recherche
        // "%" signifie peu importe ce qu'il y a avant (ou après)
        $getAllQuestions = $db->query('SELECT * FROM questions WHERE titre LIKE "%'.$search.'%" ORDER BY id DESC');

        //si aucun titre ne match
        if($getAllQuestions->rowCount() == 0){
            //chercher dans le corps des questions
            $getAllQuestions = $db->query('SELECT * FROM questions WHERE question LIKE "%'.$search.'%" ORDER BY id DESC');
        }
        //si toujours rien trouvé
        if($getAllQuestions->rowCount() == 0) $noResult = 'Aucun résultat';

    }
        


    

