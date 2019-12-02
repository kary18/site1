<?php
//recuperation des données saisie en html 
$nomu = $_POST['nom'];
$prenomu = $_POST['prenom'];
$mailu = $_POST['mail'];
$mdpu = $_POST['pass'];
$telu = $_POST['phone'];
$statutu = $_POST['statut'];

$mdpcrypte = sha1 (sha1 ($mdpu));
//paramettre du serveur bdd
$servername = 'localhost';
$dbname = 'ecom'; //nom de bdd
$user = 'root'; // utilisateur de la bdd 
$pass = ''; // mot de passe (vide)

try{
    echo 'connexion bdd <br/>';
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname",$user,$pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo 'requete insertion <br/>';
    // requette sql
    $prepare = $bdd->prepare("INSERT INTO utilisateur(nomu,prenomu,mailu,mdpu,telu,statutu)
    VALUES (:nom, :prenom, :mail, :mdp, :tel, :statut)");
    $prepare->bindParam(':nom', $nomu);
    $prepare->bindParam(':prenom', $prenomu); 
    $prepare->bindParam(':mail', $mailu); 
    $prepare->bindParam(':mdp', $mdpcrypte); 
    $prepare->bindParam(':tel', $telu); 
    $prepare->bindParam(':statut', $statutu);
   
    $prepare->execute(); //execusion de la requette 
    echo 'insertion bdd réussie <br/>';
    
    $bdd = null; //destruction de l'objet
    header('location:connexion.html');
}
    catch(PDOException $erreur){
        echo $erreur.' -- '.$erreur->getMessage();            
}
 header('location:accueil.html');
