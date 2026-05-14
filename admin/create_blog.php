<?php
require_once "config.php";

if (isset($_POST['save'])) {

    $titre = trim($_POST['titre']);
    $contenu = trim($_POST['contenu']);
    $date = date('Y-m-d H:i:s');
    if (!empty($titre) && !empty($contenu)) {

        $stmt = $pdo->prepare("
INSERT INTO blog(titre, contenu, date)
VALUES(?, ?, ?)
");

        if ($stmt->execute([$titre, $contenu, $date])) {

            echo "Article ajouté avec succès";
            header('Location: blog.php?page=blog');
        } else {

            echo "Erreur insertion";
        }
    } else {

        echo "Veuillez remplir tous les champs";
    }
}
