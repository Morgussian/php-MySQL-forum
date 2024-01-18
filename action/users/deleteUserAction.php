<!-- Suppression d'un user -->

<?php

session_start();
if(!$_SESSION['auth']) header('location: ../../login.php');
require '../database.php';

if(isset($_GET['id']) && !empty($_GET['id'])){

    //stocker l'id du user
    $id = $_GET['id'];    

     //d'abord verifier si le user existe dans la db
     $idCheck = $db->prepare('SELECT id FROM users WHERE id = :id');
     $idCheck->execute(array('id' => $id));

     //si le nombre d'occurences trouvé est superieur à zero
     if($idCheck->rowCount() > 0){
        $userData = $idCheck->fetch();

        //si l'id de l'author correspond à l'id du user
        if($userData['id'] == $_SESSION['id']){

            //supprimer le user
            $suppressUser = $db->prepare('DELETE FROM users WHERE id = :id');
            $suppressUser->execute(array('id' => $id));

            //suppimer ses questions
            $suppressUserQuestions = $db->prepare('DELETE FROM questions WHERE id_author = :id_author');
            $suppressUserQuestions->execute(['id_author' => $id]);

            //il faudrait supprimer aussi les réponses...
            
            header('location: logoutAction.php');
        }else{
            echo 'Vous ne pouvez pas supprimer un autre utilisateur </br>';
            
        }
    }else{
        
        echo 'Vous ne pouvez pas supprimer un autre utilisateur </br>';
    }


}