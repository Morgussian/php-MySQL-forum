<?php
require 'action/database.php';

//si le form est soumis
if(isset($_POST['submit'])){

    //si les champs ne sont pas vides
    if(!empty($_POST['title']) && !empty($_POST['question'])){
        
        //stocker les data pour une question: title, question, id de l'auteur, email de l'auteur, date de publication
        $title = htmlspecialchars($_POST['title']);

        //nl2br permet de respecter les sauts de ligne de la rédaction
        $question = nl2br(htmlspecialchars($_POST['question']));
        $id_author = $_SESSION['id'];
        $email_author = $_SESSION['email'];
        $pseudo_author = $_SESSION['pseudo'];
        $question_date = date('d m Y');

        //bon super chelou d'envoyer ça comme ça mais ça marche.
        $sendToDb = $db->prepare('INSERT INTO questions (titre, question, id_author, email_author, date_publication, pseudo_author)
         VALUES(:titre, :question, :id_author, :email_author, :date_publication, :pseudo_author)');
         //interessant d'utiliser un tableau associatif plutot qu'un tas de "?" dans la préparation. du coup on a pas besoin de respecter l'ordre des VALUES
        $sendToDb->execute([
            'question' => $question,
            'titre' => $title,
            'id_author' => $id_author,
            'email_author' => $email_author,
            'date_publication' => $question_date,
            'pseudo_author' => $pseudo_author

        ]);
        $successMsg = 'Question envoyée.';

    }else{
        $errorMsg = 'Veuillez compléter les champs';
    }
}