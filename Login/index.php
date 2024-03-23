<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Login and Signup Form</title>

    <!-- Google Sign-In -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!-- Set the client ID for the Google API -->
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">

    <link rel="stylesheet" href="css/style.css">
           
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
               
</head>
<body>
    <!-- Container for the login and signup forms -->
    <section class="container forms">
        <!-- Login form -->
        <div class="form login">
            <div class="form-content">
                <!-- Header for the form -->
                <header>Login</header>
                <!-- Form to handle login process -->
                <form id="login-form" action="login.php" method="post">
                    <!-- Display error message if there is one -->
                    <?php
                    if (isset($_GET['error']) && $_GET['error'] !== null) {
                        echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
                    }
                    ?>
                    <!-- Email input field -->
                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input" id="login-email" name="mail">
                    </div>

                    <!-- Password input field -->
                    <div class="field input-field">
                        <input type="password" placeholder="Password" class="password" id="login-password" name="pass">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <!-- Forgot password link -->
                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
                    </div>

                    <!-- Login button -->
                    <div class="field button-field">
                        <button type="submit">Login</button>
                    </div>
                </form>

                <!-- Link to signup form -->
                <div class="form-link">
                    <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                </div>
            </div>

            <div class="line"></div>

            <!-- Google login button -->
            <div class="media-options">
                <a href="auth.php" class="field google" id="google-login">
                    <img src="images/google.png" alt="" class="google-img">
                    <span>Login with Google</span>
                </a>
            </div>

        </div>

        <!-- Signup Form -->
        <div class="form signup">
            <div class="form-content">
                <!-- Signup form header -->
                <header>Signup</header>
                <!-- Form to handle signup process -->
                <form action="#" onsubmit="return validateSignupForm(this) && submitSignupForm(this);">
                    <!-- Email input field -->
                    <div class="field input-field">
                        <input type="email" placeholder="Email" class="input" required>
                    </div>

                    <!-- Password input field -->
                    <div class="field input-field">
                        <input type="password" placeholder="Create password" class="password" required>
                    </div>

                    <!-- Signup button -->
                    <div class="field button-field">
                        <button type="submit">Signup</button>
                    </div>
                </form>
                <script>

