<?php
$title = "Update";
require(__DIR__."/../../../ressources/template/_emptyheader.php");
?>

loggin">
<div class="wrapper">
        <h3>Update</h3>
    <form action="/userupdate" method="post" >
        <!-- username -->
        <div class="input-box"> 
                <label for="username">Nom d'Utilisateur :</label>
                <input type="text" name="username" id="username" value="<?php echo $_SESSION["username"] ?>">
                <span class="erreur"><?php echo $error["username"]??""; ?></span>
        </div> <br>
        <!-- Email -->
        <div class="input-box">
                <label for="useremail">Adresse Email :</label>
                <input type="email" name="useremail" id="useremail" value="<?php echo $_SESSION["useremail"] ?>">
                <span class="erreur"><?php echo $error["useremail"]??""; ?></span> 
        </div><br>
        <!-- Password -->
        <div class="input-box">
                <label for="userpassword">Mot de passe :</label>
                <input type="password" name="userpassword" id="userpassword">
                <span class="erreur">
                        <?php echo $error["userpassword"]??""; ?>
                </span> 
        </div><br>
        <!-- password verify -->
        <div class="input-box">
                <label for="userpasswordBis">Confirmation du mot de passe :</label>
                <input type="password" name="userpasswordBis" id="userpasswordBis">
                <span class="erreur">
                        <?php echo $error["userpasswordBis"]??""; ?>
                </span> 
        </div>
        <br>
        <input type="submit" value="Update" name="update" class="registerbtn">
    </form>
    <!--  -->
    <div class="minimenu">
        <p id="deleteAccountBtn">Delete Account</p> 
    <a href="/" id="closeupdateBtn">Cancel</a>
    </div>
    


        <dialog id="confirmModal">
                <form method="dialog">
                        <p>Êtes-vous sûr de vouloir supprimer votre compte ?</p>
                        <menu>
                                <button value="cancel">Annuler</button>
                                <button id="confirmDelete" value="default"><a href="/userdelete">Confirm</a></button>
                        </menu>
                </form>
        </dialog>
</div>
<?php

require(__DIR__."/../../../ressources/template/_emptyfooter.php");
?>