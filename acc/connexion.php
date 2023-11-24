<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page de connexion</title>
</head>
<body>
    <div class="main">
        <div class="box">
            <h1>Connexion</h1>

            <?php
            if(isset($_GET['login_err'])){
                $err = htmlspecialchars($_GET['login_err']); 

                switch ($err) {
                    case 'password':
                    ?>
                        <div class="error">
                            <center><h3><strong>Erreur</strong> mot de passe incorect</h3></center>
                        </div>  
                    <?php        
                    break;

                    case 'email':
                        ?>
                            <div class="error">
                                <center><h3><strong>Erreur</strong>email incorect</h3></center>
                            </div>  
                        <?php        
                        break;
                    
                    case 'already':
                    ?>
                        <div class="error">
                            <center><h3><strong>Erreur</strong>compte inexistant</h3></center>
                        </div>  
                    <?php        
                    break;
                }
            }
            ?>
            
            <form method="POST" action="formcon.php">
                <div class="unInput">
                    <input type="text" name="mail" autocomplete="off" required>
                    <label>Mail</label>
                </div>

                <div class="unInput">
                    <input type="password" name="password" autocomplete="off" required>
                    <label>Mot de passe</label>
                </div>
                
                <div class="inscrConnexion">
                    <input type="submit" value="Se connecter">
                    <a href="inscription.php">S'inscrire</a>
                </div>      

                
            </form>
        </div>
    </div>
</body>
</html>