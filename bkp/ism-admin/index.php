<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 500px;
    }
    .login-container h2 {
      text-align: center;
    }
    .login-container form {
      display: flex;
      flex-direction: column;
    }
    .login-container form input {
      margin-bottom: 10px;
      padding: 8px;
      border-radius: 3px;
      border: 1px solid #ccc;
    }
    .login-container form button {
      padding: 8px 12px;
      border: none;
      border-radius: 3px;
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
    }
    .login-container form button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
<div class="login-container">
  <h2>Login</h2>
  <form method="post" action="login.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
</div>

</body>
</html>
