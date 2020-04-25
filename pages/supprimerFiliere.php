<?php

session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');

        $idF=isset($_GET['idF'])?$_GET['idF']:0;

        $requeteStag="SELECT COUNT(*) countStag FROM stagiaire WHERE ID_FILIERE = $idF";
        $resultatStag = $pdo->query($requeteStag);
        $tabStag = $resultatStag->fetch();
        $nbrStag = $tabStag['countStag'];

        if($nbrStag == 0){
            $requete = "DELETE FROM filiere WHERE ID=?";
            $params = array($idF);
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);
            header('location: filieres.php');
        }else{
            $msg = "Suppression impossible: Vous devez supprimer les stagiaires inscrits dans cette filières";
            header("location: alerte.php?message=$msg");
        }
    }else{
          header('location:login.php'); 
     }
   

?>