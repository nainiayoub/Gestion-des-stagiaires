<?php
   
  $con = new PDO("mysql:host=localhost;dbname=ges_stag","root","");

    function findUserByLogin($login){
        global $con;  
        
        $statement=$con->prepare("SELECT LOGIN FROM utilisateur WHERE LOGIN=?");
        $statement->execute(array($login));
        $count=$statement->rowCount();
        return $count;
        
    }
	
	 function findUserByEmail($email){
	     
        global $con;
        
        $statement=$con->prepare("SELECT EMAIL FROM utilisateur WHERE LOGIN=?");
        $statement->execute(array($email));
        $count=$statement->rowCount();
        return $count;
        
    }
     function redirectPage($messag, $url = nul, $seconds=2){
         
        if($url===null){
            
            $url='dashBoard.php';
            $back='HomePage';
            
        }elseif($url=='back'){
            
            if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
                
                $url=$_SERVER['HTTP_REFERER'];
                $back='Previous Page';
                
            }else{
                
                $url='dashBoard.php';
                $back='HomePage';
            }
            
        }
        echo $messag;
        echo "<div class='alert alert-info'> Vous serez redirigé après $seconds secondes</div>";
        header("refresh:$seconds;url=$url");
        exit();
    }
	
?>