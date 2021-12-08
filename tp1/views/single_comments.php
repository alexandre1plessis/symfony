<?php

include "../models/database.php";

$base = initDatabse();
$postid = $_GET['postid'];
$query = "SELECT * FROM comments where post_id = $postid";
$req = $base->query($query);

?>

<h1>Liste des commentaires</h1>

<table>
    <tr>
        <th>#</th>
        <th>Description</th>
        <th>Créé le</th>
    </tr>
    <?php


        while($row = $req->fetch()) {
            echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            echo '<td>'.$row['created_at'].'</td>';
            echo '</tr>';
        }
    ?>
</table>
<a href="../index.php">retour</a>