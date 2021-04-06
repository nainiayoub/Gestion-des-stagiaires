<?php
session_start();
    if(isset($_SESSION['user'])){
        require_once("connexiondb.php");

        $login = isset($_GET['login'])?$_GET['login']:"";
        $idfiliere = isset($_GET['idfiliere'])?$_GET['idfiliere']:0;

        $size = isset($_GET['size'])?$_GET['size']:4;
        $page = isset($_GET['page'])?$_GET['page']:1;
        $offset = ($page - 1)* $size;


        $requeteUser = "SELECT * FROM utilisateur where LOGIN lIKE '%$login%'";
        $requeteCount = "SELECT COUNT(*) countU FROM utilisateur";


        $resultatUtilisateur = $pdo->query($requeteUser);
        $resultatCount = $pdo->query($requeteCount);

        $tabCount = $resultatCount->fetch();
        $nbrUtilisateur = $tabCount['countU'];
        $rest = $nbrUtilisateur % $size;

        if($rest === 0){
            $nbrPage = $nbrUtilsateur/$size;
        }else{
            $nbrPage = floor($nbrUtilisateur/$size) + 1;//partie entiere de la division 
        }
    }else{
        header('location: login.php');
    }
        
?>

<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Gestion des utilisateurs</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");?>
    </body>
    <div class="container">
        <div class="panel panel-success margetop">
            <div class="panel-heading">Rechercher des utilisateurs</div>
                <div class="panel-body">
                    <form method="get" action="utilisateurs.php" class="form-inline">
                        <div class="form-group">
                            <input type="text" name="login" placeholder="Login" value="<?php echo $login;?>" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-search"></span> 
                            Rechercher..
                        </button>
                        
                    </form>
                </div>
        </div>
        <div class="panel panel-primary" style="border: 5px solid #090d00;">
            <div class="panel-heading" style="background-color: #090d00; color: #fff">Liste des utilisateurs (<?php echo $nbrUtilisateur;?> Utilisateurs)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Login</th> <th>Email</th> <th>Rôle</th> 
                                <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                                        <th>Actions</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php while ($utilisateur = $resultatUtilisateur->fetch()) {?>
                                    <tr class="<?php echo $utilisateur['ETAT']==1?"success":"danger"?>">
                                        <td><?php echo ($utilisateur["LOGIN"]);?></td>
                                        <td><?php echo ($utilisateur["EMAIL"]);?></td>
                                        <td><?php echo ($utilisateur["ROLE"]);?></td>
                                        
                                        <?php if($_SESSION['user']['ROLE']=="ADMIN") {?>
                                                <td><a href="editerUtilisateur.php?idUser=<?php echo ($utilisateur['ID']);?>" >
                                                    <span class="glyphicon glyphicon-edit"></span></a>
                                                    &nbsp;&nbsp;
                                                    <a onclick="return confirm('Etes vous sûre de vouloir supprimer cet utilisateur?')"
                                                       href="supprimerUtilisateur.php?idUser=<?php echo ($utilisateur['ID']);?>"><span class="glyphicon glyphicon-trash"></span>
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <a href="activerUtilisateur.php?idUser=<?php echo $utilisateur['ID'];?>&etat=<?php echo $utilisateur['ETAT'] ?>">
                                                    <?php if($utilisateur['ETAT']==1){
                                                            echo '<span class="glyphicon glyphicon-remove"></span>';
                                                          }else{
                                                            echo '<span class="glyphicon glyphicon-ok"></span>';    
                                                          }
                                                        ?>
                                                    </a>

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
                               <li class="<?php if($i == $page ) echo 'active';?>">
                                   <a href="utilisateur.php?page=<?php echo $i; ?>&login=<?php echo $login;?>">
                                   <?php echo $i; ?>
                                   </a></li>
                           <?php }?>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</HTML>