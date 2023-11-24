<?php
require_once '../ConnexionBDD.php';
include('../log.php');
 
$id = $_POST['id'];


//INSERT INTO `todo` (`id`, `task`, `complete`, `date`, `IdUtulisateur`) VALUES ('2', 'vaiselleencore', '0', current_timestamp(), '1');
$rs = $bdd->prepare("DELETE FROM todo WHERE IdUtulisateur = :iduti AND id = :id");;

$rs->execute(array(
    'id' => $id,
    'iduti' => $_POST["idUti"]
));

Logger::info("Delete n°" . $id ." de la bdd.");


