<!-- Ce fichier sert à récupérer les data d'une unique question pour que son auteur la modifie. Il est utilisé par edit_question.php à la racine du projet -->
<?php
    require 'action/database.php';

    //$_GET c'est récupérer une data depuis l'URL: un "?id=" doit être présent ET "id" ne doit pas être vide
    if(isset($_GET['id']) && !empty($_GET['id'])){

        $questionId = $_GET['id'];

        //récupérer l'ensemble des data de la question.
        $questionCheck = $db->prepare('SELECT * FROM questions WHERE id = :questionId');
        $questionCheck->execute(array('questionId' => $questionId));

        //si questionCheck possède plus de 0 rang
        if($questionCheck->rowCount() > 0){

            //stocker les infos de la question dans un array
            $questionInfo = $questionCheck->fetch();

            //si l'author de la question a le même id que la session courante:
            if($questionInfo['id_author'] == $_SESSION['id']){

                //stocker le titre
                $title = $questionInfo['titre'];

                //stocker la question: str_replace() permet de remplacer des caractères par d'autres. 
                //On veut éliminer les balises <br /> insérées par "nl2br" dans publishQuestionAction.php
                $question = str_replace('<br />', '', $questionInfo['question']);

                //la dernière variable stockée va servir de validation pour l'affichage du form dans edit_question.php
                //...puisque si elle est valide toutes les précédentes sont valides
                $date = $questionInfo['date_publication'];

            }else{
                $errorMsg = 'Vous ne pouvez pas modifier la question de quelqu\'un d\'autre';
            }

        }else{
        $errorMsg = 'Aucune question trouvée';
    }

    }else{
        $errorMsg = 'Aucune question trouvée';
    }