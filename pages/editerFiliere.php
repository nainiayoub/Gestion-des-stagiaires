<?php
    require_once('maSession.php');
    require_once('connexiondb.php');

    $idF=isset($_GET['idF'])?$_GET['idF']:0;
    $requete = "SELECT * FROM filiere
                WHERE ID = $idF";
    $resultat = $pdo->query($requete);
    $filiere = $resultat->fetch();

    $nomF = $filiere['NOM_FILIERE'];
    $niveau = $filiere['NIVEAU'];
    $ecole = $filiere['ECOLE'];


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
                <div class="panel-heading">Edition de la filière</div>
                    <div class="panel-body">
                        
                        <form method="post" action="updateFiliere.php" class="form">
                            <div class="form-group">
                                <label for="idF">id de la filière : <?php echo $idF;?></label>
                                <input type="hidden" name="idF" placeholder="Nom de la filière" class="form-control" value="<?php echo $idF;?>">
                            </div>
                            <div class="form-group">
                                <label for="nomF">Nom de la filière :</label>
                                <input type="text" name="nomF" placeholder="Nom de la filière" class="form-control" value="<?php echo $nomF;?>">
                            </div>
                            
                            <div class="form-group">
                            <label for="niveau">Niveau :</label>
                            <select name="niveau" class="form-control" id="niveau">
                                <option value="T.Sup" <?php if($niveau == "T.Sup") echo "selected";?>>Technicien supérieur</option>
                                <option value="TS" <?php if($niveau == "TS") echo "selected";?>>Technicien spécialisé</option>
                                <option value="L" <?php if($niveau == "L") echo "selected";?>>Licence</option>
                                <option value="M" <?php if($niveau == "M") echo "selected";?>>Master</option>
                                <option value="In" <?php if($niveau == "In") echo "selected";?>>Ingénieur</option>
                            </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="ecole">Nom de l'établissemnt :</label>
                                <input type="text" name="ecole" placeholder="Etablissement" class="form-control" value="<?php echo $ecole;?>">
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