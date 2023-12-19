<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/website/logo/SMKSABILILLAH.png') }}" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMK Sabilillah | Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">
</head>

<body>

    <div class="wrapper">
        <form action="{{ route('siswa.login') }}" method="POST">
            @csrf
            <h1>SMK App</h1>
            <div class="input-box">
                <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                {{-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> --}}
                <box-icon type='solid' name='user'></box-icon>
            </div>
            <div class="input-box">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                {{-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> --}}
                <box-icon name='lock-alt' type='solid'></box-icon>
            </div>
            <div class="show">
                <input type="checkbox" id="showPassword">
                <label for="showPassword">
                    Tampilkan Password
                </label>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</body>
<script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>
<script>
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPassword');

    showPasswordCheckbox.addEventListener('change', function() {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>

</html>
