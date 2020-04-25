<?php
    require_once('maSession.php');
    require_once("connexiondb.php");

    $nomSer = isset($_GET['nomSer'])?$_GET['nomSer']:"";


    $size = isset($_GET['size'])?$_GET['size']:4;
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1)* $size;

    $requete = "SELECT * FROM service
                WHERE NOM_SERVICE LIKE '%$nomSer%'
                limit $size
                offset $offset";
    $requeteCount = "SELECT COUNT(*) countSer FROM service
                 WHERE NOM_Service LIKE '%$nomSer%'";
   
    $resultatSer = $pdo->query($requete);
    $resultatCount = $pdo->query($requeteCount);

    $tabCount = $resultatCount->fetch();
    $nbrService = $tabCount['countSer'];
    $rest = $nbrService % $size;

    if($rest === 0){
        $nbrPage = $nbrService/$size;
    }else{
        $nbrPage = floor($nbrService/$size) + 1;//partie entiere de la division 
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
            <div class="panel-heading">Rechercher des services</div>
                <div class="panel-body">
                    <form method="get" action="services.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nomSer" placeholder="Nom du service" value="<?php echo $nomSer;?>" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span> 
                            Rechercher..
                        </button>
                        <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                        &nbsp &nbsp;
                        <a href="nouveauService.php"><span class="glyphicon glyphicon-plus"></span> Nouveau service</a>
                        <?php } ?>
                    </form>
                </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Liste des services (<?php echo $nbrService;?> Services)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id service</th><th>Nom service</th>
                                <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                                <?php while ($service=$resultatSer->fetch()) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($service["ID"]);?></td>
                                        <td><?php echo ($service["NOM_SERVICE"]);?></td>
                                        
                                        <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                                        <td><a href="editerService.php?idSer=<?php echo ($service['ID']);?>"><span class="glyphicon glyphicon-edit"></span></a>
                                            &nbsp;
                                            <a onclick="return confirm('Etes vous sûre de vouloir supprimer ce service?')"
                                               href="supprimerService.php?idSer=<?php echo ($service['ID']);?>"><span class="glyphicon glyphicon-trash"></span></a>
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
                                   <a href="services.php?page=<?php echo $i; ?>&nomSer=<?php echo $nomSer;?>&niveau=<?php echo $niveau?>">
                                   <?php echo $i; ?>
                                   </a></li>
                           <?php }?>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</HTML>