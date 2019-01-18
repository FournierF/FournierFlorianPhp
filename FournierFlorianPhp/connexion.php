<?php 
// header
// ------
require("include/header_inc.php");

?>  
  <div class="wrapper">
    <form action="script/connexion.php" method="post" id="connexion" class="form-signin">       
      <div id="alert" class="alert alert-danger" style="display:none">
        <strong>Mot de passe ou adresse mail inconnu</strong>
      </div>
      <h2 class="form-signin-heading" style="text-align: center;">Connexion</h2>
      <br/>
      <br/>
      <input type="text" id="Mail" class="form-control" name="mail" placeholder="Adresse Mail de connexion"/>
      <br/>
      <br/>
      <input type="password" id="password" class="form-control" name="pass" placeholder="Mot de passe" />
      <br/>
      <br/>      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>   
    </form>
  </div>
<?php

// footer
// ------
require("include/footer_inc.php");