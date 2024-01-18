<!-- Ce fichier gère les données d'une question pour la display dans single_question.php à la racine -->

<?php

require 'action/database.php';
    
//check si un id de question est passé dans l'url
if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = $_GET['id'];

    //check si la question est bien dans la db
    $isQuestionInDb = $db->prepare('SELECT * FROM questions WHERE id = ?');
    $isQuestionInDb->execute([$id]);

    if($isQuestionInDb->rowCount() > 0){

        $questionInfo = $isQuestionInDb->fetch();
        //stocker les infos de la question à display
        $title = $questionInfo['titre'];
        $question = $questionInfo['question'];
        $authorPseudo = $questionInfo['pseudo_author'];
        $date = $questionInfo['date_publication'];

    }else{
        $errorMsg = 'Aucune question trouvée!';
    }
}else{
    $errorMsg = 'Aucune question trouvée!';
}

