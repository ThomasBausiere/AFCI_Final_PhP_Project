<?php
$title = "Inscription";
require(__DIR__."/../../../ressources/template/_emptyheader.php");
?>

loggin">
<div class="wrapper">
    <h1>Register</h1>
    <form action="" method="post">
        <!-- username -->
        <div class="input-box">
        <!-- <label for="username">Nom d'Utilisateur :</label> -->
            <input type="text" name="username" id="username" required placeholder="username">
            <span class="erreur"><?php echo $error["username"]??""; ?></span>
            <i class="bi bi-person"></i>
        </div>
    <br>
        <!-- Email -->
        <div class="input-box">
            <!-- <label for="useremail">Adresse Email :</label> -->
            <input type="useremail" name="useremail" id="useremail" placeholder="E-Mail" required>
            <span class="erreur"><?php echo $error["useremail"]??""; ?></span> 
            <i class="bi bi-envelope"></i>
        </div>
    <br>
        <!-- Password -->
        <div class="input-box">
        <!-- <label for="userpassword">Mot de passe :</label> -->
            <input type="password" name="userpassword" id="userpassword" placeholder="Password" required>
            <span class="erreur"><?php echo $error["userpassword"]??""; ?></span>
            <i class="bi bi-lock"></i> 
        </div>
    <br>
        <!-- password verify -->
        <div class="input-box">
        <!-- <label for="userpasswordBis">Confirmation du mot de passe :</label> -->
            <input type="password" name="userpasswordBis" id="userpasswordBis" placeholder="Confirm Password" required>
            <span class="erreur"><?php echo $error["userpasswordBis"]??""; ?></span>
            <i class="bi bi-lock"></i> 
        </div>
    <br>    
        <input type="submit" value="Inscription" name="inscription"  placeholder="valider" class="registerbtn">
        <div class="register-link">
            <p>Already have an account? <a href="/">Sign-up</a></p>
        </div>
    </form>
</div>

<?php
$title = " MVC - Suppression ";
require(__DIR__."/../../../ressources/template/_emptyfooter.php");
?>