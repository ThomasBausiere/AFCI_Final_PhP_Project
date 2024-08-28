<?php

require_once __DIR__ . "../../../ressources/services/_pdo.php";

function isConnected(int $userid){
    $pdo =connexionPDO();
    $sql= $pdo->prepare("UPDATE User SET statutConnexion = TRUE WHERE userid =?");
    $sql->execute([$userid]);
    return $sql->fetch();
}

function getUserByConnection(): array|false{
    $pdo =connexionPDO();
    $sql= $pdo->query("SELECT * FROM User WHERE statutConnexion = TRUE");
    return $sql->fetchAll();
}

function isDisconnected(int $userid){
    $pdo =connexionPDO();
    $sql= $pdo->prepare("UPDATE User SET statutConnexion = FALSE WHERE userid =?");
    $sql->execute([$userid]);
    return $sql->fetch();
}