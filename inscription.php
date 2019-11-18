<?php
//recuperation des données saisie en html 
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$ville = $_POST['ville'];
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
