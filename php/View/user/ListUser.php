<?php 
$title = "Liste des Utilisateurs";
require __DIR__. "/../../../ressources/template/_header.php";
if($users):
?>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $u):?>
                <tr>
                    <td><?= $u["userid"] ?></td>
                    <td><?= $u["username"] ?></td>
                    <td>
                        <a href="/ProjetBack/<?= $u["userid"] ?>">Voir les messages</a>
                        <?php if(isset($_SESSION["userid"]) && $_SESSION["userid"]==$u["userid"]):?>
                            &nbsp;|&nbsp;
                            <a href="/userupdate?id=<?= $u["userid"] ?>">éditer l'utilisateur</a>
                            &nbsp;|&nbsp;
                            <a href="/userdelete?id=<?= $u["userid"] ?>">supprimer l'utilisateur</a>
                        <?php endif;?>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php else:?>
    <p>Aucun utilisateur trouvé</p>
<?php endif;
require __DIR__. "/../../../ressources/template/_footer.php";?>