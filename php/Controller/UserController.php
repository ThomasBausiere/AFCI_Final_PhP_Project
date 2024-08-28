<?php 
// require __DIR__ . "/../../ressources/services/_csrf.php";
require __DIR__ . "/../../ressources/services/_shouldBeLogged.php";
require __DIR__ . "/../Model/UserModel.php";



/**
 * Gère ma page listant les utilisateur
 *
 * @return void
 */
function listUsers():void
{
    $users = getAllUsers();

    require __DIR__ . "/../view/user/ListUser.php";
}
/**
 * Gère ma page d'inscription
 *
 * @return void
 */
function inscription():void
{
    $username = $email = $password = "";
    $error = [];
    $regexPass = "/^(?=.*[0-9])(?=.*[a-zA-Z]).{6,}$/";
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['inscription']))
    {
        // Traitement username 
        if(empty($_POST["username"]))
        {
            $error["username"] = "Veuillez saisir un nom d'utilisateur";
        }
        else
        {
            $username = clean_data($_POST["username"]);
            if(!preg_match("/^[a-zA-Z' -]{2,25}$/", $username))
            {
                $error["username"] = "Veuillez saisir un nom d'utilisateur valide";
            }
            $resultat = getOneUserByName($username);
            if($resultat)
            {
                $error["username"] = "Ce pseudo est déjà enregistré";
            }
        }
        // Traitement email
        if(empty($_POST["useremail"]))
        {
            $error["useremail"] = "Veuillez saisir un email";
        }
        else
        {
            $email = clean_data($_POST["useremail"]);

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error["useremail"] = "Veuillez saisir un email valide";
            }
            $resultat = getOneUserByEmail($email);
            if($resultat)
            {
                $error["useremail"] = "Cet email est déjà enregistré";
            }
        }
        // Traitement password
        if(empty($_POST["userpassword"]))
        {
            $error["userpassword"] = "Veuillez saisir un mot de passe";
        }
        else
        {
            $password = trim($_POST["userpassword"]);
            if(!preg_match($regexPass, $password))
            {
                $error["userpassword"] = "Votre mot de passe doit contenir au minimum une lettre (majuscule ou minuscule) et un chiffre, avec une longueur minimale de 6.";
            }
            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        // Traitement vérification du mot de passe
        if(empty($_POST["userpasswordBis"]))
        {
            $error["userpasswordBis"] = "Veuillez saisir à nouveau votre mot de passe";
        }
        else if($_POST["userpasswordBis"] !== $_POST["userpassword"])
        {
            $error["userpasswordBis"] = "Veuillez saisir le même mot de passe";
        }
        // Envoi des données :
        if(empty($error))
        {
            addUser($username, $email, $password);
            
            header("Location: /");
            exit;
        }
    }
    require __DIR__."./../View/user/inscription.php";
}
/**
 * Gère ma page de suppression d'utilisateur
 *
 * @return void
 */
function deleteUser():void
{
    // L'utilisateur doit être connecté
    shouldBeLogged(true, "/");
    // L'utilisateur connecté est-il celui que l'on tente de supprimer
    if(empty($_SESSION["userid"] ))
    {
        header("Location: /");
        exit;
    }
    deleteUserById(($_SESSION["userid"] ));

    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600);

    header("refresh: 5;url= /");

    require __DIR__ ."/../View/user/delete.php";
}
/**
 * Gère la page de mise à jour de l'utilisateur
 *
 * @return void
 */
function updateUser(): void
{
    // Si l'utilisateur n'est pas connecté ou si il n'est pas le propriétaire de ce profil, on le redirige.
    
    if(empty($_SESSION["userid"] ))
    {
        header("Location: /");
        exit;
    }
    $user = getOneUserById($_SESSION["userid"]);
    
    $username = $password = $email = "";
    $error = [];
    $regexPass = "/^(?=.*[0-9])(?=.*[a-zA-Z]).{6,}$/";

    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update']))
    {
        // Traitement username
        // Si le champ est vide, je garde celui en BDD
        if(empty($_POST["username"]))
        {
            $username = $user["username"];
        }
        else
        {
            $username = clean_data($_POST["username"]);
            if(!preg_match("/^[a-zA-Z' -]{2,25}$/", $username))
            {
                $error["username"] = "Votre nom d'utilisateur ne peut contenir que des lettres";
            }
            $resultat = getOneUserByName($username);
            if($resultat)
            {
                $error["username"] = "Ce pseudo n'est pas disponible";
            }
            
        }
        // Traitement email
        if(empty($_POST["useremail"]) || ($_POST["useremail"]=== $user["useremail"]))
        {
            $email = $user["useremail"];
        }
        else
        {
            $email = clean_data($_POST["useremail"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error["useremail"] = "Veuillez entrer un email valide";
            }
            elseif($email != $user["useremail"])
            {
                $exist = getOneUserByEmail($email);
                
                if($exist)
                {
                    $error["useremail"] = "Ce email existe déjà";
                }
            }
        }
        // traitement du mot de passe
        if(empty($_POST["userpassword"]))
        {
            $password = $user["userpassword"];
        }
        elseif(empty($_POST["userpasswordBis"]))
        {
            $error["userpasswordBis"] = "Votre mot de passe doit contenir au minimum une lettre (majuscule ou minuscule) et un chiffre, avec une longueur minimale de 6.";
        }
        elseif($_POST["userpassword"] != $_POST["userpasswordBis"])
        {
            $error["userpasswordBis"] = "Veuillez saisir le même mot de passe";
        }
        else
        {
            $password = trim($_POST["userpassword"]);
            if(!preg_match($regexPass, $password))
            {
                $error["userpassword"] = "Votre mot de passe doit contenir au minimum une lettre (majuscule ou minuscule) et un chiffre, avec une longueur minimale de 6.";
            }
            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        // Envoi des données:
        if(empty($error))
        {
            updateUserByID($username, $email, $password, $user["userid"]);
            $_SESSION["username"]=$username;
            $_SESSION["useremail"]=$email;
            header("Location: /");
            exit;
        }
    }


    require __DIR__."/../View/user/update.php";
}
?>