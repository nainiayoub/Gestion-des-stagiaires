<?php
    require_once('maSession.php');
    require_once('connexiondb.php');

    $requeteSer = "SELECT * FROM service";
    $resultatSer = $pdo->query($requeteSer);
?>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouveau service</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");?>
        
    <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Le nouveau service</div>
                    <div class="panel-body">
                        
                        <form method="post" action="insertService.php" class="form" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label for="nomService">Nom du service :</label>
                                <input type="text" name="nomService" placeholder="Nom du service" class="form-control">
                            </div>
                            
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-save"></span> 
                                Enregistrer..
                            </button>
                        </form>

                    </div>
            </div>
        </div>

             
        
    </body>
</HTML>