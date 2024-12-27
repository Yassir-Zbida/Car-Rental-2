<?php
session_start(); // Démarrer la session
require_once 'db.php';

class User {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function register($username, $email, $password) {
        // Vérifier si l'email existe déjà
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "Cet email est déjà enregistré.";
        }

        // Valider les données
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Adresse email invalide.";
        }
        if (strlen($password) < 8) {
            return "Le mot de passe doit contenir au moins 8 caractères.";
        }

        // Hasher le mot de passe
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insérer un nouvel utilisateur avec le rôle 'client'
        $sql = "INSERT INTO users (username, email, password_hash, role, created_at, updated_at) VALUES (?, ?, ?, 'client', NOW(), NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $passwordHash);

        if ($stmt->execute()) {
            $_SESSION['user_id'] = $this->db->insert_id; // ID de l'utilisateur enregistré
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            return "Compte créé avec succès ! Vous êtes connecté.";
        } else {
            return "Erreur lors de l'inscription : " . $this->db->error;
        }
    }
}

$message = "";

// Traiter le formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['nom_utilisateur']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['mot_de_passe']);

    $database = new Database();
    $user = new User($database);
    $message = $user->register($username, $email, $password);

    // Rediriger si l'inscription est réussie
    if (isset($_SESSION['user_id'])) {
        header("Location: ./client/listings.php");
        exit;
    }

    $database->closeConnection();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<style>
    body {
      background-image: url('./assets/login-bg.png');
      background-size: cover;
      background-position: center;
    }
</style>
<body class="flex items-center justify-center min-h-screen">

<div class="bg-white/20 backdrop-blur-md p-6 rounded-lg shadow-lg w-full max-w-md">
<h2 class="text-2xl font-semibold text-white text-center mb-6">Register</h2>

        <?php if (!empty($message)): ?>
            <div class="mb-4">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="#" method="POST">
            
            <div class="mb-4">
                <label for="nom" class="block text-white mb-2">Nom d'utilisateur</label>
                <div class=" bg-white/30 rounded-lg">
                <input type="text" id="nom" name="nom_utilisateur" placeholder="Votre nom" class="w-full placeholder-white/80 bg-transparent text-white flex-grow px-4 py-2 outline-none" required>
                </div>            
            </div>

            <div class="mb-4">
                <label for="email" class="block text-white mb-2">Email</label>
                <div class=" bg-white/30 rounded-lg">
                    <input type="email" id="email" name="email" placeholder="Votre email" class="placeholder-white/80 w-full bg-transparent text-white flex-grow px-4 py-2 outline-none" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-white mb-2">Mot de passe</label>
                <div class=" bg-white/30 rounded-lg">
                    <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" class="w-full  placeholder-white/80 rounded-lg bg-transparent text-white flex-grow px-4 py-2 outline-none" required>
                </div>
            </div>
            
            <button type="submit" name='submit'class="w-full mt-3 bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition">
                Create Account
            </button>
            <p class="text-center text-white mt-4">have an account? <a href="login.php" class="hover:underline text-black">login</a>
      </p>
        </form>
    </div>

</body>
</html>