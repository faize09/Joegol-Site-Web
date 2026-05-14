<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>without bootstrap</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
            padding: clamp(12px, 4vw, 32px);
        }

        form {
            width: min(100%, 900px);
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .modal-footer {
            gap: 10px;
            flex-wrap: wrap;
        }

        .note-editor {
            width: 100%;
        }

        @media (max-width: 576px) {
            .modal-body,
            .modal-footer {
                padding: 1rem;
            }

            .modal-footer .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <form id="userForm" action="create_blog.php" method="POST">
        <div class="modal-body">
            <div class="mb-3">
                <label>Titre</label>
                <input type="text" name="titre" id="nom" class="form-control" required>
            </div>
            <label>Contenu</label>
            <textarea name="contenu" id="summernote"></textarea>
        </div>
        <div class="modal-footer">
            <button type="submit" name="save" class="btn btn-primary">Enregistrer</button>
            <a class="btn btn-warning mb-3" href="blog.php?page=blog"><i class="fas fa-plus"></i>Retour</a>
        </div>
    </form>

    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
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
