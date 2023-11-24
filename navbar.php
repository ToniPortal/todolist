<navbar>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    if (isset($_SESSION["admin"]) && $_SESSION["admin"] == true) {


        ?>
        <a href="./acc/admin.php">Admin</a>
        <?php
    }
    if (!isset($_GET["idUti"])) {
        ?>
        <a href="./acc/connexion.php">Connexion</a>
        <a href="./acc/inscription.php">inscription</a>

        <?php
    }
    ?>
</navbar>