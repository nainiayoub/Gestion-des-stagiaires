<?php
session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');

        $idF=isset($_POST['idF'])?$_POST['idF']:0;
        $nomF=isset($_POST['nomF'])?$_POST['nomF']:"";
        $niveau=isset($_POST['niveau'])?$_POST['niveau']:"";
        $ecole=isset($_POST['ecole'])?$_POST['ecole']:"";

        $requete = "UPDATE filiere SET NOM_FILIERE=?, NIVEAU=?, ECOLE=? WHERE ID=?";
        $params = array($nomF, $niveau, $ecole, $idF);

        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        header('location: filieres.php');
    }else{
        header('location: login.php');        
    }

?>