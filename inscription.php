<?php
//recuperation des données saisie en html 
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$ville = $_POST['ville'];
$cp = $_POST['cp'];
$tel = $_POST['phone'];
$mail = $_POST['mail'];
$mdp = $_POST['pass'];
$mdpconf = $_POST['pass2'];

echo 'nom :' .$nom.'<br/>';
echo 'prenom :' .$prenom.'<br/>';
echo 'ville :' .$ville.'<br/>';
echo 'tel :' .$tel.'<br/>';
echo 'mail :' .$mail.'<br/>';
echo 'passe1 :' .$prenom.'<br/>';
echo 'passe2 :' .$mdpconf.'<br/>';

if ($mdp==$mdpconf)
{
//cryptage
//grain de sel 
$grain="8h!PwDeR#@2";
$mdpcrypte = sha1 (sha1 ($mdp).$grain);
echo 'mot de passe crypté: ' .$mdpcrypte;

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
    $prepare = $bdd->prepare("INSERT INTO clients(nom,prenom,ville,cp,tel,mail,pass)
    VALUES (:nom, :prenom, :ville, :cp, :tel, :mail, :pass)");
    $prepare->bindParam(':nom', $nom);
    $prepare->bindParam(':prenom', $prenom); 
    $prepare->bindParam(':ville', $ville); 
    $prepare->bindParam(':cp', $cp); 
    $prepare->bindParam(':tel', $tel); 
    $prepare->bindParam(':mail', $mail);
    $prepare->bindParam(':pass', $mdpcrypte);
    $prepare->execute(); //execusion de la requette 
    echo 'insertion bdd réussie <br/>';
    
    $bdd = null; //destruction de l'objet
    header('location:connexion.html');
}
    catch(PDOException $erreur){
        echo $erreur.' -- '.$erreur->getMessage();            
}
}else header('location:inscription.html');
