<?php
    require_once('maSession.php');
    require_once("connexiondb.php");

    $nomSer = isset($_GET['nomSer'])?$_GET['nomSer']:"";


    $size = isset($_GET['size'])?$_GET['size']:4;
    $page = isset($_GET['page'])?$_GET['page']:1;
    $offset = ($page - 1)* $size;

    $requeteChercherParService = "SELECT * FROM service";
    $resulatChercherParService = $pdo->query($requeteChercherParService);

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
    <div class="row">
        <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
            <div class="col-sm-6 ">
                <div class="panel panel-default margetop" style="border: 5px solid #ddd">
                    <div class="panel-heading">Rechercher des services</div>
                        <div class="panel-body">
                            <form method="get" action="services.php" class="form-inline" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nomSer">Nom service: </label>
                                    <input type="text" name="nomSer" placeholder="Nom du service" value="<?php echo $nomSer;?>" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-search"></span> 
                                    Rechercher..
                                </button>
                            
                            </form>
                        </div>
                </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default margetop" style="border: 5px solid #ddd">
                        <div class="panel-heading">Ajouter des nouveaux services</div>
                            <div class="panel-body">
                                
                                <form method="post" action="insertService.php" class="form-inline" enctype="multipart/form-data">
                                    
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

            
                
        </div>

            
    </div>
        <?php }else{ ?>
            <div class="panel panel-default margetop" style="border: 5px solid #ddd">
                <div class="panel-heading">Rechercher des services</div>
                    <div class="panel-body">
                        <form method="get" action="services.php" class="form-inline" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="nomSer" placeholder="Nom du service" value="<?php echo $nomSer;?>" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-search"></span> 
                                Rechercher..
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
        <div class="container">
        
        <div class="panel panel-default" style="border: 5px solid #090d00;">
            <div class="panel-heading" style="background-color: #090d00; color: #fff">Liste des services (<?php echo $nbrService;?> Services)</div>
                <div class="panel-body">

                    


                    <table class="table table-striped table-bordered" style="text-align:">
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
                        <ul class="pagination" style="margin: 0 auto">
                            <?php for($i=1;$i<=$nbrPage;$i++){?>
                               <li class="<?php if($i == $page ) echo 'active';?>" >
                                   <a href="services.php?page=<?php echo $i; ?>&nomSer=<?php echo $nomSer;?>&niveau=<?php echo $niveau?>">
                                   <?php echo $i; ?>
                                   </a></li>
                           <?php }?>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
    </div>
</HTML>