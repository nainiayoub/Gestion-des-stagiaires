<?php
session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');

        $nomService=isset($_POST['nomService'])?$_POST['nomService']:"";

        $requete = "INSERT INTO service (NOM_SERVICE) VALUES (?)";
        $params = array($nomService);

        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        header('location: services.php');
    }else{
        header('location: login.php');
    }

?>