<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABSEN SCAN</title>
    <link rel="shortcut icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href=" {{ asset('AdminLTE-2/dist/css/skins/_all-skins.min.css') }}">
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
                    <form id="absForm" action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
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
                    <!-- Konten untuk data scan masuk akan diperbarui oleh JavaScript -->
                </div>
                <div class="active tab-pane" id="pulang">
                   
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

                // Submit the form via AJAX
                $.ajax({
                    cache: false,
                    url: form.getAttribute('action'),
                    method: form.getAttribute('method'),
                    dataType: 'json',
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.success) {
                            // Reset form setelah submit berhasil
                            document.getElementById('absForm').reset();
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.success,
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function() {
                                // Focus back on input
                                $('#idsiswa').focus();
                            });
                        } else if (response.error) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Sudah!',
                                text: response.error,
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function() {
                                // Clear input value
                                $('#idsiswa').val('');
                                // Focus back on input
                                $('#idsiswa').focus();
                            });
                        } else if (response.errorz) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.errorz,
                                showConfirmButton: false,
                                timer: 1000
                            }).then(function() {
                                // Clear input value
                                $('#idsiswa').val('');
                                // Focus back on input
                                $('#idsiswa').focus();
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            location.reload(); // Refresh the page after the alert is closed
                        });
                    }
                });
            };
        });

        // Update the date/time element every second
        setInterval(function() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZone: 'Asia/Jakarta' };
            const formattedDateTime = now.toLocaleDateString('id-ID', options);
            datetimeElement.textContent = formattedDateTime;
        }, 1000);
    </script>
    <script>
    $(document).ready(function() {
    $('#absForm').submit(function(event) {
        event.preventDefault();

        const idsiswa = $('#idsiswa').val();

        if (isNaN(idsiswa) || idsiswa.trim() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Absen gagal!',
                text: 'Scan Gagal Silahkan Coba Lagi',
                showConfirmButton: false,
                timer: 1000
            });
            return;
        }

        let swalWithProgress = Swal.fire({
            title: 'Processing',
            html: '<div id="progress-bar" class="progress mt-3" style="width: 80%; margin: 10px auto;">' +
                  '<div id="progress" class="progress-bar progress-bar-striped progress-bar-animated" ' +
                  'role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">' +
                  '</div></div>',
            allowOutsideClick: false,
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            didOpen: () => {
                const formData = new FormData(document.getElementById('absForm'));
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    timeout: 4000, // Set timeout to 4 seconds
                    xhr: function() {
                        const xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(e) {
                            if (e.lengthComputable) {
                                const percent = Math.round((e.loaded / e.total) * 100);
                                $('#progress').attr('style', 'width: ' + percent + '%');
                                $('#progress').text(percent + '%');
                            }
                        });
                        return xhr;
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat memproses permintaan. Silakan coba lagi.',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function() {
                            location.reload(); // Refresh the page after the alert is closed
                        });
                    }
                });
            }
        });

        // Handle timeout scenario
        setTimeout(function() {
            if (swalWithProgress.isOpen()) {
                swalWithProgress.close(); // Close the "Processing" message
                Swal.fire({
                    icon: 'error',
                    title: 'Koneksi Tidak Stabil',
                    text: 'Halaman akan dimuat ulang dalam 1 detik.',
                    showConfirmButton: false,
                    timer: 1000
                }).then(function() {
                    location.reload(); // Refresh the page after the alert is closed
                });
            }
        }, 4000); // 4 seconds timeout
    });
});
// After reload, set focus to element with ID 'idsiswa'
$(document).ready(function() {
    $('#idsiswa').focus();
});
</script>


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

        const schedule1300 = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 13, 30, 0); // Set pukul 13:00:00 saat ini
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
        if ((hour === 07 && minutes >= 30) || (hour > 12 && hour < 13)) {
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

<script>
    function fetchMasukData() {
        $.ajax({
            url: "{{ route('absen.masuk') }}",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#masuk .post').remove(); // Menghapus semua elemen dengan class .post di dalam #masuk

                response.forEach(function(dm) {
                    var html = `
                        <div class="post">
                            <div style="width: 100%; display: flex">
                                <div style="width: 25%">
                                    <img src="{{ asset('img/scan/masuk/') }}/${dm.foto}" alt="Foto Scan Masuk" style="width: 100%; max-height: 200px">
                                </div>
                                <div style="width: 35%; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                    <h3 style="color: black; font-weight: bold">${dm.nama_siswa}</h3>
                                    <h3>${dm.nama_kelas} ${dm.kode_jurusan}<br></h3>
                                    <h3 style="color: black; font-weight: bold">Scan : ${dm.msk}</h3>
                                </div>
                                <div style="width: 25%">
                                    <img src="{{ asset('img/siswa/') }}/${dm.fotosis}" alt="Foto Siswa" style="max-height: 200px">
                                </div>
                            </div>
                        </div>
                    `;
                    $('#masuk').append(html); // Menambahkan HTML baru ke dalam #masuk
                });

                // Panggil kembali fetchMasukData setelah menambahkan data baru
                fetchMasukData(); // Ini akan membuatnya terus memanggil dirinya sendiri
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                // Jika ada error, tunggu sebelum memanggil kembali
                setTimeout(fetchMasukData, 10000); // Coba lagi setelah 10 detik
            }
        });
    }

    // Panggil fetchMasukData untuk pertama kali
    fetchMasukData();
</script>
<script>
    function fetchPulangData() {
        $.ajax({
            url: "{{ route('absen.pulang') }}",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#pulang .post').remove(); // Menghapus semua elemen dengan class .post di dalam #pulang

                response.forEach(function(dm) {
                    var html = `
                        <div class="post">
                            <div style="width: 100%; display: flex">
                                <div style="width: 25%">
                                    <img src="{{ asset('img/scan/pulang/') }}/${dm.foto}" alt="Foto Scan pulang" style="width: 100%; max-height: 200px">
                                </div>
                                <div style="width: 35%; display: flex; justify-content: center; align-items: center; flex-direction: column;">
                                    <h3 style="color: black; font-weight: bold">${dm.nama_siswa}</h3>
                                    <h3>${dm.nama_kelas} ${dm.kode_jurusan}<br></h3>
                                    <h3 style="color: black; font-weight: bold">Scan : ${dm.plg}</h3>
                                </div>
                                <div style="width: 25%">
                                    <img src="{{ asset('img/siswa/') }}/${dm.fotosis}" alt="Foto Siswa" style="max-height: 200px">
                                </div>
                            </div>
                        </div>
                    `;
                    $('#pulang').append(html); // Menambahkan HTML baru ke dalam #pulang
                });

                // Panggil kembali fetchPulangData setelah menambahkan data baru
                fetchPulangData(); // Ini akan membuatnya terus memanggil dirinya sendiri
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                // Jika ada error, tunggu sebelum memanggil kembali
                setTimeout(fetchPulangData, 10000); // Coba lagi setelah 10 detik
            }
        });
    }

    // Panggil fetchPulangData untuk pertama kali
    fetchPulangData();
</script>



</body>
</html>
