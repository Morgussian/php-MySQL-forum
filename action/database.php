<!-- Ce fichier va intégrer une database appliquée avec phpMyAdmin -->

<?php


//try catch permet de renseigner si la connexion a foiré
try{
    //PDO est une class qui permet de communiquer avec mySql
    //1er param: adresse du host, port, nom de la database, charset pour les caractères utilisés pour communiquer
    //2e param: nom d'user
    //3e param: password pour le host
    $db = new PDO('mysql:host=localhost;port=3308;dbname=tuto_frenchcoder;charset=utf8;', 'root', 'root');
} catch(Exception $e){

    //getMessage() est une methode pour afficher le message d'erreur de php
    die('Erreur de connexion à tuto_frenchcoder '.$e -> getMessage());
}


