<?php
session_start();
   
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');

        $idUser=isset($_POST['idUser'])?$_POST['idUser']:0;
        $login=isset($_POST['login'])?$_POST['login']:"";
        $email=isset($_POST['email'])?$_POST['email']:"";
        $role=isset($_POST['role'])?$_POST['role']:"";   

        if($_SESSION['user']['ROLE']=="ADMIN"){

            $requete = "UPDATE utilisateur SET LOGIN=?, ROLE=?, EMAIL=? WHERE ID =?";
            $params = array($login, $role, $email, $idUser);

            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);
            header('location: utilisateurs.php');
        }else{
            header('location: utilisateurs.php');
        }
            
    }else{
        header('location: login.php');
    }

?>