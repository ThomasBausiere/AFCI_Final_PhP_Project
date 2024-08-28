<?php
$title="Connexion ";
require(__DIR__."/../../../ressources/template/_emptyheader.php");

?>
loggin">
<div class="wrapper">
    <form action="" method="post">
        <?php set_csrf() ?>
        <h1>Welcome Back</h1>
        <br>
        <div class="input-box">
                    <!-- <label for="useremail">Email</label> -->
        <input type="email" name="useremail" id="useremail" placeholder="Email">
        <i class="bi bi-envelope"></i>
        </div>

        <br>
        <span class="error"><?php echo $error["useremail"]??""; ?></span>
        <br>
        <div class="input-box">
        <!-- <label for="userpassword">Mot de passe</label> -->
        <input type="password" name="userpassword" id="userpassword" placeholder="Password">
        <i class="bi bi-lock"></i>
        </div>
        <br>
        <!-- <div class="remember-forgot">
            <label for="">
                <input type="checkbox"> remember me
            </label>
            <a href="#">Forgot Password?</a>
        </div> -->
        <span class="error"><?php echo $error["pass"]??""; ?></span>
        <br>

        <input type="submit" value="Connexion" name="login" class="registerbtn">
        <br>
        <span class="error"><?php echo $error["login"]??""; ?></span>

        <div class="register-link">
            <p>Don't have an account? <a href="/inscription">Register</a></p>
        </div>
        
    </form>
</div>


<?php 
require(__DIR__."/../../../ressources/template/_emptyfooter.php");
?>