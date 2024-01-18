<!-- ce fichier sert à rediriger l'user quand il arrive sur index.php alors qu'il n'est pas authentifié -->

<?php
    // $session_start est une variable globale. En la mettant ici elle se retrouve dans tous les fichiers qui vont include ou require securityAction.php...
    // envoie un header avec un genre de clé stockée dans un cookie PHPSESSID. la clé va identifier l'user dans les pages visitées. S'il ferme le navigateur la session est détruite
    // est ce que c'est ça qui permet de stocker les variables $_SESSION['quelque-chose']?
    // Si un affichage est généré avant, il y aura une erreur.
    session_start();
if(!isset($_SESSION['auth'])){
    // rappel: securityAction.php sera require dans index, le chemin vers login est donc dans le même dossier
    header('location: login.php');
    }
?>
