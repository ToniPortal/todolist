<?php
require_once '../ConnexionBDD.php';

include("../crypt.php");

$nom = $_POST['Nom'];
$prenom = $_POST['Prenom'];
$email = $_POST['Mail'];
$pseudo = $_POST['Pseudo'];
$password = $_POST['Password'];
$confPass = $password;

// print $nom . " " . $prenom . " " . $date . " " . $email . " " . $pseudo . " " . $password . " " . $confPass;

if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($pseudo) && !empty($password) && !empty($confPass)) {

    $check = $bdd->prepare('SELECT count(email) FROM utilisateurs WHERE email = ?');
    $check->execute(array($email));
    $row = $check->fetch();


    if ($row[0] == 0) {
        if (strlen($pseudo) <= 100) {
            if (strlen($email) <= 100) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if ($password == $confPass) {
                        $insert = $bdd->prepare('INSERT INTO utilisateurs(nom, prenom, pseudo, email, password) VALUES(:nom, :prenom, :pseudo, :email, :mdp)');
                        $insert->execute(
                            array(
                                'nom' => crypter($nom, $keycrypt),
                                'prenom' => crypter($prenom, $keycrypt),
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'mdp' => crypter($password, $keycrypt),
                            )
                        );
                        setcookie("nom", $nom, time() + 400 * 24 * 60 * 60, );
                        header("HTTP/1.1 201 Créer");
                    } else {
                        header("Location:./inscription.php?err=Votre password n'est pas identique"); //passiden
                    }
                } else {
                    header("Location:./inscription.php?err=Votre email n'est pas valide"); //email
                }
            } else {
                header("Location:./inscription.php?err=Votre email ne doit pas dépasser 100 caractères"); //emaildepas
            }
        } else {
            header("Location:./inscription.php?err=Votre pseudo ne doit pas dépasser 100 caractères");
            //  header('Location:inscription.php?reg_err=pseudo_length');                
        }
    } else {
        header('Location:./inscription.php?err=Vous exister deja');
    }
} else {
    header('Location:./inscription.php?err=Il manque des parametres');
}

/*
$basestring = "Valeur de base";

echo "String de base : <" . $basestring . "<br>";

$crypterdebsae = crypter($basestring, "haha");

echo "Crypter: " . $crypterdebsae . "<br>";

echo "Decrypter: " . decrypter($crypterdebsae, "haha")  . "<br>";
*/

// $keycrypt = "iqofj8645@'-&èihd";