<!-- ce fichier permet d'afficher une unique question dpuis l'index.php 
Il contient aussi un form pour répondre à une question-->
<?php
    
    //securityAction.php redirigera l'user vers signup ou login si le user n'est pas authentifié
    require 'action/users/securityAction.php';
    require 'action/questions/singleQuestionAction.php';
    
    require 'action/answers/postAnswerAction.php';
    require 'action/answers/answersDisplayAction.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php
    include 'includes/head.php';
?>
<body>
    <?php
        include 'includes/navbar.php';
    ?>
    <div class="container">
        <section class="question">
            <h1>
                <?php 
                if(isset($errorMsg)){
                    echo $errorMsg;
                }else{
                    echo $title;
                ?>
            </h1>
            <hr>
            <!-- display de la question -->
            <div>
                <p>
                    <?= $question;?>
                </p>
                <hr>
                <p class="small">
                    Posée le <?= $date;?> par <?= $authorPseudo;?>
                </p> 
            </div>
        </section>

        
        <!-- display des réponses -->
        <section>
            <?php
                while($answerData = $allAnswersSingleQuestion->fetch()){
                    //injection de HTML
                    ?>
                        <div class="card mb-3 ml-5" style="width: 25rem;">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Réponse de 
                                    <a href="single_user.php?id=<?= $answerData['author_id'];?>">
                                    <?php echo $answerData['author_pseudo'];?>
                                    </a>
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <?= $answerData['answer'];//<?= c'est comme <?php echo...?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <p class="small">Publiée le 
                                    <?= $answerData['day'];//<?= c'est comme <?php echo...?>
                                </p>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </section>
        
        <!-- form de réponse -->
        
        <section>
            <form method="POST" class="form-group">
                <div class="form-floating">
                    <textarea class="form-control" id="floatingTextarea" style="height: 100px" name="postAnswer"></textarea>
                    <label for="floatingTextarea">Votre réponse</label>
                </div>
                <br>
                <a>
                <button type="submit" class="btn btn-primary" name="submitAnswer">Soumettre</button>
                </a>
                

            </form>
        </section>
        

            <?php
                
                
            }
            ?>
        
    </div>
</body>
</html>