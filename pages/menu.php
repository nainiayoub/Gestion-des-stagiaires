<?php
?>
<nav class="navbar navbar-inverse navbar-fixed-top" style="">
    <div class="container-fluid" style="background-color: #090d00; color: #fff">
        <div class="navbar-header">
            <a href="../index.php" class="navbar-brand">Gérer les stagiaires</a>
        </div>
    <ul class="nav navbar-nav">
        <li><a href="stagiaires.php">Stagiaires</a></li>
        <li><a href="filieres.php">Filières</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="utilisateurs.php">Utilisateurs (géré par l'admin)</a></li>
    </ul>
        
    <ul class="nav navbar-nav navbar-right">
				<li>
					<a href="editerUtilisateur.php?idUser=<?php echo $_SESSION['user']['ID'];?>">
						<span class="glyphicon glyphicon-user"></span> 
						<?php echo $_SESSION['user']['LOGIN'];?>
					</a>
				</li>
				<li>
					<a href="SeDeconnecter.php">
						<span class="glyphicon glyphicon-log-out"></span>
						Se Deconnecter
					</a>
				</li>
    </ul>
    </div>
</nav>

