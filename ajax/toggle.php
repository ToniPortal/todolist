<?php
require_once '../ConnexionBDD.php';
include('../log.php');

$id = $_POST['id'];

// Sélectionne l'état actuel de la colonne complete
$stmt = $bdd->prepare("SELECT complete FROM todo WHERE IdUtulisateur = :iduti AND id = :id");
$stmt->execute(
    array(
        'id' => $id,
        'iduti' => $_POST["idUti"]
    )
);
$currentCompleteState = $stmt->fetch(PDO::FETCH_ASSOC)['complete'];

// Calcule la nouvelle valeur (inverse de l'état actuel)
$newCompleteState = ($currentCompleteState == 0) ? 1 : 0;

// Utilise UPDATE pour mettre à jour la colonne complete
$rs = $bdd->prepare("UPDATE todo SET complete = :complete WHERE id = :id");
$rs->execute(array('id' => $id, 'complete' => $newCompleteState));

Logger::info("Inversion de la valeur complete pour l'id n°" . $id);
?>