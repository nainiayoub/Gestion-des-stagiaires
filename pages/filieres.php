<?php
    require_once('maSession.php');
    require_once("connexiondb.php");

    $nomF = isset($_GET['nomF'])?$_GET['nomF']:"";
    $niveau = isset($_GET['niveau'])?$_GET['niveau']:"all";

    $size = isset($_GET['size'])?$_GET['size']:4;
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1)* $size;

    if($niveau == "all"){
        $requete = "SELECT * FROM filiere
                    WHERE NOM_FILIERE LIKE '%$nomF%'
                    limit $size
                    offset $offset";
        $requeteCount = "SELECT COUNT(*) countF FROM filiere
                        WHERE NOM_FILIERE LIKE '%$nomF%'";
    }else{
        $requete = "SELECT * FROM filiere
                    WHERE NOM_FILIERE LIKE '%$nomF%'
                    AND NIVEAU = '$niveau'
                    limit $size
                    offset $offset";
        $requeteCount = "SELECT COUNT(*) countF FROM filiere
                        WHERE NOM_FILIERE LIKE '%$nomF%'
                        AND NIVEAU = '$niveau'";
    }
    $resultatF = $pdo->query($requete);
    $resultatCount = $pdo->query($requeteCount);

    $tabCount = $resultatCount->fetch();
    $nbrFiliere = $tabCount['countF'];
    $rest = $nbrFiliere % $size;

    if($rest === 0){
        $nbrPage = $nbrFiliere/$size;
    }else{
        $nbrPage = floor($nbrFiliere/$size) + 1;//partie entiere de la division 
    }
    
?>

<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Gestion des filières</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");?>
    </body>
    <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Rechercher des filières</div>
                <div class="panel-body">
                    <form method="get" action="filieres.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nomF" placeholder="Nom de la filière" value="<?php echo $nomF;?>" class="form-control">
                        </div>
                        <label for="niveau">Niveau :</label>
                        <select name="niveau" class="form-control" id="niveau" onchange="this.form.submit()">
                            <option value="all" <?php if($niveau == "all") echo "selected";?>>Tous les niveaux</option>
                            <option value="T.Sup" <?php if($niveau == "T.Sup") echo "selected";?>>Technicien supérieur</option>
                            <option value="TS" <?php if($niveau == "TS") echo "selected";?>>Technicien spécialisé</option>
                            <option value="L" <?php if($niveau == "L") echo "selected";?>>Licence</option>
                            <option value="M" <?php if($niveau == "M") echo "selected";?>>Master</option>
                            <option value="In" <?php if($niveau == "In") echo "selected";?>>Ingénieur</option>
                        </select>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span> 
                            Rechercher..
                        </button>
                        <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                        &nbsp &nbsp;
                        <a href="nouvelleFiliere.php"><span class="glyphicon glyphicon-plus"></span> Nouvelle filière</a>
                        <?php } ?>
                        
                    </form>
                </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Liste des filières (<?php echo $nbrFiliere;?> Filières)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id filière</th><th>Nom filière</th><th>Niveau</th><th>Etablissement</th>
                                <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                                <?php while ($filiere=$resultatF->fetch()) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($filiere["ID"]);?></td>
                                        <td><?php echo ($filiere["NOM_FILIERE"]);?></td>
                                        <td><?php echo ($filiere["NIVEAU"]);?></td>
                                        <td><?php echo ($filiere["ECOLE"]);?></td>
                                        
                                        <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                                        <td><a href="editerFiliere.php?idF=<?php echo ($filiere['ID']);?>"><span class="glyphicon glyphicon-edit"></span></a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sûre de vouloir supprimer cette filière?')"
                                               href="supprimerFiliere.php?idF=<?php echo ($filiere['ID']);?>"><span class="glyphicon glyphicon-trash"></span></a>
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
                                   <a href="filieres.php?page=<?php echo $i; ?>&nomF=<?php echo $nomF;?>&niveau=<?php echo $niveau?>">
                                   <?php echo $i; ?>
                                   </a></li>
                           <?php }?>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</HTML>