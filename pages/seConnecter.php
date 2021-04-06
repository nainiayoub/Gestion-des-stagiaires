<?php
    session_start();

    require_once('connexiondb.php');

    $idlogin=isset($_POST['login'])?$_POST['login']:"";
    $pwd=isset($_POST['pwd'])?$_POST['pwd']:"";


    $requete = "SELECT * FROM utilisateur
                WHERE LOGIN = '$idlogin' AND PWD = MD5('$pwd')";
    $resultat = $pdo->query($requete);

    if($user = $resultat->fetch()){
        if($user['ETAT'] == 1){
            $_SESSION['user'] = $user;
            header('location:../index.php');
        }else{
            $_SESSION['erreurLogin'] = "<strong>Erreur!</strong> Votre compte est désactivé.<br> Veuillez contacter l'administrateur";
            header('location:login.php');
        }
    }else{
        $_SESSION['erreurLogin'] = "<strong>Erreur!</strong> Login ou mot de passe incorrect!!";
        header('location:login.php');
        
    }
    


?>