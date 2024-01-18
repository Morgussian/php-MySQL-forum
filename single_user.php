<?php 

    require 'action/users/securityAction.php';
    require 'action/users/userDisplayAction.php';
    
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
<?php
    if(isset($errorMsg)){
        echo $errorMsg;
    }
    if(isset($userQuestions)){
        ?>
        <div class="container">
            <br><br>
            <div class="card">
                <div class="card-body">
                    <h1>
                        Questions posées par <?=$userPseudo?> :
                    </h1>
                    <?php
                    if($userId == $_SESSION['id']){
                        ?>
                        
                        <!-- Modal avec ID évolutive sinon il supprime que la dernière entrée du array...-->
                        <div class="modal fade" id="alert<?php echo $userId;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Suppression</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Etes-vous sûr de vouloir supprimer <?php echo $userPseudo;?>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        <a href="action/users/deleteUserAction.php?id=<?php echo $userId;?>" type="button" class="btn btn-danger">Supprimer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    
                </div>
            </div>
            <br>
            <?php
            //surtout pas oublier le fetch sinon $question est un objet PDO inutilisable...
            while($question = $userQuestions->fetch()){
                ?>
                <div class="card">
                    <a href="single_question.php?id=<?php echo $question['id'];?>" style="color: inherit; text-decoration: inherit;">
                        <div class="card-header">
                            <h2>
                                <?= $question['titre'];?>
                            </h2>
                        </div>
                    </a>
                    <div class="card-footer">
                        <p>Postée le <?= $question['date_publication'];?></p>
                    </div>
                </div>
                <br>
                <?php
            }
            ?>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#alert<?php echo $userId;?>">
            Supprimer mon compte
            </button>
        </div>
        <?php
    }
?>
</body>
</html>