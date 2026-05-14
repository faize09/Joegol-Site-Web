<?php
$host = 'localhost';
$dbname = 'joegol';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Gestion des actions CRUD via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $response = ['success' => false, 'message' => ''];

    switch ($action) {
        // --- Users CRUD (existing) ---
        case 'create':

            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';

            // Hash du mot de passe
            $password = md5($_POST['password']);

            $stmt = $pdo->prepare("
        INSERT INTO users (nom, prenom, email, password)
        VALUES (?, ?, ?, ?)
    ");

            if ($stmt->execute([$nom, $prenom, $email, $password])) {

                $response['success'] = true;
                $response['message'] = 'Utilisateur ajouté.';
            }

            break;
        case 'update':
            $id = $_POST['id'] ?? 0;
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = !empty($_POST['password']) ? md5($_POST['password']) : null;
            if ($password) {
                $stmt = $pdo->prepare("UPDATE users SET nom=?, prenom=?, email=?, password=? WHERE id=?");
                $stmt->execute([$nom, $prenom, $email, $password, $id]);
            } else {
                $stmt = $pdo->prepare("UPDATE users SET nom=?, prenom=?, email=? WHERE id=?");
                $stmt->execute([$nom, $prenom, $email, $id]);
            }
            $response['success'] = true;
            $response['message'] = 'Utilisateur mis à jour.';
            break;
        case 'delete':
            $id = $_POST['id'] ?? 0;
            $stmt = $pdo->prepare("DELETE FROM users WHERE id=?");
            $stmt->execute([$id]);
            $response['success'] = true;
            $response['message'] = 'Utilisateur supprimé.';
            break;
        case 'read':
            $stmt = $pdo->query("SELECT id, nom, prenom, email FROM users");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response['success'] = true;
            $response['data'] = $users;
            break;
        case 'get':
            $id = $_POST['id'] ?? 0;
            $stmt = $pdo->prepare("SELECT id, nom, prenom, email FROM users WHERE id=?");
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $response['success'] = true;
            $response['data'] = $user;
            break;

        // --- Blog CRUD (new) ---
        case 'create_blog':
            $titre = $_POST['titre'] ?? '';
            $contenu = $_POST['contenu'] ?? '';
            $date = date('Y-m-d H:i:s');
            $stmt = $pdo->prepare("INSERT INTO blog (titre, contenu, date) VALUES (?, ?, ?)");
            if ($stmt->execute([$titre, $contenu, $date])) {
                $response['success'] = true;
                $response['message'] = 'Article ajouté.';
            }
            break;
        case 'read_blog':
            $stmt = $pdo->query("SELECT id, titre, contenu, date FROM blog ORDER BY date DESC");
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response['success'] = true;
            $response['data'] = $articles;
            break;
        case 'get_blog':
            $id = $_POST['id'] ?? 0;
            $stmt = $pdo->prepare("SELECT id, titre, contenu FROM blog WHERE id=?");
            $stmt->execute([$id]);
            $article = $stmt->fetch(PDO::FETCH_ASSOC);
            $response['success'] = true;
            $response['data'] = $article;
            break;
        case 'update_blog':
            $id = $_POST['id'] ?? 0;
            $titre = $_POST['titre'] ?? '';
            $contenu = $_POST['contenu'] ?? '';
            $stmt = $pdo->prepare("UPDATE blog SET titre=?, contenu=?, date=NOW() WHERE id=?");
            $stmt->execute([$titre, $contenu, $id]);
            $response['success'] = true;
            $response['message'] = 'Article mis à jour.';
            break;
        case 'delete_blog':
            $id = $_POST['id'] ?? 0;
            $stmt = $pdo->prepare("DELETE FROM blog WHERE id=?");
            $stmt->execute([$id]);
            $response['success'] = true;
            $response['message'] = 'Article supprimé.';
            break;
    }
    echo json_encode($response);
    exit;
}
