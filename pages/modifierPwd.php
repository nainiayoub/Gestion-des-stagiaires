<?php
    require_once ('maSession.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Changement de mot de passe</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monstyle.css">
        <script src="../js/jquery-3.3.1.js"></script>
    	<script src="../js/myjs.js"></script>
    </head>
    <body>
        <?php include("menu.php");?>
    
    
    
    	<div class="container col-lg-4 col-lg-offset-4 margetop">
            
    		<h2 class="text-center">Changement de mot de passe</h2>
    		<h4 class="text-center"> Compte :<?php echo $_SESSION['user']['LOGIN'] ?> 	</h4>
    		<form class="form-horizontal" method="post" action="updatePwd.php">
    
    
    			<!-- ***************** start old pwd field  ***************** -->
    
    				<div class="input-container">
    					<input 	
    						minlength=4
    						class="oldpwd form-control" 
    						type="password"
    						name="oldpwd" 
    						autocomplete="new-password"
    						placeholder="Taper votre Ancien Mot de passe" 
    						required> 
    					<i class="show-oldpwd fa fa-eye fa-2x"></i>
    				</div>
                    &nbsp;
    
    			<!-- ***************** end old pwd field ***************** -->
    
    
    
    			<!--  ***************** start new pwd field  ***************** -->
    
    
    				<div class="input-container">
    					<input 	
    						minlength=4
    						class=" newpwd form-control" 
    						type="password"
    						name="newpwd" 
    						autocomplete="new-password"
    						placeholder="Taper votre Nouveau Mot de passe" 
    						required> 
    					<i class="show-newpwd fa fa-eye fa-2x"></i>
    				</div>
                        &nbsp;
    
    			<!--  *****************  end new pwd field  ***************** -->
    
    			<!--  *****************  submit field  ***************** -->
    
    					<input 
    						type="submit" 
    						value="Enregistrer"
    						class="btn btn-primary btn-block" />
    
    			<!--   ***************** end submit field  ***************** -->
    
    		</form>
    	</div>
    
    </body>
</html>
