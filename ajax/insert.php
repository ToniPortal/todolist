<?php
require_once '../ConnexionBDD.php';
include('../log.php');
 
$idUti = $_POST['idUti'];
$titre = $_POST['titre'];


//INSERT INTO `todo` (`id`, `task`, `complete`, `date`, `IdUtulisateur`) VALUES ('2', 'vaiselleencore', '0', current_timestamp(), '1');
$rs = $bdd->prepare("INSERT INTO todo (titre, IdUtulisateur) VALUE (:titre, :iduti)");

$rs->execute(array(
    'iduti' => $_POST["idUti"],
    'titre' => $titre
));

Logger::info("Insert " . $titre . " pour l'utulisateur n°". $idUti);





