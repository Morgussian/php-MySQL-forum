<!-- publier une réponse dans single_question.php à la racine du projet -->

<?php
require 'action/database.php';

if(isset($_POST['submitAnswer'])){
    
    if(!empty($_POST['postAnswer'])){
    // nl2br: permet de stocker les sauts de lignes dans la db
    //htmlspecialchars empèche les injections de code
    
    $answer = nl2br(htmlspecialchars($_POST['postAnswer']));
    
    $date = date('d m Y');
    
    $insertAnswer = $db->prepare('INSERT INTO answers(question_id, day, author_pseudo, author_id, answer) VALUES(:question_id, :day, :author_pseudo, :author_id, :answer)');
    $insertAnswer->execute([
        //$id a été déclaré dans questions/singleQuestionAction.php qui est require dans singleQuestion.php
        'question_id' => $id,
        //attention lors de la création de la db mySql: Ne pas choisir "date" comme format...Cette variable présente du TEXT format. sinon db armoire.
        'day' => $date,
        'author_pseudo' => $_SESSION['pseudo'],
        'author_id' => $_SESSION['id'],
        'answer' => $answer
    ]);
    
    //envoyer une variable dans un header: concaténation
    // obligé de rediriger l'user sur une autre page sans quoi $_POST['submitAnswer'] et $_POST['postAnswer'] conservent la data 
    // et repostent le dernier message quand on refresh...
    //l'user est envoyé sur thx.php mais avec l'$id de la question dans l'url
    header('location: thx.php?id='.$id);
    
}else{
    echo 'réponse non postée';
}
}
