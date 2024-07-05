<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Sabilillah | Login</title>
    <link rel="icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/stylelogin.css') }}">
    <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="wrapper">
    <form action="{{ route('siswa.login') }}" method="POST">
        @csrf
        <h1>SMK App</h1>
        <!-- Error Messages -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1000 // Menutup pesan dalam 2.5 detik (2500ms)
             }).then(function() {
            window.location.href = "{{ route('siswa.dashboard') }}";
        });
        </script>
    @endif

        <div class="input-box">
            <input type="text" id="username" name="username" class="form-control" placeholder="Username">
            <box-icon type='solid' name='user'></box-icon>
        </div>
        <div class="input-box">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <box-icon name='lock-alt' type='solid'></box-icon>
        </div>
        <div class="show">
            <input type="checkbox" id="showPassword">
            <label for="showPassword">Tampilkan Password</label>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</div>

<!-- jQuery -->
<script src="{{ asset('AdminLTE-2/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- iCheck -->
<script src="{{ asset('AdminLTE-2/plugins/iCheck/icheck.min.js') }}"></script>

<!-- Script for showing/hiding password -->
<script>
    $(function() {
        $('#showPassword').change(function() {
            var passwordInput = $('#password');
            if ($(this).is(':checked')) {
                passwordInput.attr('type', 'text');
            } else {
                passwordInput.attr('type', 'password');
            }
        });
    });
</script>

</body>
</html>
