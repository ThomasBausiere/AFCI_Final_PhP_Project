<?php
$title = " index.php";
require __DIR__ . "/ressources/services/_shouldBeLogged.php";

if(!isset($_SESSION["logged"])):        
        header("Location: /connexion");
        exit;
    ?>
<?php else: 
require(__DIR__."/ressources/template/_header.php");

require_once __DIR__ . "/php/Controller/chatController.php";


// echo   "<h1>Hello {$_SESSION['username']}</h1>"

?>

<div class="main-content">
    <div id="home" class="content home show">
        <div class="home-content">
            <img class="hc-img "src="./ressources/img/news/home.png" alt="">
            <div class="hc-txt">
                <h4>Welcome Home <?php echo   $_SESSION["username"]?></h4>
                <p>Le site est à ses débuts. Voici les lignes à suivres:</p>
                <ul>
                    <li>En prio: Settings</li>
                    <li>Ensuite: Shortcuts</li>
                    <li>widgets</li>
                </ul>
                <p>Enfin, une fois que ça c'est fini on pourra regarder pour ajouter des tables pour faire des nouvelles fonctionnalité, par exemple... des poste sur ce truc pour faire des nouveauté : reservé à l'admin par exemple ça peut etre sympa !! oulalal plein d'idée ici ! ça c'est du TDA/H faut aussi penser à faire ton dossier espece de noob</p>
            </div>
        </div>
    </div>
    <div id="shortcuts" class="content shortcuts hidden">

        <div class="mainblockshortcut">
            <div class="shortcutblock">
            <h3>Google</h3>
                <ul>
                    <li><a title="Google" href="https://Google.com" target="_blank">Google</a></li>
                    <li><a title="Drive" href="https://drive.google.com/drive/u/0/my-drive" target="_blank">Google Drive</a></li>
                    <li><a title="Sheet" href="https://docs.google.com/spreadsheets/u/0/" target="_blank">Google Sheet</a></li>
                    <li><a title="Doc" href="https://docs.google.com/document/u/0/" target="_blank">Google Doc</a></li>
                    <li><a title="Mail" href="https://mail.google.com/mail/u/0/" target="_blank">G-Mail</a></li>
                </ul>
            </div>
            
            <div class="shortcutblock">
                <h3>Video</h3>
                <ul>                
                    <li><a title="PrimeVideo" href="https://www.primevideo.com" target="_blank">PrimeVideo</a></li>
                    <li><a title="Netflix" href="https://netflix.com" target="_blank">NeTflix</a></li>
                    <li><a title="Disney" href="https://disneyplus.com" target="_blank">Disney+</a></li>
                    <li><a title="Youtube" href="https://youtube.com" target="_blank">Youtube</a></li>
                    <li><a title="MyCanal" href="https://www.mycanal.com" target="_blank">My Canal</a></li>
                    <li><a title="Paramount" href="https://paramount.com" target="_blank">Paramount</a></li>
                </ul>
            </div>
            <div class="shortcutblock">
                <h3>Outils</h3>
                <ul>
                    <li><a title="Chat GPT" href="https://chat.openai.com/chat" target="_blank">Chat GPT</a></li></li>
                    <li><a title="Midjourney" href="https://www.midjourney.com/app/" target="_blank">Mid Journey </a></li></li>      
                    <li><a title="GitHub" href="https://github.com" target="_blank">Github </a></li></li>    
                </ul> 
            </div> 
        </div>     
    </div>
    <div id="widgets" class="content widgets hidden">
        Contenu Widgets
    </div>
    <div id="games" class="content games hidden">
        Contenu Jeux
    </div>
    <div id="settings" class="content settings hidden">
    
        <div class="read">
                <h3>Vos Informations...</h3>
                
                        <p> <strong><b>Pseudo</b></strong>: <i><?php echo $_SESSION["username"] ?></i>.</p>
                        <p><strong><b>E-mail</b></strong>: <i><?php echo $_SESSION["useremail"]?></i>.</p>
                        <p><strong><b>Password</b></strong>: <i></i>*********.</p>
                
                <a id="updatetoggle"class="btn2" href="/userupdate">Modifier</a>
        </div>  


    </div>
</div>        
<div class="blockChat">
    <pre class="chat"></pre>
    <div class="btnChat">
        <input type="text" id="message">
        <button id="sendMessage">></button>
    </div>
</div>
<?php 
endif;
require(__DIR__."/ressources/template/_footer.php");
?>