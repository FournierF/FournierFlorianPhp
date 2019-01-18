<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<?php 
include("include/header_inc.php");
require("bdd/connection.php");
date_default_timezone_set('Europe/Paris');
?>

<?php if(isset($_GET['id'])) {
    // Cas de modification
    // -------------------
?>
	<section>
        <div class="container">
            <div class="row">              
                <form action="script/update.php" method="post">
                    <div class="col-sm-10">

                        <div class="form-group">
                            <textarea id="message" name="message" class="form-control" placeholder="Message"><?php  
                                $identifiant = $_GET['id'];
                                $sth = $bdd->prepare("SELECT msg FROM message WHERE id=$identifiant");
                                $sth->execute(); 
                                while($donnees = $sth->fetch())
                                {echo($donnees['msg']);
                                }?></textarea>
                            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success btn-lg">Modifier</button>
                    </div>                        
                </form>
            </div>
<?php  
}
else {
    // Cas d'insertion
    // ---------------   
?>
	<section>
           <div class="container">
                <div class="row">              
                    <form action="script/insert.php" method="post">
                        <div class="col-sm-10">  
                            <div class="form-group">
                                <textarea id="message" name="message" class="form-control" placeholder="Inserez votre message ici"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-success btn-lg">Envoyer</button>
                        </div>                        
                    </form>
                </div>
<?php
}
?>


<?php 
if (isset($_SESSION['id'])){
  // Cas ou un utilisateur est connecté
  // ----------------------------------
?>
	<div class="row">
        <div id="alert" class="alert alert-danger" style="display:none">
                <strong>Vote déjà effectué</strong>
        </div>
        <div class="col-md-12">
            <?php
            $postParPage = 5;
            $postTotalReq = $bdd->query('SELECT id FROM message');
            $postTotal = $postTotalReq->rowCount();
            $pageTotal = ceil($postTotal/$postParPage);

            if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0){
                $_GET['page'] = intval($_GET['page']);
                $pageCourante = $_GET['page'];
            }else{
                $pageCourante = 1;
            }
            $start = ($pageCourante-1)*$postParPage;
            $response = $bdd->query('SELECT id,msg,dates,vote from message ORDER BY dates ASC LIMIT '.$start.','.$postParPage);

            while ($donnees = $response->fetch()) {
	            ?>
	            <blockquote>
	                <p>
	                	<?php echo($donnees['msg']) ?>
	                </p>
	                <footer><?php echo (date('d m Y',$donnees['dates']))." - ".($donnees['vote']." ") ?>votes</footer>

	                <button type="submit" class="btn btn-primary" id=""><a href="index.php?id=<?php echo  ($donnees['id'])?>">Modifier</a></button>
	                <button type="submit" class="btn btn-danger"><a href="script/delete.php?id=<?php echo ($donnees['id'])?>">Supprimer</a> </button>
	                <button type="submit" class="btn btn-success" id=""><a class="like" data-id="<?php echo $donnees['id'] ?>">Like</a></button>
	            </blockquote>
	            <?php	
            }
            $response->closeCursor(); // Termine le traitement de la requête
            ?>
			<nav aria-label="Page navigation example" style="text-align: center;">
 	 		<ul class="pagination">
           	 	<?php
            	for($i = 1;$i <= $pageTotal; $i++ ){
            		echo("<li class=\"page-item\"><a class\"page-link\" href=\"index.php?page=".$i."\">".$i." </a>");
            	}
            	?>            
  			</ul>
			</nav>
        </div>
	</div>
</section>
<?php
}
else {
  // Cas ou aucun utilisateur est connecté
  // -------------------------------------
?>
	<div class="row">
        <div id="alert" class="alert alert-danger" style="display:none">
                <strong>Vote déjà effectué</strong>
        </div>
	        <div class="col-md-12">
	    	<?php
	            $postParPage = 5;
	            $postTotalReq = $bdd->query('SELECT id FROM message');
	            $postTotal = $postTotalReq->rowCount();
	            $pageTotal = ceil($postTotal/$postParPage);

	            if(isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0){ 
	                $_GET['page'] = intval($_GET['page']);
	                $pageCourante = $_GET['page'];
	            }
	            else{
	                $pageCourante = 1;
	            }
	            $start = ($pageCourante-1)*$postParPage;
	            $response = $bdd->query('SELECT id,msg,dates,vote from message ORDER BY dates ASC LIMIT '.$start.','.$postParPage);
	            while ($donnees = $response->fetch()) {
	   			?>
	    			<blockquote>
		            <p>
		            	<?php echo($donnees['msg']) ?>
		            </p>
		            <footer><?php echo (date('d m Y',$donnees['dates']))." - ".($donnees['vote']." ") ?>votes</footer>
		   		 	</blockquote>
		    		<?php   
		   		}
	    		$response->closeCursor(); // Termine le traitement de la requête
	    	?>
			<nav aria-label="Page navigation example" style="text-align: center;">
			<ul class="pagination">
	    	<?php
	    		for($i = 1;$i <= $pageTotal; $i++ ){
	    			echo("<li class=\"page-item\"><a class\"page-link\" href=\"index.php?page=".$i."\">".$i." </a>");
	    		}
	    	?>     
	 		</ul>
			</nav>
		</div>
	</div>
</section>
<?php
}
?>           
<?php include("include/footer_inc.php"); ?>

</body>

</html>