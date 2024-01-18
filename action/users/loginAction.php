<!-- ce fichier traite le form envoyé par login.php -->

<?php
    session_start();
    //path corrspondant au path qu'on aura dans le fichier login.php et pas en partant de celui-ci loginAction...C'est tordu!
    require 'action/database.php';

    //validation formulaire
if(isset($_POST['submit'])){

    //si les variables ne sont PAS vides. attention $_POST prend des crochets []
    if(!empty($_POST['email']) && !empty($_POST['password'])){

        //htmlspecialchars pour éviter l'injection de code malveillant
        // On met en variable ce qu'a tapé le user
        $user_email = htmlspecialchars($_POST['email']);

        // On met en variable ce qu'a tapé le user
        $user_password = htmlspecialchars($_POST['password']);

        //tentative de array associatif avec une key 'email' à la place du "?" comme dans signupAction.php. ça a l'air de fonctionner...
        $isUserInDb = $db->prepare('SELECT * FROM users WHERE email = :email');
        $isUserInDb->execute(array('email' => $user_email));

        //si la réponse du dernier execute contient plus de zero rang
        if($isUserInDb->rowCount() > 0){

            //cette variable stocke toutes les infos de cet user
            $userInfo = $isUserInDb->fetch();

            //verifier le password
            if(password_verify($user_password, $userInfo['password'])){

                //user authentifié, déclaration de variables globales de session
                //variables qui serviront à la session?
                //authentifier l'user sur le site et récupérer ses data dans des variables globales $_SESSION
                //rappel: session_start() est appelé dans database.php qui est require ici...Mais je sais toujours pas à quoi ça sert
                $_SESSION['auth'] = true;
                $_SESSION['id'] = $userInfo['id'];
                $_SESSION['email'] = $userInfo['email'];
                $_SESSION['pseudo'] = $userInfo['pseudo'];

                //ça ça redirige vers une autre page...
                header('location: index.php');
            }else {
                $errorMsg = 'Oooops Mot de passe incorrect!'; 
            }
        }else{
            $errorMsg = 'Cet utilisateur n\'a pas de compte!'; 
        }
    }else{
        $errorMsg = 'Tous les champs ne sont pas remplis!';
    }
}
?>