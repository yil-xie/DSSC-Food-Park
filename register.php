<?php
session_start();
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']); // ✅ move this here, before output starts
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* --- Smooth Fade-in and Fade-out Animation --- */
        body {
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }

        body.loaded {
            opacity: 1;
        }

        /* --- Original Page Styles --- */
        body.register-page {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url("images/test.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: "Poppins", sans-serif;
        }

        body.register-page::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.5);
            width: 450px;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.25);
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            color: #0e6253;
        }

        .input-group {
            position: relative;
            margin: 1em 0;
            background: #f9f9f9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            padding: 0.6em;
            transition: box-shadow 0.2s ease;
        }

        .input-group:hover {
            box-shadow: 0 0 6px rgba(14, 98, 83, 0.4);
        }

        .input-group i {
            color: #0e6253;
            margin-right: 8px;
        }

        .input-group input {
            border: none;
            flex: 1;
            padding: 8px;
            font-size: 14px;
            background: transparent;
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

        .input-group .fa-eye,
        .input-group .fa-eye-slash {
            cursor: pointer;
            color: #888;
            transition: color 0.3s ease;
        }

        .input-group .fa-eye:hover,
        .input-group .fa-eye-slash:hover {
            color: #ffde24ff;
        }

        .btn {
            font-size: 1.1rem;
            padding: 0.6em;
            border-radius: 8px;
            border: none;
            width: 100%;
            background: #0e6253;
            color: white;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 0.5em;
            font-weight: 600;
        }

        .btn:hover {
            background: #ffc107;
            color: #222;
        }

        .or {
            text-align: center;
            margin: 1rem 0;
            color: #555;
        }

        .icons {
            text-align: center;
            margin-bottom: 1rem;
        }

        .icons i {
            margin: 0 10px;
            font-size: 1.5rem;
            color: #0e6253;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .icons i:hover {
            transform: scale(1.2);
            color: #ffc107;
        }

        .links {
            text-align: center;
            margin-top: 1rem;
        }

        .links a {
            color: #0e6253;
            font-weight: bold;
            text-decoration: none;
        }

        .links a:hover {
            color: #ffc107;
        }

        .error-main {
            background-color: brown;
            padding: 0.5em 1em;
            border-radius: 8px;
            margin: 0.5em 0;
            text-align: center;
            color: white;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>

<body class="register-page">
    <div class="container" id="signup">
        <h1 class="form-title">Register</h1>

        <?php if (isset($errors['user_exist'])): ?>
            <div class="error-main">
                <p><?= $errors['user_exist'] ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="user-account.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" id="name" placeholder="Name" required>
            </div>

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>

            <div class="input-group password">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i id="togglePassword" class="fa fa-eye"></i>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <i id="toggleConfirm" class="fa fa-eye"></i>
            </div>

            <input type="submit" class="btn" value="Sign Up" name="signup">
        </form>

        <p class="or">---------- or --------</p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>
        <div class="links">
            <p>Already have an account? <a href="index.php">Sign In</a></p>
        </div>
    </div>

    <script>
        // Toggle for password field
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("password");
        togglePassword.addEventListener("click", () => {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            togglePassword.classList.toggle("fa-eye-slash");
        });

        // Toggle for confirm password
        const toggleConfirm = document.getElementById("toggleConfirm");
        const confirmInput = document.getElementById("confirm_password");
        toggleConfirm.addEventListener("click", () => {
            const type = confirmInput.getAttribute("type") === "password" ? "text" : "password";
            confirmInput.setAttribute("type", type);
            toggleConfirm.classList.toggle("fa-eye-slash");
        });

        // Smooth fade-in on page load
        window.addEventListener("load", () => {
            document.body.classList.add("loaded");
        });

        // Smooth fade-out before navigating away
        document.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", e => {
                const href = link.getAttribute("href");
                if (!href || href.startsWith("#") || href.startsWith("javascript:")) return;
                e.preventDefault();
                document.body.classList.remove("loaded");
                setTimeout(() => {
                    window.location.href = href;
                }, 500); // match fade duration
            });
        });
    </script>

    <?php if (isset($_GET['success'])): ?>
        <script>
            alert("✅ Account Successfully Registered!");
            window.location.href = "index.php";
        </script>
    <?php endif; ?>
</body>

</html>