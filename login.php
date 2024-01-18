<?php require ('action/users/loginAction.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php
include ('includes/head.php');
?>
<body>
    <h1 class='text-center'>Connexion</h1>
    <br><br>
        <div class='container'>
            <!--If errorMsg variable exists, there's an error, display it.-->
            <?php 
                if(isset($errorMsg)){echo '<p>'.$errorMsg.'</p>';}
                if(isset($createdUserMsg)){print_r($createdUserMsg);}
            ?>
                <form method='POST' class='col-5'>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name='email' id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name='password' id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary" name='submit'>Connexion</button>
                    <br></br>
                    <a href='signup.php'><p>Pas encore inscrit?</p></a>
                </form>
        </div>
</body>
</html>