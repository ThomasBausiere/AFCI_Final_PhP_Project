<?php 
require __DIR__ . "/../../ressources/services/_shouldBeLogged.php";
require_once __DIR__ . "/../Model/UserModel.php";
require_once __DIR__ . "/../Model/chatModel.php";



// require __DIR__ . "/../model/UserMongoModel.php";

function connexion()
{
    
    shouldBeLogged(false, "/");
    $errcount= $_SESSION["loginerror"]??0;
    $email = $pass = "";
    $error = [];
    $script = null;

    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['login']))
    {
        if(empty($_POST["useremail"]))
            $error["useremail"] = "Veuillez entrer un email";
        else
            $email = trim($_POST["useremail"]);

        if(empty($_POST["userpassword"]))
            $error["userpassword"] = "Veuillez entrer un password";
        else
            $pass = trim($_POST["userpassword"]);
        if (!is_csrf_valid())
        $error["login"]="Erreur Token";

        if(empty($error))
        {
            // Je regarde si j'ai un utilisateur qui correspond à l'email :
            $user = getOneUserByEmail($email);
            // Je vérifie si j'ai trouvé un utilisateur :
            if($user)
            {
                /* 
                    La fonction "password_verify()" permet de vérifier si un mot de passe non hashé correspond à un mot de passe hashé. 
                */
                if(password_verify($pass, $user["userpassword"]))
                {
                    /* 
                        Si notre email et notre mot de passe est bon.
                        On arrive ici, et on a plus qu'à sauvegarder les informations que l'on souhaite réutiliser d'une page à l'autre.
                    */
                    $_SESSION["logged"] = true;
                    $_SESSION["username"] = $user["username"];
                    $_SESSION["userid"] = $user["userid"];
                    $_SESSION["useremail"] = $email;
                    unset($_SESSION["loginerror"]);
                    // Et si je souhaite créer une durée limite de connexion
                    // $_SESSION["expire"] = time()+3600;
                    $user =isConnected($user["userid"]);
                    // Enfin je redirige mon utilisateur vers une autre page.

        
                    header("Location: /");
                    exit;
                }
                else
                {
                    $error["login"] = "Email ou Mot de Passe Incorrecte (password)";
                    $errcount++;
                    $_SESSION["loginerror"] = $errcount;
                    if($errcount>5){
                        $script= 'disableSub();';                        
                    }
                    // echo 'console.log(errcount)';
                }
            }
            else
            {
                $errcount++;
                $error["login"] = "Email ou Mot de Passe Incorrecte (email) $errcount";
                $_SESSION["loginerror"] = $errcount;
                if($errcount>5){
                    $script= 'disableSub();'; 
                }
                // echo 'console.log(errcount)';

            }
        }
    }

    require __DIR__."./../View/user/connexion.php";
}
function deconnexion()
{
    shouldBeLogged(true, "/");
    
    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600);
    
    header("Location: /");
    exit;
}


?>