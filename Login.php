<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SmartKas Login</title>
<link rel="stylesheet" href="css/styleLogin.css">


</head>
<body>

  <div class="wrapper" id="wrapper">

    <!-- KIRI -->
    <div class="left" id="leftSide">
        <div class="left-content">
            <img src="asset/logo.png" alt="logo">
            <h1 id="judulKiri">SmartKas Dashboard</h1>
            <p id="subKiri">Atur keuangan dengan lebih mudah dan transparan</p>
        </div>
    </div>

    <!-- KANAN -->
    <div class="right">
        <div class="login-box">

            <!-- LOGIN -->
            <form action="database/prosesLogin.php" id="loginForm" method="POST">
                <label> Email</label>
                <input type="text" name="email" placeholder="Masukkan Email anda!">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan Password anda!">
                <div class="forgot">Forgot password</div>
                <button type="submit" class="login-btn">Login</button>
                <div class="or">OR</div>
                <div class="social">
                    <button>Google</button>
                    <button type="button" onclick="toggleMode()">Sign In</button>

                </div>
            </form>

            <!-- REGISTER-->
            <form method="POST" action="database/prosesRegister.php" id="registerForm" style="display:none;">
                <label>Nama</label>
                <input type="text" name="nama" required>
                <label>Email</label>
                <input type="text" name="email" required>                
                <label>Password</label>
                <input type="password" name="password" required>                
                <button type="submit" class="login-btn">Daftar</button>
                <div class="or">Sudah punya akun?</div>
                <button type="button" onclick="toggleMode()">Login</button>

            </form>

        </div>
    </div>

    <script src="js/login.js"></script>


</body>
</html>