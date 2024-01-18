<!-- suppression d'une question -->

<?php
session_start();
if(!$_SESSION['auth']) header('location: ../../login.php');


    require '../database.php';

    //deux "else" utilisent le même message d'erreur => variable
    $errorMsg = 'Question introuvable </br>';
    //lien pour retourner à l'index car ce fichier sera display sans navbar
    $indexLink = '<a href="../../index.php">Retour à l\'accueil</a> <?php';

    if(isset($_GET['id']) && !empty($_GET['id'])){
        
        //stocker l'id de la question
        $id = $_GET['id'];

        //d'abord verifier si la question (post) existe dans la db
        $idCheck = $db->prepare('SELECT id_author FROM questions WHERE id = :id');
        $idCheck->execute(array('id' => $id));

        //si le nombre d'occurences trouvé est superieur à zero
        if($idCheck->rowCount() > 0){
            $questionData = $idCheck->fetch();

            //si l'id de l'author correspond à l'id du user
            if($questionData['id_author'] == $_SESSION['id']){

                $suppress = $db->prepare('DELETE FROM questions WHERE id = :id');
                $suppress->execute(array('id' => $id));
                
                header('location: ../../single_user_questions.php');
            }else{
                echo 'Vous ne pouvez pas supprimer la question de quelqu\'un d\'autre </br>', $indexLink;
                
            }
        }else{
            
            echo $errorMsg, $indexLink;
        }

    }else{
        
        echo $errorMsg, $indexLink;
    }
?>