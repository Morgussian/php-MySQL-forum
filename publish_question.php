<?php
    require 'action/users/securityAction.php';
    require 'action/questions/publishQuestionAction.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<?php
include ('includes/head.php');
?>
<body>
    <?php
    include 'includes/navbar.php';
    ?>
    <h1 class='text-center'>Une question?</h1>
    <br><br>
    <div class='container'>
        <!--If errorMsg variable exists, there's an error, display it.-->
        <?php 
            if(isset($errorMsg)){
                echo '<p>'.$errorMsg.'</p>';
            }elseif(isset($successMsg)){
                echo '<p>'.$successMsg.'</p>';
            }
        ?>
            <form method='POST' class='col-5'>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Titre pour votre question</label>
                    <input type="text" class="form-control" name='title' id="exampleInputEmail1" aria-describedby="emailHelp">
                    
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Question</label>
                    <textarea type="textarea" class="form-control" name='question' id="exampleInputPassword1"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name='submit'>Envoyer</button>
                <br></br>
                
            </form>
    </div>
</body>
</html>