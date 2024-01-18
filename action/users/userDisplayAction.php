<?php

require 'action/database.php';

//id du user normalement passé en URL
if(isset($_GET['id']) && !empty($_GET['id'])){

    $userId = $_GET['id'];

    //requèter la table users pour avoir les infos d'un user
    $isUserInDb = $db->prepare('SELECT * FROM users WHERE id = :user_id');
    $isUserInDb->execute(['user_id' => $userId]);
    //l'user existe?
    if($isUserInDb->rowCount() > 0){

        $userData = $isUserInDb->fetch();
        $userPseudo = $userData['pseudo'];

        //requèter la table questions pour avoir les questions du user susnommé
        $userQuestions = $db->prepare('SELECT id, titre, date_publication FROM questions WHERE id_author = :userId ORDER BY id DESC');
        $userQuestions->execute(['userId' => $userId]);

        if($userQuestions->rowCount() == 0){
            $errorMsg = 'Cet utilisateur n\'a pas encore posé de question';
        }


    }else{
        $errorMsg = 'Aucun utilisateur trouvé.';
    }

}else{
    $errorMsg = 'Aucun utilisateur trouvé.';
}