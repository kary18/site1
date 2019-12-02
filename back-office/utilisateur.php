<?php

//recuperation des données
$mailu = $_POST ['mail'];
$mdpu = $_POST ['password'];
 //cryptage mdp
 $grain="8h!PwDeR#@2";
$mdpcrypte = sha1 (sha1 ($mdpu).$grain);

//paramettre BDD
$servername = 'localhost';
$dbname = 'ecom'; //nom de bdd
$user = 'root'; // utilisateur de la bdd 
$pass = ''; // mot de passe (vide)

try{
    echo 'connexion bdd <br/>';
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname",$user,$pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//requete sql
    foreach ($bdd->query('SELECT nomu, prenomu FROM utilisateur WHERE mailu="' . $mailu.'" AND mdpu="' .$mdpcrypte.'" ') as $row)
    {
        $nomu = $row[0];
        $prenomu = $row[1];
    }
    echo 'Bonjour '.$prenomu.' '.$nomu;
  

$bdd = null; 

header('location:accueil.html');
}

    catch(PDOException $erreur){
        echo $erreur.' -- '.$erreur->getMessage();            
}