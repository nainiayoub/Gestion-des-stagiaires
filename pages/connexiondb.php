<?php

    try{
        $pdo = new PDO("mysql:host=localhost;dbname=ges_stag","root","");
        
    }catch(Exception $e){
        die('Erreur de connexion' .$e->getMessage());
    }
?>