<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} | Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Tambahkan di dalam bagian <head> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <div class="box">
        <span class="borderLine"></span>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h2>Sign in</h2>
            <div class="inputBox">
                <input type="text" name="login" required="required">
                <span>Email</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" name="password" required="required">
                <span>Password</span>
                <i></i>
            </div>
            <div class="Links">
                <a href="#">Forgot Password</a>
            </div>
            <input type="submit">
        </form>
    </div>
</body>
@if ($errors->has('email') || $errors->has('password'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Email atau password yang Anda masukkan salah.',
            });
        });
    </script>
@endif


</html>
