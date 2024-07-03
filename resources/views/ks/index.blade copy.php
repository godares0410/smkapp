<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kepala Sekolah</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{ asset('AdminLTE-2/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href=" {{ asset('AdminLTE-2/plugins/iCheck/square/blue.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<style>
.gradient-gold-border {
    width: 40%; 
    margin-top: -430px;
    border-radius: 10px;
    border: 5px solid transparent; /* Initial transparent border */
    background: linear-gradient(white, white) padding-box, 
                linear-gradient(to right, #B8860B, #FFD700, #B8860B) border-box;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.login-page {
    position: relative;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden; /* Ensure no overflow issues */
}

.login-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('/img/website/bg/_1703127815.jpg');
    background-size: cover;
    background-position: center;
    filter: blur(10px); /* Adjust the blur radius as needed */
    z-index: -1;
}

.login-page .content {
    position: relative;
    z-index: 1; /* Ensure the content is above the blurred background */
}


</style>
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-box-body" style="position: relative; background-color: transparent">
                    <img src="{{ asset('img/website/logo/_1716541080.png') }}" style="width: 55px; position: absolute; margin-top: 10px; margin-left: 5px" alt="">
                    <p class="login-box-msg" style="margin-top: 100px; color: white; font-family: 'Poppins', sans-serif; font-size: 20px; position: absolute; left: 5%; right: 0; text-align: center;">
    SMK SABILILLAH
</p>

                    <img src="{{ asset('img/file/id.svg') }}" style="width: 100%;" alt="">
            <div class="social-auth-links" style="position: absolute;">
                    <img src="{{ asset('img/file/ks.jpeg') }}" class="gradient-gold-border">
                        <div class="text-center">
                            <p class="login-box-msg" style="margin-top: 20px; color: white; font-family: 'Archivo Black', sans-serif; font-size: 20px;">
                                Fachrur Rozi, S.Pd.I, M.Pd
                            </p>
                            <p class="login-box-msg" style="margin-top: 0px; color: gold; font-family: 'Poppins', sans-serif; font-size: 20px;">
                                Kepala Sekolah
                            </p>
                        </div>

            </div>
            <a href="https://wa.me/6285649825908" class="btn btn-block btn-success">Nomor WhatsApp</a>
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
</body>

</html>
