<?php
    require_once('maSession.php');
    require_once('connexiondb.php');

    $idS=isset($_GET['idS'])?$_GET['idS']:0;
    $requeteS = "SELECT * FROM stagiaire
                WHERE ID = $idS";
    $resultatS = $pdo->query($requeteS);
    $stagiaire = $resultatS->fetch();

    $nom = $stagiaire['NOM'];
    $prenom = $stagiaire['PRENOM'];
    $civilite = $stagiaire['CIVILITE'];
    $idFiliere = $stagiaire['ID_FILIERE'];
    $idService = $stagiaire['ID_SERVICE'];
    $nomPhotot = $stagiaire['PHOTO'];
    $dateDepart = $stagiaire['DATE_ARRIVE'];
    $dateFin = $stagiaire['DATE_DEPART'];

    $requeteF = "SELECT * FROM filiere";
    $resultatF = $pdo->query($requeteF);

    $requeteSer = "SELECT * FROM service";
    $resultatSer = $pdo->query($requeteSer);



?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un stagiaire</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css"
    </head>
    <body>
        <?php include("menu.php");?>
        
    <div class="container">
            <div class="panel panel-primary margetop">
                <div class="panel-heading">Edition du stagiaire</div>
                    <div class="panel-body">
                        
                        <form method="post" action="updateStagiaire.php" class="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="idS">id du stagiaire : <?php echo $idS;?></label>
                                <input type="hidden" name="idS" placeholder="Nom de la filière" class="form-control" value="<?php echo $idS;?>">
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <input type="text" name="nom" placeholder="Nom" class="form-control" value="<?php echo $nom;?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="prenom">Prénom :</label>
                                <input type="text" name="prenom" placeholder="Prénom" class="form-control" value="<?php echo $prenom ?>">
                            </div>
                            
                           <div class="form-group">
                                <label for="civilite">Civilité :</label>
                                <div class="radio">
                                    <label><input type="radio" name="civilite" placeholder="Civilité"  value="F"
                                                  <?php if ($civilite === "F") echo "checked" ?>>F</label>
                                    <label><input type="radio" name="civilite" placeholder="Civilité"  value="M" 
                                                  <?php if ($civilite === "M") echo "checked" ?>>M</label>
                                </div>
                           </div>
                            
                            <div class="form-group">
                            <label for="idFiliere">Filière :</label>
                            <select name="idFiliere" class="form-control" id="idFiliere">
                                <?php while($filiere = $resultatF->fetch()) { ?>
                                    <option value="<?php echo $filiere['ID'] ?>" <?php echo $idFiliere == $filiere['ID']?"selected":"" ?> >
                                        <?php echo $filiere['NOM_FILIERE'] ?>
                                    </option>
                                    <?php } ?>
                            </select>
                            </div>
                                
                            <div class="form-group">
                            <label for="idService">Service :</label>
                            <select name="idService" class="form-control" id="idService">
                                <?php while($service = $resultatSer->fetch()) { ?>
                                    <option value="<?php echo $service['ID'] ?>" <?php echo $idService == $service['ID']?"selected":"" ?> >
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
                                <input type="date" name="dateDepart" placeholder="Année-Mois-Jour" class="form-control" value="<?php echo $dateDepart;?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="dateFin">Date de fin :</label>
                                <input type="date" name="dateFin" placeholder="Année-Mois-Jour" class="form-control" value="<?php echo $dateFin;?>">
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