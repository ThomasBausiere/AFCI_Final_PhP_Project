<?php
require_once __DIR__. "/../services/_pdo.php";


/**
 * retourne les messages d'un utilisateur
 *
 * @param integer $idUser
 * @return array|false
 */


 function getAllMessages(): array
{
    // Je me connecte à la BDD
    $pdo = connexionPDO();
    // J'envoi la requête SQL
    $sql = $pdo->query("SELECT Messages.*, User.username FROM Messages INNER JOIN User ON User.userid=Messages.authorid");
    // Je récupère toutes les informations contenues dans la table Messages
    return $sql->fetchAll();
}

function getMessageByUser(int $idUser): array|false
{
    $pdo=connexionPDO();
    $sql =$pdo->prepare("SELECT * FROM messages WHERE userid =?");
    $sql->execute([$idUser]);
    return $sql->fetchAll();
}
/**
 * retourne un message via son id
 *
 * @param integer $id
 * @return array|false
 */
function getMessageById(int $id): array|false
{
    $pdo = connexionPDO();
    $sql=$pdo->prepare("SELECT * FROM messages WHERE idMessage =?");
    $sql->execute([$id]);
    return $sql->fetch();
}


/**
 * Ajoute un message dans la BDD
 *
 * @param integer $authorId de l'expediteur
 * @param string $content du message
 * @return void
 */
function addMessage(int $authorId, string $content): void
{
    $pdo=connexionPDO();
    $sql=$pdo->prepare("INSERT INTO Messages(authorid, content) VALUES(:userid, :message)");
    $sql->execute(["userid"=>$authorId, "message"=>$content]);
}
/**
 * Supprime un message via son id
 *
 * @param integer $id
 * @return void
 */
function deleteMessageById(int $id): void
{
    $pdo=connexionPDO();
    $sql=$pdo->prepare("DELETE FROM messages WHERE idMessage= ?");
    $sql->execute([$id]);
}

/**
 * Met a jour un message via son id
 *
 * @param integer $idMessage
 * @param string $content
 * @return void
 */
function updateMessageById(int $idMessage, string $content):void
{
    $pdo=connexionPDO();
    $sql=$pdo->prepare("UPDATE messages SET message=:m, editedAt =current_timestamp() WHERE idMEssage= :id");
    $sql->execute(["m" =>$content, "id"=>$idMessage]);
}

?>