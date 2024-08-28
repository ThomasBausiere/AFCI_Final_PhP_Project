<?php


$title = " Accueil ";
require(__DIR__."/ressources/template/_header.php");
require __DIR__ . "/ressources/services/_shouldBeLogged.php";

?>
        
            <h3>Menu temporaire</h3>
            <ol>
                <li>
                    <a href="/userlist">Liste Utilisateur</a>
                </li>
                <li>
                    <a href="/inscription">Inscription</a>
                </li>
                
                    <li>
                        <a href="/connexion">Connexion</a>
                    </li>
                    <li>
                        <a href="/deconnexion">Déconnexion</a>
                    </li>                    
                </li>
                <li>
                    <a href="/userupdate">update</a>
                </li>
                <li>
                     <a href="/userdelete">user delete</a>
                </li>
            </ol>
        

        <?php 
  
require __DIR__."/ressources/template/_footer.php";
?>