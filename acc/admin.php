<?php
session_start();

include("../log.php");
if (isset($_COOKI["nom"])) {
    Logger::info($_COOKIE["nom"] . " est rentrée dans la page admin");
} else {
    Logger::info("Un utulisateur est rentrée dans la page admin");
}

if (isset($_SESSION["admin"]) && $_SESSION["admin"] == true) {
    ?>

    <table>
        <?php
        Logger::read("page1")

            ?>
    </table>
    <html>


    <html>

    <?php
} else {
    echo "Vous n'avez pas le droit d'acces a cet page";

}
?>