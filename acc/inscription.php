<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="inscription.css">
    <title>Inscription</title>

</head>

<body>
    <div class="main">
        <div class="box">

            <h1 id="title">Inscription</h1>

            <div class="error">
                <h3>
                    <?php if (@$_GET["err"]) {
                        echo $_GET["err"];
                    } ?>
                </h3>
            </div>



            <div id="divsincrip">
                <form action="./formins.php" method="POST">


                    <input type="text" id="Nom" name="Nom" autocomplete="off" required>
                    <label>Nom</label>



                    <input type="text" id="Prenom" name="Prenom" autocomplete="off" required>
                    <label>Prénom</label>



                    <input type="date" id="Date" name="Date" autocomplete="off" required>
                    <input type="mail" id="Mail" name="Mail" autocomplete="off" required>
                    <label>Mail</label>



                    <input type="text" id="Pseudo" name="Pseudo" autocomplete="off" required>
                    <label>Pseudo</label>



                    <input type="password" id="Password" name="Password" autocomplete="off" required>
                    <label>Mot de passe</label>



                    <input type="password" id="Confpass" name="Confpass" autocomplete="off" required>
                    <label> Confirmer votre mot de passe</label>


                    <div class="inscrConnexion">
                        <a href="./connexion.php">Connexion</a>
                        <input type="submit" value="Submit ins">
                    </div>
                </form>
            </div>
        </div>
</body>

</html>