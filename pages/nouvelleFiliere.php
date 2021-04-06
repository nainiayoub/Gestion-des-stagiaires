<?php
    require_once('maSession.php');

?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouvelle filière</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
    </head>
    <body>
        <?php include("menu.php");?>
        
    <div class="container">
            <div class="panel panel-primary margetop" style="border: 5px solid #090d00;">
                <div class="panel-heading" style="background-color: #090d00; color: #fff">Veuillez saisir les données de la nouvelle filière</div>
                    <div class="panel-body">
                        
                        <form method="post" action="insertFiliere.php" class="form">
                            <div class="form-group">
                                <label for="nomF">Nom de la filière :</label>
                                <input type="text" name="nomF" placeholder="Nom de la filière" class="form-control">
                            </div>
                            
                            <div class="form-group">
                            <label for="niveau">Niveau :</label>
                            <select name="niveau" class="form-control" id="niveau">
                                <option value="T.Sup" selected>Technicien supérieur</option>
                                <option value="TS">Technicien spécialisé</option>
                                <option value="L">Licence</option>
                                <option value="M">Master</option>
                                <option value="In">Ingénieur</option>
                            </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="ecole">Nom de l'établissemnt :</label>
                                <input type="text" name="ecole" placeholder="Etablissement" class="form-control">
                            </div>
                            
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-save"></span> 
                                Enregistrer..
                            </button>
                        </form>

                    </div>
            </div>
        </div>

             
        
    </body>
</HTML>