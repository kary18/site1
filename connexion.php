<?php
//recuperation des données
$mail = $_POST ['mail'];
$mdp = $_POST ['password'];
 //cryptage mdp
 $grain="8h!PwDeR#@2";
$mdpcrypte = sha1 (sha1 ($mdp).$grain);

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
    foreach ($bdd->query('SELECT nom, prenom FROM clients WHERE mail="' . $mail.'" AND pass="' .$mdpcrypte.'" ') as $row)
    {
        $nom = $row[0];
        $prenom = $row[1];
    }
    echo 'Bonjour '.$prenom.' '.$nom;
  

$bdd = null; 
}

    catch(PDOException $erreur){
        echo $erreur.' -- '.$erreur->getMessage();            
}