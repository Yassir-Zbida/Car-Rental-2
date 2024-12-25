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
    <form action="#" method="POST">
      <div class="mb-4">
        <label for="username" class="block text-white mb-2">Username</label>
        <div class="flex items-center bg-white/30 rounded-lg">
          <input
            type="text"
            id="username"
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
