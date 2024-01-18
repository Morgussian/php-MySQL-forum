<!-- fichier destiné à être inclus dans signup.php qui lui ne gère que de l'affichage -->

<?php

//je sais pas trop pourquoi on met ça là...
session_start();

// on pourrait mettre 'include' mais alors le reste du code va chercher à s'exécuter. Avec 'require' la page plante si l'appel du fichier foire
// on met un chemin comme si on venait de signup.php qui est dans le dossier racine (database est dans le même dossier que signupaction!...)
require 'action/database.php';

//validation formulaire
if(isset($_POST['submit'])){

    //si les variables ne sont PAS vides. attention $_POST prend des crochets []
    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['pseudo'])){

        //htmlspecialchars pour éviter l'injection de code malveillant
        // On met en variable ce qu'a tapé le user
        $user_pseudo = htmlspecialchars($_POST['pseudo']);

        // On met en variable ce qu'a tapé le user
        $user_email = htmlspecialchars($_POST['email']);

        //un password se hash avec password_hash. La methode prend un 2e parametre: l'algorythme de hash.
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        //prepare une requete pour voir si la db contien déjà l'email. Methode PDO statement?
        // pseudo = ? signifie que le pseudo n'est pas encore fourni.
        //il est aussi possible d'employer des ARGUMENTS NOMMES, ici :email et il faudra fournir à execute un tableau associatif avec [:email => $userEmail]
        //securite= l'injection de code genre '; OR 1=1' ou '; --' pour hacker toutes les data du table ne peut pas marcher
        $pseudoAlreadyExists = $db->prepare('SELECT email AND pseudo FROM users WHERE pseudo = ?');

        //envoie la requète préparée en créant un array avec la ou les valeurs qui remplaceront le "= ?"
        $pseudoAlreadyExists->execute(array($user_pseudo));

        // si le nombre de lignes obtenues avec le dernier "execute statement" est nul. Ca veut dire que cet email n'existe pas dans la db, on peut 
        // inscrire le user. Comme on prefere gérer l'erreur en deuxième (else, bonne pratique?) on met pas > 0...
        if($pseudoAlreadyExists->rowCount() == 0){

            //pourquoi password est en bleu? normalement seules les commandes sont en bleu...Values c'est le nombre de champs à envoyer à la db
            $insertNewUser = $db->prepare('INSERT INTO users(email, password, pseudo) VALUES(?,?,?)');

            //envoie la requète préparée en créant un array avec les valeurs qui remplaceront les "?"
            //c'est ça ou faire juste avant des bindValue() pour les items du array
            $insertNewUser->execute(array($user_email, $user_password, $user_pseudo));

            //preparer une requete pour obtenir l'id du user pour cette session.
            $user_id = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
            $user_id->execute(array($user_pseudo));

            //"fetch ça fait un array...Mais user_Id c'en est déjà un qui sert à rien...Non, $user_id est un objet PDO.
            $userInfo = $user_id->fetch();

            //supervariables globales qui serviront à la session?
            //authentifier l'user sur le site et récupérer ses data dans des variables globales $_SESSION
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $userInfo['id'];
            $_SESSION['email'] = $userInfo['email'];
            //pseudo ça marche pas
            $_SESSION['pseudo'] = $userInfo['pseudo'];

            //ça ça redirige vers une autre page...
            header('location: index.php');
            $createdUserMsg = 'Nouvel utilisateur créé.';


        }else{
            $errorMsg = 'Cet utilisateur existe déjà. ';
        }


    }else{
        $errorMsg = 'Tous les champs ne sont pas remplis!';
    }
}