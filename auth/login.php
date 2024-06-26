<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register and Login</title>
    <!-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" /> -->
    <link rel="stylesheet" href="../assets/css/login.css" />
</head>

<body>
    <div class="logo">
        <a href="../"><img src="../assets/images/logo-white.png" alt="Logo" /></a>
    </div>
    <div class="container">
        <div class="signin">
            <form action="../db/auth.php" method="post" id="emailForm" onsubmit="return validateForm()">
                <h1>Sign In</h1>
                <span id="emailError" class="error"></span>
                <h5>
                    <input type="email" name="email" id="email" placeholder="Email" />
                </h5>
                <h5>
                    <input type="password" name="password" id="password" placeholder="Password" required />
                </h5>
                <input type="submit" name="login" value="Login" />
                <p>
                    New Here?&nbsp;
                    <a href="signup.php"">SIGN-UP HERE</a>
                </p>
            </form>
        </div>
    </div>
    <script src="../assets/js/main.js"></script>
</body>

</html>