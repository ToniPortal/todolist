<?php
require_once '../ConnexionBDD.php';
include('../log.php');

$id = $_POST['id'];

// Sélectionne l'état actuel de la colonne complete
$rs = $bdd->prepare("SELECT task FROM todo WHERE IdUtulisateur = :iduti AND id = :id");
$rs->execute(
    array(
        'id' => $id,
        'iduti' => $_POST["idUti"]
    )
);
$data = $rs->fetch();

echo $data['task'];

Logger::info("Affichage de note n°" . $id);
?>