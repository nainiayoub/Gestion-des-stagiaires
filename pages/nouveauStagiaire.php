<?php
    require_once('maSession.php');
    require_once('connexiondb.php');


    $requeteF = "SELECT * FROM filiere";
    $resultatF = $pdo->query($requeteF);

    $requeteSer = "SELECT * FROM service";
    $resultatSer = $pdo->query($requeteSer);



?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouveau stagiaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css"
    </head>
    <body>
        <?php include("menu.php");?>
        
    <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Les infos du nouveau stagiaire</div>
                    <div class="panel-body">
                        
                        <form method="post" action="insertStagiaire.php" class="form" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" name="nom" placeholder="Nom" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="prenom">Prénom :</label>
                                <input type="text" name="prenom" placeholder="Prénom" class="form-control">
                            </div>
                            
                           <div class="form-group">
                                <label for="civilite">Civilité :</label>
                                <div class="radio">
                                    <label><input type="radio" name="civilite" placeholder="Civilité"  value="F" checked>F</label>
                                    <label><input type="radio" name="civilite" placeholder="Civilité"  value="M">M</label>
                                </div>
                           </div>
                            
                            <div class="form-group">
                            <label for="idFiliere">Filière :</label>
                            <select name="idFiliere" class="form-control" id="idFiliere">
                                <?php while($filiere = $resultatF->fetch()) { ?>
                                    <option value="<?php echo $filiere['ID'] ?>" >
                                        <?php echo $filiere['NOM_FILIERE'] ?>
                                    </option>
                                    <?php } ?>
                            </select>
                            </div>
                                
                            <div class="form-group">
                            <label for="idService">Service :</label>
                            <select name="idService" class="form-control" id="idService">
                                <?php while($service = $resultatSer->fetch()) { ?>
                                    <option value="<?php echo $service['ID'] ?>" >
                                        <?php echo $service['NOM_SERVICE'] ?>
                                    </option>
                                    <?php } ?>
                            </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="photo">Photo :</label>
                                <input type="file" name="photo" value="<?php echo $photo;?>">
                            </div>
                            
                             <div class="form-group">
                                <label for="dateDepart">Date de départ :</label>
                                <input type="date" name="dateDepart" placeholder="Année-Mois-Jour" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="dateFin">Date de fin :</label>
                                <input type="date" name="dateFin" placeholder="Année-Mois-Jour" class="form-control">
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