<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABSEN SCAN</title>
    <link rel="shortcut icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/dist/css/skins/_all-skins.min.css') }}">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <style>
        .border-red {
            border: 2px solid red;
            position: relative; /* Mengatur posisi relatif untuk menempatkan logo di dalamnya */
        }
        .p-3 {
            padding: 1rem;
        }
        .relative {
            position: relative;
        }
        .absolute {
            position: absolute;
        }
        #logo {
            top: 50px; /* Jarak dari atas ke logo */
            left: 15px; /* Jarak dari kiri ke logo */
            width: 50px; /* Lebar logo */
            z-index: 10; /* Z-index untuk memastikan logo berada di atas video */
        }
        #datetime {
        position: absolute;
        bottom: 10px;
        left: 20px;
        z-index: 11;
        color: white;
        text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000; /* Outline hitam */
        }
        #video {
        transform: scaleX(-1); /* Flip horizontally */
        }

    </style>
</head>
<body>
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
                showConfirmButton: false,
                timer: 1000 // Menutup pesan dalam 2.5 detik (2500ms)
             }).then(function() {
                document.getElementById('idsiswa').focus();
            });
        </script>
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
                document.getElementById('idsiswa').focus();
            });
        </script>
    @endif

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Kolom Kiri -->
                
                <!-- Kolom Tengah -->
                <div class="col-md-6" style="display: none;">
                    
                    <div class="border-red p-3 relative">
                        <h5>Foto Absensi</h5>
                        <!-- <video id="video" width="100%" height="auto" autoplay>
                            Your browser does not support the video tag.
                        </video> -->
                        <video id="video" width="100%" height="auto" autoplay>
                            Your browser does not support the video tag.
                        </video>
                        <img id="logo" src="{{ asset('img/website/logo/_1716541080.png') }}" alt="Logo" class="absolute">
                        <p id="datetime" class="absolute"></p>
                    </div>
                    <br>
                    <form id="absForm" action="{{ route('abs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="screenshot" name="screenshot">
                        <!-- <div class="form-group">
                            <input type="text" class="form-control" id="idsiswa" name="idsiswa" style="color: white" autofocus>
                        </div> -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="idsiswa" name="idsiswa" style="color: white;" autofocus>
                        </div>
                        <div class="card mt-4">
                            <div class="card-body">
                                This is a card box under the form.
                                <a href="{{ route('cek.alpa') }}" class="btn btn-primary">Check Alpa</a>
                            </div>
                        </div>
                    </form>
                <button type="submit" class="btn" style="background-color: white" form="absForm"></button>
            </div>
            <div class="col-md-6">
            <div class="nav-tabs-custom" style="height: 100vh; overflow: scroll">
            <ul class="nav nav-tabs">
                <li id="tab-masuk"><a href="#masuk" data-toggle="tab">Scan Masuk</a></li>
                <li id="tab-pulang"><a href="#pulang" data-toggle="tab">Scan Pulang</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="masuk">
                    <!-- Post -->
                    @foreach ($sm as $dm)
                        <div class="post">
                            <div style="width: 100%; display: flex">
                                <div style="width: 25%">
                                    <img src="{{ asset('img/scan/masuk/' . $dm->foto) }}" alt="Foto Scan Masuk" style="width: 100%; max-height: 200px">
                                </div>
                                <div style="width: 35%; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                        <h3 style="color: black; font-weight: bold">
                                            {{ $dm->nama_siswa}}
                                        </h3> 
                                        <h3> 
                                        {{ $dm->nama_kelas}} {{ $dm->kode_jurusan}}<br>
                                        </h3> 
                                        <h3 style="color: black; font-weight: bold"> 
                                        Scan : {{ \Carbon\Carbon::parse($dm->msk)->format('H:i:s') }}
                                        </h3> 
                                </div>
                                <div style="width: 25%">
                                    <img src="{{ asset('img/siswa/' . $dm->fotosis) }}" alt="Foto Scan Masuk" style="max-height: 200px">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane" id="pulang">
                    <!-- Post -->
                    @foreach ($sp as $dp)
                        <div class="post">
                            <div style="width: 100%; display: flex">
                                <div style="width: 25%">
                                    <img src="{{ asset('img/scan/pulang/' . $dp->foto) }}" alt="Foto Scan Pulang" style="width: 100%; max-height: 200px">
                                </div>
                                <div style="width: 35%; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                        <h3 style="color: black; font-weight: bold">
                                            {{ $dp->nama_siswa}}
                                        </h3> 
                                        <h3> 
                                        {{ $dp->nama_kelas}} {{ $dp->kode_jurusan}}<br>
                                        </h3> 
                                        <h3 style="color: black; font-weight: bold"> 
                                        Scan : {{ \Carbon\Carbon::parse($dp->plg)->format('H:i:s') }}
                                        </h3> 
                                </div>
                                <div style="width: 25%">
                                    <img src="{{ asset('img/siswa/' . $dp->fotosis) }}" alt="Foto Scan Pulang" style="max-height: 200px">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.post -->
        </div>
    </div>


    <!-- jQuery 3 -->
    <script src="{{ asset('AdminLTE-2/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('AdminLTE-2/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('AdminLTE-2/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-2/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE-2/dist/js/demo.js') }}"></script>
    <!-- Script untuk mengakses kamera dan menangkap gambar -->
    <script>
        const video = document.getElementById('video');
        const form = document.getElementById('absForm');
        const screenshotInput = document.getElementById('screenshot');
        const logo = document.getElementById('logo');
        const datetimeElement = document.getElementById('datetime');

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                video.srcObject = stream;
                video.play();
            });
        }

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const idsiswa = document.getElementById('idsiswa').value;

            // Check if idsiswa is a number
            if (isNaN(idsiswa) || idsiswa.trim() === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Absen gagal!',
                    text: 'Scan Gagal Silahkan Coba Lagi',
                    showConfirmButton: false,
                    timer: 1000
                }).then(function() {
                location.reload(); // Refresh the page after the alert is closed
            });
                return;
            }

            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');

            // Draw the video frame to the canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Draw the logo on the canvas
            const logoImg = new Image();
            logoImg.src = logo.src;
            logoImg.onload = function() {
                context.drawImage(logoImg, 10, 10, 50, 50);

                // Draw the date/time text on the canvas
                context.font = '16px Arial';
                context.fillStyle = 'white';
                context.fillText(datetimeElement.textContent, 10, canvas.height - 20);

                // Convert the canvas to a data URL and set the hidden input value
                const dataUrl = canvas.toDataURL('image/png');
                screenshotInput.value = dataUrl;

                // Submit the form
                form.submit();
            };
        });
    </script>
    <script>
        function fetchTime() {
            fetch('https://worldtimeapi.org/api/ip')
            .then(response => response.json())
            .then(data => {
                const dateTime = new Date(data.utc_datetime);
                const localDateTime = dateTime.toLocaleString('id-ID', { 
                    timeZone: data.timezone,
                    dateStyle: 'long',
                    timeStyle: 'medium'
                }).replace(/\./g, ':'); // Replace all dots with colons
                document.getElementById('datetime').textContent = localDateTime;
            })
            .catch(error => {
                console.error('Error fetching time:', error);
            });
        }

        function updateDateTime() {
            fetchTime(); // Get initial time

            // Update time every second
            setInterval(fetchTime, 1000);
        }

        // Call updateDateTime when the page is loaded
        updateDateTime();
    </script>

    <!-- SCRIPT AUTO REFRESH -->
    <script>
    function refreshAt730() {
        const now = new Date();
        const schedule730 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 7, 30, 0); // Set pukul 07:30:00 saat ini
        let timeout730 = schedule730.getTime() - now.getTime();
        if (timeout730 < 0) {
            schedule730.setDate(schedule730.getDate() + 1); // Atur untuk refresh pukul 07:30 besok
            timeout730 = schedule730.getTime() - now.getTime();
        }
        setTimeout(function() {
            location.reload(true); // Refresh halaman dari server, bukan dari cache
        }, timeout730);

        const schedule1300 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 13, 0, 0); // Set pukul 13:00:00 saat ini
        let timeout1300 = schedule1300.getTime() - now.getTime();
        if (timeout1300 < 0) {
            schedule1300.setDate(schedule1300.getDate() + 1); // Atur untuk refresh pukul 13:00 besok
            timeout1300 = schedule1300.getTime() - now.getTime();
        }
        setTimeout(function() {
            location.reload(true); // Refresh halaman dari server, bukan dari cache
        }, timeout1300);
    }

        // Panggil fungsi refreshAt730 saat halaman pertama kali dimuat
        refreshAt730();

        // Update setiap menit untuk memeriksa apakah sudah pukul 07:30
        setInterval(refreshAt730, 60000); // Setiap menit (60000 ms)
    </script>

    <script>
    function executeAt132700() {
        const now = new Date();
        if (now.getHours() === 13 && now.getMinutes() === 49 && now.getSeconds() === 0) {
            window.location.href = "{{ route('cek.alpa') }}";
        }
    }

    // Panggil fungsi executeAt132700 saat halaman pertama kali dimuat
    executeAt132700();

    // Update setiap detik untuk memeriksa apakah sudah pukul 13:27:00
    setInterval(executeAt132700, 1000); // Setiap detik (1000 ms)
</script>

<!-- Sembunyikan Scan -->
<script>
    function setActiveTab() {
        const now = new Date();
        const timezoneOffset = now.getTimezoneOffset(); // Get current timezone offset in minutes
        const localTime = now.getTime() + (timezoneOffset * 60000); // Convert to local time in milliseconds

        // Create a Date object for Indonesian WIB (UTC +7)
        const indonesiaTime = new Date(localTime + (7 * 3600000)); // Add 7 hours in milliseconds

        const hour = indonesiaTime.getHours();
        const minutes = indonesiaTime.getMinutes();

        // Check if current time is between 07:30 and 12:59 (7:30 AM to 12:59 PM)
        if ((hour === 7 && minutes >= 30) || (hour > 7 && hour < 13)) {
            document.querySelector('.col-md-6').style.display = 'none';
        } else {
            document.querySelector('.col-md-6').style.display = 'block';
        }
        // Rest of your setActiveTab function for handling active tab based on time
        // Example logic for setting active tab for Scan Masuk or Scan Pulang
        if (hour >= 13 && hour <= 23) {
            document.getElementById('tab-masuk').classList.remove('active');
            document.getElementById('tab-pulang').classList.add('active');
            document.getElementById('masuk').classList.remove('active');
            document.getElementById('pulang').classList.add('active');
        } else {
            document.getElementById('tab-masuk').classList.add('active');
            document.getElementById('tab-pulang').classList.remove('active');
            document.getElementById('masuk').classList.add('active');
            document.getElementById('pulang').classList.remove('active');
        }
    }

    // Call setActiveTab when the page is loaded
    setActiveTab();

    // Update every minute to check and set active tab
    setInterval(setActiveTab, 60000); // Check every minute (60000 ms)
</script>



</body>
</html>
