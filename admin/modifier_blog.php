<?php
require_once "config.php";

$message = '';
$error = '';
$fatalError = '';
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$article = [
    'titre' => '',
    'contenu' => '',
];

if ($id <= 0) {
    $fatalError = "Article introuvable.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $titre = trim($_POST['titre'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');

    if ($titre === '' || $contenu === '') {
        $error = "Veuillez remplir tous les champs.";
        $article['titre'] = $titre;
        $article['contenu'] = $contenu;
    } else {
        $stmt = $pdo->prepare("UPDATE blog SET titre = ?, contenu = ?, date = NOW() WHERE id = ?");
        $stmt->execute([$titre, $contenu, $id]);

        if ($stmt->rowCount() > 0) {
            $message = "Article modifie avec succes.";
            header('Location: blog.php?page=blog');
        } else {
            $message = "Aucune modification effectuee.";
        }

        $article['titre'] = $titre;
        $article['contenu'] = $contenu;
    }
}

if ($id > 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $stmt = $pdo->prepare("SELECT id, titre, contenu FROM blog WHERE id = ?");
    $stmt->execute([$id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$article) {
        $fatalError = "Article introuvable.";
        $article = [
            'titre' => '',
            'contenu' => '',
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un article</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
            overflow-x: hidden;
        }

        .container {
            max-width: 900px;
        }

        form {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            padding: clamp(16px, 4vw, 28px);
        }

        .note-editor {
            width: 100%;
        }

        @media (max-width: 576px) {
            .d-flex {
                flex-direction: column;
            }

            .d-flex .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h1 class="h3 mb-4">Modifier un article</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <?php if ($error || $fatalError): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error ?: $fatalError); ?></div>
        <?php endif; ?>

        <?php if ($id > 0 && !$fatalError): ?>
            <form id="blogForm" action="modifier_blog.php?id=<?php echo $id; ?>" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" name="titre" id="titre" class="form-control"
                        value="<?php echo htmlspecialchars($article['titre'] ?? ''); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="summernote" class="form-label">Contenu</label>
                    <textarea name="contenu"
                        id="summernote"><?php echo htmlspecialchars($article['contenu'] ?? ''); ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="save" class="btn btn-primary">Mettre a jour</button>
                    <a class="btn btn-warning" href="blog.php?page=blog">Retour</a>
                </div>
            </form>
        <?php else: ?>
            <a class="btn btn-warning" href="blog.php?page=blog">Retour</a>
        <?php endif; ?>
    </div>

    <script>
        $('#summernote').summernote({
            placeholder: 'Contenu de l article',
            tabsize: 2,
            height: 220,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
</body>

</html>
