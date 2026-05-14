<?php
session_start();
require_once("config.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
// Récupération des compteurs pour le dashboard
$userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$blogCount = $pdo->query("SELECT COUNT(*) FROM blog")->fetchColumn();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            flex: 0 0 250px;
            background: #343a40;
            color: #fff;
            padding: 20px;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #495057;
            color: #fff;
        }

        .content {
            flex: 1;
            padding: 20px;
            min-width: 0;
        }

        .stats-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            min-width: 720px;
        }

        .dataTables_wrapper .row {
            row-gap: 12px;
        }

        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            max-width: 100%;
            white-space: normal;
        }

        @media (max-width: 992px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex: 0 0 auto;
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
                padding: 14px;
            }

            .sidebar h4,
            .sidebar hr {
                width: 100%;
                margin-bottom: 4px;
            }

            .sidebar a {
                flex: 1 1 160px;
                text-align: center;
            }

            .content {
                padding: 16px;
            }
        }

        @media (max-width: 576px) {
            .content {
                padding: 12px;
            }

            .content h2 {
                font-size: 1.35rem;
            }

            .stats-card {
                margin-bottom: 12px;
            }

            .btn {
                white-space: normal;
            }

            .modal-dialog {
                margin: 10px;
            }

            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_length {
                text-align: left;
            }

            .dataTables_wrapper .dataTables_filter input,
            .dataTables_wrapper .dataTables_length select {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4><i class="fas fa-cogs me-2"></i>Admin</h4>
        <hr>
        <a href="#" class="active" data-page="dashboard"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
        <a href="#" data-page="users"><i class="fas fa-users me-2"></i>Utilisateurs</a>
        <a href="#" data-page="blog"><i class="fas fa-blog me-2"></i>Blog</a>
    </div>

    <!-- Contenu principal -->
    <div class="content">
        <div id="page-dashboard">
            <h2>Dashboard</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="stats-card">
                        <h3><?php echo $userCount ?></h3>
                        <p>Utilisateurs</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <h3><?php echo $blogCount ?></h3>
                        <p>Articles de blog</p>
                    </div>
                </div>
                <button class="btn btn-primary mb-3" id=""> <a href="deconnexion.php" class="btn btn-danger">Déconnexion
                    </a>
            </div>
        </div>

        <div id="page-users" style="display:none;">
            <h2>Gestion des utilisateurs</h2>
            <button class="btn btn-primary mb-3" id="btn-add"><i class="fas fa-plus"></i> Ajouter</button>


            </button>
            <div class="table-responsive">
            <table id="users-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            </div>
        </div>

        <div id="page-blog" style="display:none;">
            <h2>Gestion du blog</h2>
            <a class="btn btn-primary mb-3" href="ajouter_blog.php"><i class="fas fa-plus"></i>Ajouter un
                article</a>

            <div class="table-responsive">
            <table id="blog-table" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- Modal Utilisateur -->
    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="userForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Ajouter un utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="userId">
                        <div class="mb-3">
                            <label>Nom</label>
                            <input type="text" name="nom" id="nom" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Laisser vide pour ne pas changer">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Blog -->
    <div class="modal fade" id="blogModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="blogForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="blogModalTitle">Ajouter un article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="blogId">
                        <div class="mb-3">
                            <label>Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <h1>TinyMCE Quick Start Guide</h1>
                            <textarea id="summernote" name="editordata"></textarea>
                        </div>
                        <!-- date -->
                        <div class="mb-3">
                            <label></label>
                            <input type="datetime" name="date" id="date" style="display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Confirmation Suppression (réutilisé pour les deux) -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet élément ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
