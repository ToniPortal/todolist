<?php
session_start();
require_once '../ConnexionBDD.php';
include("../crypt.php");
include("../log.php");

if (isset($_POST['mail']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['mail']);
    $password = $_POST['password'];

    $check = $bdd->prepare('SELECT id, pseudo, email, password,admin FROM utilisateurs where email = :mail');
    $check->execute(
        array(
            // 'pass' => $password,
            'mail' => $email,
        )
    );
    $data = $check->fetch();
    $row = $check->rowCount();

    if ($row != 0) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // echo $password;

            if (decrypter($data['password'], $keycrypt) === $password) {

                // setcookie('nom', $data['pseudo'], time() + 400 * 24 * 60 * 60);

                // setcookie('idUti', crypt($data['id'],$keycrypt), time() + 400 * 24 * 60 * 60);


                if ($data['admin'] == 0) {
                    $_SESSION['admin'] = false;
                    Logger::info('Connexion utulisateur ' . $pseudo . " avec l'email : " . $email);
                } else if ($data['admin'] == 1) {
                    $_SESSION['admin'] = true;
                } else {
                    $_SESSION['admin'] = false;
                }

                header('Location:../index.php?idUti='.$data["id"]);


            } else {
                header('Location:./connexion.php?login_err=password');
            }
        } else {
            header('Location:./connexion.php?login_err=email');
        }
    } else {
        header('Location:./connexion.php?login_err=already');
    }
} else {
    header('Location:./connexion.php');
}
