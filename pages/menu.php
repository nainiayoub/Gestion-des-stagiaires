<?php
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="../index.php" class="navbar-brand">Gestion des stagières</a>
        </div>
    <ul class="nav navbar-nav">
        <li><a href="stagiaires.php">Les stagiaires</a></li>
        <li><a href="filieres.php">Les filières</a></li>
        <li><a href="services.php">Les services</a></li>
        <li><a href="utilisateurs.php">Les utilisateurs</a></li>
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
