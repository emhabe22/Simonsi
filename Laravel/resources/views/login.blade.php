<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EDUTRACK</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
<div class="login-container">

    <!-- LOGO -->
    <div class="logo-section">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Tut Wuri Handayani" class="logo">
    </div>

    <!-- FORM -->
    <div class="form-section">
        <h1>Masuk</h1>

        {{-- Notifikasi error login (email/password salah) --}}
        @if ($errors->has('email'))
            <div class="alert-error">
                {{ $errors->first('email') }}
            </div>
        @endif

        {{-- Notifikasi error validasi password kosong --}}
        @if ($errors->has('password') && !$errors->has('email'))
            <div class="alert-error">
                {{ $errors->first('password') }}
            </div>
        @endif


        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan email kamu"
                    value="{{ old('email') }}"
                    class="@error('email') input-error @enderror"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan kata sandi"
                    class="@error('password') input-error @enderror"
                    required
                >
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</div>
</body>
</html>