<?php
session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');

        $nomF=isset($_POST['nomF'])?$_POST['nomF']:"";
        $niveau=isset($_POST['niveau'])?$_POST['niveau']:"";
        $ecole=isset($_POST['ecole'])?$_POST['ecole']:"";

        $requete = "INSERT INTO filiere (NOM_FILIERE, NIVEAU, ECOLE) VALUES (?,?,?)";
        $params = array($nomF, $niveau, $ecole);

        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        header('location: filieres.php');
    }else{
        header('location: login.php');
    }

?>