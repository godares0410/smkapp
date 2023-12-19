<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMK Sabilillah | Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">
</head>

<body>

</body>
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

</div>
</form>
</div>

</html>
