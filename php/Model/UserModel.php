<?php 
require_once __DIR__ . "../../../ressources/services/_pdo.php";

/**
 * récupère tous les utilisateurs
 *
 * @return array
 */
function getAllUsers(): array
{
    // Je me connecte à la BDD
    $pdo = connexionPDO();
    // J'envoi la requête SQL
    $sql = $pdo->query("SELECT userid, username FROM User");
    // Je récupère toute les informations
    return $sql->fetchAll();
}
/**
 * Selectionne un utilisateur par son email.
 *
 * @param string $email
 * @return array|boolean
 */
function getOneUserByEmail(string $email): array|bool
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM User WHERE useremail = ?");
    $sql->execute([$email]);
    // Je récupère la première information trouvé.
    return $sql->fetch();
}
/**
 * récupère un utilisateur via son id
 *
 * @param string $id
 * @return array|boolean
 */
function getOneUserById(string $id): array|bool
{
    $pdo = connexionPDO();
    
    $sql = $pdo->prepare("SELECT * FROM User WHERE userid = :id");
   
    $sql->execute(["id"=>$id]);
    return $sql->fetch();
}
/**
 * récuperer un user via son nom
 *
 * @param string $id
 * @return array|boolean
 */
function getOneUserByName(string $username): array|bool
{
    $pdo = connexionPDO();
    
    $sql = $pdo->prepare("SELECT * FROM User WHERE username = :us");
   
    $sql->execute(["us"=>$username]);
    return $sql->fetch();
}
/**
 * Ajoute un utilisateur en BDD *
 * @param string $us nom d'utilisateur
 * @param string $em email
 * @param string $pass mot de passe
 * @return void
 */
function addUser(string $us, string $em, string $pass): void
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("INSERT INTO User(username, useremail, userpassword) VALUES(?, ?, ?)");
    $sql->execute([$us, $em, $pass]);
}
/**
 * Supprime un utilisateur via son ID *
 * @param string $id
 * @return void
 */
function deleteUserById(string $id): void
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("DELETE FROM User WHERE userid=:id");
    $sql->bindParam("id", $id);
    $sql->execute();
}
/**
 * Met à jour l'utilisateur via son id
 *
 * @param string $username nom d'utilisateur
 * @param string $email email
 * @param string $password mot de passe
 * @param string $id
 * @return void
 */
function updateUserByID(string $username, string $email, string $password, string $id): void
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("UPDATE User SET username=:us, useremail=:em, userpassword=:mdp WHERE userid = :id");
    $sql->execute([
        "id"=>(int)$id,
        "mdp"=>$password,
        "em"=>$email,
        "us"=>$username
    ]);
}
?>