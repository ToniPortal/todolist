<?php
session_start();
require_once '../ConnexionBDD.php';
include('../log.php');

$search = isset($_POST['search']) ? $_POST['search'] : '';
$up = isset($_POST['up']) ? $_POST['up'] : 'ASC';


$rs = $bdd->prepare("SELECT * FROM todo WHERE (titre LIKE :search OR task LIKE :search) AND IdUtulisateur = :iduti ORDER BY `date` " . $up);
$rs->execute(
    array(
        'search' => '%' . $search . '%',
        'iduti' => $_POST["idUti"]
    )
);


foreach ($rs as $sl) {
    // Logger::info("Load titre n°" . $sl['id'] . " ForEach.");

    // Vérifie si la colonne complete est égale à 1
    $isChecked = ($sl['complete'] == 1) ? 'checked' : '';

    echo "<li class='task' onclick='whatNote(" . $sl["id"] . ")'>
        <input type='checkbox' $isChecked onchange='toggleTask(" . $sl['id'] . ", " . htmlspecialchars($sl['complete']) . ")'>
            <div class='inputs'>
                <input type='text' class='title' name='titre[]' value='" . htmlspecialchars($sl["titre"]) . "'>
                <input type='text' class='date' value='" . $sl["date"] . "' readonly>
            </div>
        <button type='button' class='delete-button' onclick='deleteTask(" . $sl['id'] . ")'>🗑️</button>
    </li>";

}

Logger::info("Loading Titre !")
    ?>