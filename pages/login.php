<?php
    session_start();

    if(isset($_SESSION['erreurLogin'])){
        $erreurLogin = $_SESSION['erreurLogin'];
    }else{
        $erreurLogin="";
    }

    session_destroy();
?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Se connecter</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        
    <div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
            <div class="panel panel-primary margetop" style="border: 4px solid #090d00">
                <div class="panel-heading" style="background-color: #090d00; border: 4px solid #090d00">Se connecter</div>
                    <div class="panel-body">
                        
                        <form method="post" action="seConnecter.php" class="form" >
                            <?php if(!empty($erreurLogin)) {?>
                            <div class="alert alert-danger">
                                <?php echo $erreurLogin; ?>
                            </div>
                            <?php  } ?>
                            
                            <div class="form-group">
                                <label for="login">Login :</label>
                                <input type="text" name="login" placeholder="Login" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="pwd">Mot de passe :</label>
                                <input type="password" name="pwd" placeholder="Mot de passe" class="form-control">
                            </div>
                            
                         
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-log-in"></span> 
                                Se connecter..
                            </button>
                            <br><br>	
                            <a href="nouveauUtilisateur.php">Créer un compte</a> 
                        </form>

                    </div>
            </div>
        </div>

             
        
    </body>
</HTML>