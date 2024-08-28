<?php 
if(session_status()=== PHP_SESSION_NONE)session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title??""; ?></title>
    <!-- Le lien doit se faire par rapport à où est ce que le fichier
    sera inclu et non par rapport à là où se trouve le fichier. -->
    <!-- <link rel="stylesheet" href="../style/style.css"> -->
    <!-- <link rel="stylesheet" href="../ressources/style/style.css"> -->
	<!--Le problème avec un lien relatif c'est qu'il ne fonctionnera plus si on l'inclu dans un fichier se trouvant ailleurs.
		On préfèrera alors utiliser un chemin absolu depuis la racine de notre serveur.-->
	<link rel="stylesheet" href="/../../../ressources/style/import.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script>
        const user = "<?php echo $_SESSION["username"]??"" ?>"
        const userid = "<?php echo $_SESSION["userid"]??"" ?>"
        
    </script>
    <script src="./script/script.js" defer></script>
    <script src="./script/scriptclock.js" defer></script>
    <script src="./script/nav.js" defer></script>


    <script >
        document.addEventListener("DOMContentLoaded", function(){
            <?php echo $script??"" ?>

        })
    function disableSub() {
        const useform = document.querySelector(".uselessform");
        const usebtn = document.querySelector(".registerbtn");
        usebtn.disabled=true;
        useform.onsubmit = e=> e.preventDefault()
        // Rétablit l'écouteur d'événements après un délai
        setTimeout(function() {
        usebtn.disabled=false;
        useform.onsubmit = undefined;

        }, 5000);
    }
    </script>
    
    <!-- <script src="/ressources/script/script.js" defer></script> -->
</head>
<body>
    <header>
    <div class="head">
            <div class="headerimg">
            <div class="img1">
                <div class="img1-content"></div>
            </div>
            <div class="img2">
                <div class="img2-content"></div>
            </div>
            <div class="img3">
                <div class="img3-content"></div>
            </div>
            </div>
            <div class="headertxt">
                <?php if(isset($_SESSION["username"])):?>
                <h2>Welcome Home <?php echo   $_SESSION["username"]?></h2>
                <?php endif;?>
            </div>
            <div class="headerwidjet">
            <div class="clock">
            <div class="hour">
                <div class="hr" id="hr"></div>
            </div>
            <div class="min">
                <div class="mn" id="mn"></div>
            </div>
            <div class="sec">
                <div class="sc" id="sc"></div>
            </div>
        </div>
            </div>
        </div>
        <div class="navigation">
            <ul>
                <li><button class="btn active" data-target="home">Home</button></li>
                <li><button class="btn" data-target="shortcuts">Shortcuts</button></li>
                <li><button class="btn" data-target="widgets">Widgets</button></li>
                <li><button class="btn" data-target="games">Games</button></li>
                <li><button class="btn" data-target="settings">Settings</button></li>
            </ul>
        </div>

    </header>

    <main class="class-main">
        
        <?php if(isset($_SESSION["flash"])):?>
            <div class="flash">
                <?= $_SESSION["flash"] ?>
            </div>
        <?php 
                unset($_SESSION["flash"]);
            endif;
        ?>



