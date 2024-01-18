<?php
    
    //securityAction.php redirigera l'user vers signup ou login si le user n'est pas authentifié
    require 'action/users/securityAction.php';
    require 'action/questions/allQuestionsAction.php';
    // require 'action/signupAction.php';
    
?>
<!DOCTYPE html>
<html lang="en">

<?php
    include 'includes/head.php';
      
?>
   
<body>
    <?php
    include 'includes/navbar.php'
    ?>
    <div class="container">
        <h1 class='text-center'>Questions du forum</h1>
        <!-- Formulaire de recherche -->
        <form method="GET">
            <div class="form-group row">
                <div class="col-4"></div>
                <!-- l'attribut "name" de cet input est la valeur qui sera ajoutée à l'URL dans la methode GET utilisée par ce form -->
                <div class="col-4">
                    <input type="search" name="search" class="form-control">
                </div>
                <div class="col-4">
                    <button class="btn btn-success" type="submit">
                        Rechercher
                    </button>
                </div>
            </div>
        </form>
        <br></br>
        <?php 
            if(isset($noResult)) echo $noResult;
            //chercher comment ça marche:
            while($question = $getAllQuestions->fetch()){
                //fermer la balise php pour ne plus mettre que du html entre les accolades
                ?>

                <!-- HTML -->

                <div class="card mb-3" style="width: 22rem;">
                    <a href="single_question.php?id=<?php echo $question['id'];?>" style="color: inherit; text-decoration: inherit;">
                        <div class="card-header">
                            <h5 class="card-title">
                                <?php echo $question['titre'];?>
                            </h5>
                        </div>
                    </a>
                    <div class="card-body">
                        
                        <p class="card-text">
                        <?= $question['question'];//<?= c'est comme <?php echo...?>
                        </p>

                        <!-- faire apparaître les boutons modifier et supprimer seulement si l'user est auteur de la question -->
                        <?php
                            if($question['pseudo_author'] == $_SESSION['pseudo']){
                                ?>
                                <a href="edit_question.php?id=<?php echo $question['id'];?>" class="btn btn-dark text-light text-decoration-none">Modifier la question</a>
                                <br><br />

                                <!-- Button trigger modal -->
                                <!-- le data bs target doit avoir un id unique à base de ID de chaque question, sans oublier le #... -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#alert<?php echo $question['id'];?>">
                                Supprimer
                                </button>
                                <br>
                                <?php
                            }
                        ?>                    
                        
                        
                    </div>
                    <div class="card-footer">
                        <p class="small">Publiée le 
                        <?= $question['date_publication'];//<?= c'est comme <?php echo...?>
                        par <a href="single_user.php?id=<?= $question['id_author']?>">
                        <?= $question['pseudo_author']?>
                        </a>
                        </p>
                    </div>
                </div>

                <!-- Modal avec ID évolutive sinon il supprime que la dernière entrée du array...-->
                <div class="modal fade" id="alert<?php echo $question['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Etes-vous sûr de vouloir supprimer <?php echo $question['titre'];?>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <a href="action/questions/deleteQuestionAction.php?id=<?php echo $question['id'];?>" type="button" class="btn btn-danger">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            
    <?php
            }    
    ?>
    <?php
        // echo '<p>'.$db.'</p>';
    ?>
    </div>
</body>
</html>