<?php
session_start();
    if(isset($_SESSION['user'])){
        require_once('connexiondb.php');

        $nom=isset($_POST['nom'])?$_POST['nom']:"";
        $prenom=isset($_POST['prenom'])?$_POST['prenom']:"";
        $civilite=isset($_POST['civilite'])?$_POST['civilite']:"";
        $idFiliere=isset($_POST['idFiliere'])?$_POST['idFiliere']:"";
        $idService=isset($_POST['idService'])?$_POST['idService']:"";
        $dateDepart=isset($_POST['dateDepart'])?$_POST['dateDepart']:"";
        $dateFin=isset($_POST['dateFin'])?$_POST['dateFin']:"";
        $photo=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:"";

        $imageTemp = $_FILES['photo']['tmp_name'];
        move_uploaded_file($imageTemp, "../images/".$photo);


        $requete = "INSERT INTO stagiaire (NOM, PRENOM, ID_FILIERE, ID_SERVICE, PHOTO, CIVILITE, DATE_ARRIVE, DATE_DEPART) VALUES(?,?,?,?,?,?,?,?)";
        $params = array($nom, $prenom, $idFiliere, $idService, $photo, $civilite, $dateDepart, $dateFin);

        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        header('location: stagiaires.php');
    }else{
        header('location: login.php');
    }

?>