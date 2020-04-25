<?php
    require_once('maSession.php');
    require_once("connexiondb.php");

    $nomPrenom = isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $idfiliere = isset($_GET['idfiliere'])?$_GET['idfiliere']:0;

    $size = isset($_GET['size'])?$_GET['size']:4;
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1)* $size;

    $requeteFiliere = "SELECT * FROM filiere";
    


    if($idfiliere == 0){
        $requeteStagiaire = "SELECT S.ID, NOM, PRENOM, F.NOM_FILIERE, NOM_SERVICE, PHOTO, CIVILITE, DATE_ARRIVE, DATE_DEPART
                    FROM filiere F, stagiaire S, service Ser
                    WHERE F.ID = S.ID_FILIERE
                    AND S.ID_SERVICE = Ser.ID
                    AND (S.NOM LIKE '%$nomPrenom%' OR S.PRENOM LIKE '%$nomPrenom%')
                    ORDER BY S.ID
                    limit $size
                    offset $offset";
        $requeteCount = "SELECT COUNT(*) countS FROM stagiaire
                        WHERE NOM LIKE '%$nomPrenom%' or PRENOM like '%$nomPrenom%'";
    }else{
        $requeteStagiaire = "SELECT S.ID, NOM, PRENOM, F.NOM_FILIERE, NOM_SERVICE, PHOTO, CIVILITE, DATE_ARRIVE, DATE_DEPART 
                    FROM filiere F, stagiaire S, service Ser
                    WHERE F.ID = S.ID_FILIERE
                    AND S.ID_SERVICE = Ser.ID
                    AND (S.NOM LIKE '%$nomPrenom%' OR S.PRENOM LIKE '%$nomPrenom%')
                    AND F.ID = $idfiliere
                    ORDER BY S.ID
                    limit $size
                    offset $offset";
        $requeteCount = "SELECT COUNT(*) countS FROM stagiaire 
                        WHERE (NOM LIKE '%$nomPrenom%' or PRENOM like '%$nomPrenom%')
                        AND ID_FILIERE = $idfiliere";
    }
    $resultatFiliere = $pdo->query($requeteFiliere);
    $resultatStagiaire = $pdo->query($requeteStagiaire);
    $resultatCount = $pdo->query($requeteCount);

    $tabCount = $resultatCount->fetch();
    $nbrStagiaire = $tabCount['countS'];
    $rest = $nbrStagiaire % $size;

    if($rest === 0){
        $nbrPage = $nbrStagiaire/$size;
    }else{
        $nbrPage = floor($nbrStagiaire/$size) + 1;//partie entiere de la division 
    }
    
?>

<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Gestion des stagiaires</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");?>
    </body>
    <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Rechercher des stagiaires</div>
                <div class="panel-body">
                    <form method="get" action="stagiaires.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nomPrenom" placeholder="Nom et prénom" value="<?php echo $nomPrenom;?>" class="form-control">
                        </div>
                        <label for="idfiliere">Filière :</label>
                        <select name="idfiliere" class="form-control" id="idfiliere" onchange="this.form.submit()">
                            <option value=0>Toutes les filières</option>
                            <?php while($filiere = $resultatFiliere->fetch()){  ?>
                                    <option value="<?php echo $filiere["ID"];?>"
                                            <?php  if($filiere["ID"] === $idfiliere) echo "selected" ?>>
                                        <?php echo $filiere["NOM_FILIERE"];?>
                                    </option>
                            <?php  }  ?>
                        </select>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span> 
                            Rechercher..
                        </button>
                        <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                        &nbsp &nbsp;
                        <a href="nouveauStagiaire.php"><span class="glyphicon glyphicon-plus"></span> Nouveau stagiaire</a>
                        <?php } ?>
                        
                    </form>
                </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Liste des stagiaires (<?php echo $nbrStagiaire;?> Stagiaires)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id stagiaire</th><th>Nom </th><th>Prénom</th><th>Filière</th><th>Service</th><th>Photo</th><th>Date de départ</th><th>Date de fin</th>
                                <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php while ($stagiaire = $resultatStagiaire->fetch()) {?>
                                    <tr>
                                        <td><?php echo ($stagiaire["ID"]);?></td>
                                        <td><?php echo ($stagiaire["NOM"]);?></td>
                                        <td><?php echo ($stagiaire["PRENOM"]);?></td>
                                        <td><?php echo ($stagiaire["NOM_FILIERE"]);?></td>
                                        <td><?php echo ($stagiaire["NOM_SERVICE"]);?></td>
                                        <td><img src="../images/<?php echo ($stagiaire["PHOTO"]);?>" width="50px" height="50px" class="img-circle"></td>
                                        <td><?php echo ($stagiaire["DATE_ARRIVE"]);?></td>
                                        <td><?php echo ($stagiaire["DATE_DEPART"]);?></td>
                                        
                                        <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                                        <td><a href="editerStagiaire.php?idS=<?php echo ($stagiaire['ID']);?>"><span class="glyphicon glyphicon-edit"></span></a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sûre de vouloir supprimer ce stagiaire?')"
                                               href="supprimerStagiaire.php?idS=<?php echo ($stagiaire['ID']);?>"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php
                                    } ?>
                        </tbody>
                    </table>
                    <div>
                        <ul class="pagination">
                            <?php for($i=1;$i<=$nbrPage;$i++){?>
                               <li class="<?php if($i == $page ) echo 'active';?>">
                                   <a href="stagiaires.php?page=<?php echo $i; ?>&nomS=<?php echo $nomPrenom;?>&idfiliere=<?php echo $idfiliere ?>">
                                   <?php echo $i; ?>
                                   </a></li>
                           <?php }?>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</HTML>