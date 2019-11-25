<?php
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$tel = $_POST['tel'];
$email = $_POST['mail'];
$objet= $_POST['objet'];
$msg = $_POST['message'];


$site = "site kary";
$sitweb = "http://localhost/html";
$maildesite = "coucou@gmail.com";
mail("$maildesite","reception email-$objet", "nom : $nom 
prenom : $prenom\n\n 
message :\n $message \n\n
son mail : $email","from : $email");


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
    $prepare = $bdd->prepare("INSERT INTO message(nomco,prenomco,telco,emailco,objetco,msgco)
    VALUES (:nom, :prenom, :tel, :email, :objet, :msg)");
    $prepare->bindParam(':nom', $nom);
    $prepare->bindParam(':prenom', $prenom); 
    $prepare->bindParam(':tel', $tel); 
    $prepare->bindParam(':email', $email); 
    $prepare->bindParam(':objet', $objet); 
    $prepare->bindParam(':msg', $msg);
    $prepare->execute(); //execusion de la requette 
    echo 'insertion bdd réussie <br/>';
    
    $bdd = null; //destruction de l'objet
    header('location:index.html');
}
    catch(PDOException $erreur){
        echo $erreur.' -- '.$erreur->getMessage();            
}

