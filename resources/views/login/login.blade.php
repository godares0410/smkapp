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

<<<<<<< HEAD
=======
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        showConfirmButton: true
                    });
                </script>
            @endif
            @if (session('gagal'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ session('gagal') }}',
                        showConfirmButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to the login page
                            window.location.href = '/login';
                        }
                    });
                </script>
            @endif
            <form action="{{ route('siswa.login') }}" method="POST">
                @csrf
                <div class="form-group has-feedback">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="showPassword">
                            <label for="showPassword">
                                Tampilkan Password
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="{{ asset('AdminLTE-2/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('AdminLTE-2/plugins/iCheck/icheck.min.js') }}"></script>
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
>>>>>>> 9f5d545 (first commitu)
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
