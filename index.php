<?php
session_start();
if (isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css"> <!-- use main website style variables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    /* --- Smooth Fade Animations --- */
    body {
      opacity: 0;
      transition: opacity 0.8s ease-in-out;
    }

    body.loaded {
      opacity: 1;
    }

    /* --- Main Login Page Styles --- */
    body.login-page {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: url("images/background.jpg") no-repeat center center fixed;
      background-size: cover;
      font-family: "Poppins", sans-serif;
    }

    body.login-page::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
      z-index: -1;
    }

    .login-container {
      background-color: rgba(255, 255, 255, 0.5);
      width: 450px;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }

    .login-container h1 {
      text-align: center;
      color: var(--primaryColor);
      margin-bottom: 1rem;
    }

    .input-group {
      display: flex;
      align-items: center;
      background: var(--greyColor);
      border-radius: 8px;
      margin: 1rem 0;
      padding: 0.5rem;
      position: relative;
      transition: box-shadow 0.2s ease;
    }

    .input-group:hover {
      box-shadow: 0 0 8px rgba(14, 98, 83, 0.4);
    }

    .input-group i {
      color: var(--primaryColor);
      margin: 0 10px;
      cursor: pointer;
    }

    .input-group input {
      border: none;
      background: transparent;
      flex: 1;
      padding: 8px;
      font-size: 14px;
    }

    .input-group input:hover {
      box-shadow: 0 0 6px rgba(14, 98, 83, 0.3);
      border-radius: 6px;
    }

    .input-group input:focus {
      outline: none;
      box-shadow: 0 0 6px rgba(255, 193, 7, 0.6);
      border-radius: 6px;
    }

    .input-group .toggle-eye {
      position: absolute;
      right: 12px;
      color: var(--darkGreyColor);
      cursor: pointer;
      transition: color 0.2s ease;
    }

    .input-group .toggle-eye:hover {
      color: var(--secondaryColor);
    }

    .btn {
      width: 100%;
      padding: 10px;
      background: var(--primaryColor);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1.1rem;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 1rem;
    }

    .btn:hover {
      background: var(--secondaryColor);
      color: var(--blackColor);
    }

    .recover {
      text-align: right;
      font-size: 15px;
      margin-top: -5px;
      margin-bottom: 10px;
    }

    .recover a {
      color: var(--primaryColor);
      text-decoration: none;
    }

    .recover a:hover {
      color: var(--secondaryColor);
      text-decoration: underline;
    }

    .links,
    .or {
      text-align: center;
      margin-top: 1rem;
      font-size: 17px;
    }

    .links a {
      color: var(--primaryColor);
      font-weight: 600;
      text-decoration: none;
    }

    .links a:hover {
      color: var(--secondaryColor);
    }

    .icons {
      text-align: center;
      margin-top: 1rem;
    }

    .icons i {
      margin: 0 8px;
      font-size: 25px;
      color: var(--primaryColor);
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .icons i:hover {
      color: var(--secondaryColor);
      transform: scale(1.2);
    }

    .error-main {
      background: brown;
      padding: 0.5rem;
      border-radius: 8px;
      margin-bottom: 1rem;
    }

    .error-main p {
      color: white;
      text-align: center;
    }

    .error p {
      color: red;
      font-size: 13px;
      margin: 5px 0 0 40px;
    }
  </style>
</head>

<body class="login-page">
  <div class="login-container">
    <h1>Welcome Back!!</h1>
    <h1>Login</h1>

    <?php if (isset($errors['login'])): ?>
      <div class="error-main">
        <p><?= $errors['login'] ?></p>
      </div>
      <?php unset($errors['login']); ?>
    <?php endif; ?>

    <form method="POST" action="user-account.php">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <?php if (isset($errors['email'])): ?>
          <div class="error">
            <p><?= $errors['email'] ?></p>
          </div>
        <?php endif; ?>
      </div>

      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <i class="fa fa-eye toggle-eye" id="togglePassword"></i>
        <?php if (isset($errors['password'])): ?>
          <div class="error">
            <p><?= $errors['password'] ?></p>
          </div>
        <?php endif; ?>
      </div>

      <p class="recover"><a href="#">Forget Password?</a></p>

      <button type="submit" class="btn" name="signin">Sign In</button>
    </form>

    <p class="or">---------- or ----------</p>

    <div class="icons">
      <i class="fab fa-google"></i>
      <i class="fab fa-facebook"></i>
    </div>

    <div class="links">
      <p>Don't have an account yet? <a href="register.php">Sign Up</a></p>
    </div>
  </div>

  <script>
    // Password show/hide toggle
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");
    togglePassword.addEventListener("click", () => {
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      togglePassword.classList.toggle("fa-eye-slash");
    });

    // Fade-in when page loads
    window.addEventListener("load", () => {
      document.body.classList.add("loaded");
    });

    // Fade-out before navigating to another page
    document.querySelectorAll("a").forEach(link => {
      link.addEventListener("click", e => {
        const href = link.getAttribute("href");
        if (!href || href.startsWith("#") || href.startsWith("javascript:")) return;
        e.preventDefault();
        document.body.classList.remove("loaded");
        setTimeout(() => {
          window.location.href = href;
        }, 500);
      });
    });
  </script>
</body>

</html>

<?php
if (isset($_SESSION['errors'])) {
  unset($_SESSION['errors']);
}
?>