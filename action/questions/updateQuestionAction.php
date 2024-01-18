<!-- updateQuestionAction.php va mettre à jour la DB après modification d'une question dans edit_question.php à la racine-->

<?php

    //rappel: ce fichier sera appelé par edit_question.php qui est à la racine du projet. Le path est donné en fonction de edit_question.php
    require 'action/database.php';

    //POST : méthode du formulaire. 'submit' : name du bouton de soumission dans edit_question.php.
    if(isset($_POST['submit'])){

        //si les champs ne sont pas vides
        if(!empty($_POST['title']) AND !empty($_POST['question'])){
            
            //stocker les data pour une question: title, question, id de l'auteur, email de l'auteur, date de publication
            $updatedTitle = htmlspecialchars($_POST['title']);

            //nl2br permet de respecter les sauts de ligne de la rédaction
            $updatedQuestion = nl2br(htmlspecialchars($_POST['question']));

            //modifier la db à l'aide de la $questionId, variable disponible dans le fichier getSingleQuestionDataAction.php
            $updateInfos = $db->prepare('UPDATE questions SET titre = :titre, question = :question WHERE id = :questionId');
            $updateInfos->execute(array(
                'titre' => $updatedTitle,
                'question' => $updatedQuestion,
                'questionId' => $questionId

            ));

            header('location: single_user_questions.php');

        }else{
            $errorMsg = 'Veuillez compléter les champs';
        }
    }
?>