<?php

require __DIR__. "/../../ressources/services/_shouldbelogged.php";
require __DIR__. "/../model/UserModel.php";
require __DIR__. "/../model/MessageModel.php";

/**
 * Gérere la page d'affichage des messages
 *
 * @return void
 */
function readMessage($id):void{
    $id=(int)$id;
    //Si autre chose qu'un nombre est donné en argument, on redirige ailleurs.
    if($id === 0)
    {
        header("Location: /userlist");
        exit;
    }
    $user = getOneUserById($id);
    if(!$user)
    {
        header("Location: /userlist");
        exit;
    }
    $messages= getMessageByUser($id);

    require __DIR__."/../view/message/listMessage.php";
}

/**
 * Gére la création des messages
 *
 * @return void
 */
function createMessage():void{
    shouldBeLogged(true, "/login");
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['addMessage']))
    {
        if(empty($_POST["message"]))
        {
            $_SESSION["flash"]= "Veuillez entrer un message";
        }
        else
        {
            $message = clean_data($_POST["message"]);
            addMessage(["message"=>$message, "idUser"=>$_SESSION["idUser"]]);
            $_SESSION["flash"]= "Message envoyé";

        }
    }
    goToListMessage();
}
/**
 * Gere la suppression de message
 *
 * @param string $id
 * @return void
 */
function deleteMessage(string $id):void{
    shouldBeLogged(true, "/login");
    $id=(int) $id;
    if($id===0)
    {
        goToListMessage("id_inexistante");
    }
    $message= getMessageById($id);
    //Si il n'y a pas de message avec cet id ou si l'utilisateur connecté n'est pas l'auteur du message.
    if(!$message || $message["idUser"] != $_SESSION["idUser"])
    {
        goToListMessage("Impossible de supprimer le message");
    }
    //DRY
    deleteMessageById($id);
    goToListMessage("Message supprimé");
}
/**
 * Gere la page d'édition de message
 *
 * @param string $id
 * @return void
 */
function updateMessage(string $id):void
{
    shouldBeLogged(true, "/login");
    $id=(int)$id;
    if($id===0)
    {
        goToListMessage("Id inexistant");
    }
    $message=getMessageById($id);
    //Si je n'ai pas de message à cet id ou si l'utilisateur connecté n'est pas son auteur, alors on le redirige.
    if(!$message || $message["idUser"] != $_SESSION["idUser"])
    {
        goToListMessage("Impossible d'éditer ce message");
    }

    $error= $m ="";
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['editMessage']))
    {
        if(empty($_POST["message"]))
        {
            $m = $message["message"];
        }
        else
        {
            $m =clean_data($_POST["message"]);
        }
        updateMessageById($id, $m);
        goToListMessage("message edité");
    }
    require __DIR__."/../view/message/updateMessage.php";
}


/**
 * redirection
 *
 * @param string|null|null $message
 * @return void
 */
function goToListMessage(string|null $message =null):void{
    if($message){
        $_SESSION["flash"] =$message;
    }
    header("Location: /blog/".$_SESSION["idUser"]);
    exit;
}