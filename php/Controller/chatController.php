<?php 
// require __DIR__ . "/../../ressources/services/_csrf.php";
require_once __DIR__ . "/../../ressources/services/_pdo.php";
require __DIR__ . "/../Model/chatModel.php";
require __DIR__ . "/../Model/UserModel.php";


function usersConnected()
{
    getAllUsers();
    $users = getUserByConnection();
    //afficher les user connectés
    echo "<h2>Users logged</h2>";
    echo "<ul>";
    foreach($users as $user){
        echo "<li>". $user['username']. "</li>";
    }
    "</ul>";
}