<?php

include "models/database.php";

$base = initDatabse();

$query = "SELECT * FROM posts";
$req = $base->query($query);
$postid = 0;

?>



<h1>Liste des posts</h1>

<table>
    <tr>
        <th>#</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Actif ?</th>
        <th>Créé le</th>
        <th>Commentaires</th>
    </tr>
    <?php

        while($row = $req->fetch()) {
            $postid += 1;
            echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['title'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            if($row['active']){
                echo '<td>Oui</td>';
            }
            else {
                echo '<td>Non</td>';
            }
            echo '<td>'.$row['created_at'].'</td>';
            echo '<td><a href="views/single_comments.php?postid='.$postid.'">voir</a></td>';
            echo '</tr>';
        }
    ?>
</table>