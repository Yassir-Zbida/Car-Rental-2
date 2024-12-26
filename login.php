<?php

session_start();
require_once 'db.php';
$db = new Database();
$connection = $db->getConnection();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param('s', $username); // 's' indique un string
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password_hash'])) {
                
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Nom d'utilisateur ou mot de passe incorrect.";
            }

            $stmt->close();
        } else {
            $error = "Erreur lors de la préparation de la requête SQL.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-image: url('./assets/login-bg.png');
      background-size: cover;
      background-position: center;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen">
  <div class="bg-white/20 backdrop-blur-md p-6 rounded-lg shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-semibold text-white text-center mb-6">Login</h2>
    <form action="login.php" method="POST">
    <?php if (!empty($error)): ?>
            <p class="text-red-500 text-center mb-4"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
      <div class="mb-4">
        <label for="username" class="block text-white mb-2">Username</label>
        <div class="flex items-center bg-white/30 rounded-lg">
          <input
            type="text"
            id="username"
            name="username"
            placeholder="Username"
            class="bg-transparent text-white flex-grow px-4 py-2 outline-none"
          />
          <span class="text-white pr-4">
            <i class="ri-user-line"></i>
          </span>
        </div>
      </div>
      <div class="mb-4">
        <label for="password" class="block text-white mb-2">Password</label>
        <div class="flex items-center bg-white/30 rounded-lg">
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Password"
            class="bg-transparent text-white flex-grow px-4 py-2 outline-none"
          />
          <span class="text-white pr-4">
            <i class="ri-lock-line"></i>
          </span>
        </div>
      </div>
      <div class="flex items-center justify-between text-white mb-6">
        <label class="flex items-center">
          <input type="checkbox" class="mr-2" />
          Remember Me
        </label>
        <a href="#" class="hover:underline">Forget Password</a>
      </div>
      <button
        type="submit"
        name="submit"
        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition"
      >
        Login
      </button>
      <p class="text-center text-white mt-4">
        Don't have an account? <a href="#" class="hover:underline">Register</a>
      </p>
    </form>
  </div>
  <script src="https://unpkg.com/@iconify/iconify@1.0.7/iconify.min.js"></script>
</body>
</html>
