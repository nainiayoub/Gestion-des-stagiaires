<?php
session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');

        $idSer=isset($_POST['idSer'])?$_POST['idSer']:0;
        $nomSer=isset($_POST['nomSer'])?$_POST['nomSer']:"";

        $requete = "UPDATE service SET NOM_SERVICE=? WHERE ID=?";
        $params = array($nomSer, $idSer);

        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        header('location: services.php');
    }else{
        header('location: services.php');        
    }

?>