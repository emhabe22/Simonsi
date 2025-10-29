<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tut Wuri Handayani</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Tut Wuri Handayani" class="logo">
        </div>
        
        <div class="form-section">
            <h1>Masuk</h1>
            <form id="loginForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email kamu" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
                </div>
                
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (email && password) {
                alert('Login berhasil!\nEmail: ' + email);
            }
        });
    </script>
</body>
</html>