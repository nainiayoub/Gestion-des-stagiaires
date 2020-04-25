<?php

session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');

        $idSer=isset($_GET['idSer'])?$_GET['idSer']:0;

        $requeteSer="SELECT COUNT(*) countSer FROM stagiaire WHERE ID_SERVICE = $idSer";
        $resultatSer = $pdo->query($requeteSer);
        $tabSer = $resultatSer->fetch();
        $nbrSer = $tabSer['countSer'];

        if($nbrSer == 0){
            $requete = "DELETE FROM service WHERE ID=?";
            $params = array($idSer);
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);
            header('location: services.php');
        }else{
            $msg = "Suppression impossible: Vous devez supprimer les stagiaires affectés à ce service";
            header("location: alerte.php?message=$msg");
        }
    }else{
          header('location:login.php'); 
     }
   

?>