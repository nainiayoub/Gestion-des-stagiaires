<?php
    require_once('maSession.php');
    require_once('connexiondb.php');

    $idSer=isset($_GET['idSer'])?$_GET['idSer']:0;
    $requete = "SELECT * FROM service
                WHERE ID = $idSer";

    $resultat = $pdo->query($requete);
    $service = $resultat->fetch();

    $nomSer = $service['NOM_SERVICE'];


?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'une filière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");?>
        
    <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Edition du service</div>
                    <div class="panel-body">
                        
                        <form method="post" action="updateService.php" class="form">
                            <div class="form-group">
                                <label for="idSer">id du service : <?php echo $idSer;?></label>
                                <input type="hidden" name="idSer" placeholder="id service" class="form-control" value="<?php echo $idSer;?>">
                            </div>
                            <div class="form-group">
                                <label for="nomSer">Nom du service :</label>
                                <input type="text" name="nomSer" placeholder="Nom du service" class="form-control" value="<?php echo $nomSer;?>">
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