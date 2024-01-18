<?php
    require 'action/users/securityAction.php';
    //requiert un fichier d'action qui ramène toutes les data d'une unique question à l'aide de son ID
    require 'action/questions/getSingleQuestionDataAction.php';
    //updateQuestioAction.php va mettre à jour la DB après modification
    require 'action/questions/updateQuestionAction.php';
    
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
    <h1 class='text-center'>Modifiez votre question</h1>
    <br><br>

    <div class='container'>
        <!--If errorMsg variable exists, there's an error, display it.-->
        <?php 
            if(isset($errorMsg)){
                echo '<p>'.$errorMsg.'</p>';
            }
        ?>
        <?php
            //la variable $date définie dans getSingleQuestionDataAction.php sert de validation pour l'affichage de la question.
            //...Pour que l'user puisse poser plusieurs fois la même question???
            if(isset($date)){
        //fermer la balise pour placer du HTML  
        ?>
                <form method='POST' class='col-5'>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nouveau titre pour votre question</label>
                        <input type="text" class="form-control" name='title' value="<?php echo $title ?>">                        
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nouvelle question</label>
                        <textarea type="textarea" class="form-control" name='question'><?php echo $question; ?>
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name='submit'>Modifier</button>
                    <!-- test pour voir la variable $questionId déclarée dans getSingleQuestionDataAction.php -->
                    <p class="small" hidden="true">Question n<?=$questionId?></p>
                    <br></br>
                    
                </form>
            <!-- rouvrir la balise pour fermer l'accolade -->
            <?php    
            }
        ?>
            
    </div>
</body>
</html>