<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            window.location.href = "{{ route('siswa.dashboard') }}";
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
            window.location.href = "{{ route('siswa.dashboard') }}";
        });
        </script>
    @endif

    <div class="container mt-4">
        <div class="row">
            <!-- Kolom Kiri -->
                <form id="absForm" action="{{ route('pkl.absen') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" class="form-control" id="idsiswa" name="idsiswa" value={{ $idSiswa}}>
                    </div>
                    <input type="hidden" id="screenshot" name="screenshot">
                </form>

            <!-- Kolom Tengah -->
            <div class="col-md-12">
                <div class="border-red p-3 relative">
                    <h5>Foto Absensi</h5>
                    <video id="video" width="100%" height="auto" autoplay>
                        Browser Tidak Mendukung, Gunakan Google Chrome
                    </video>
                    <img id="logo" src="{{ asset('img/website/logo/_1716541080.png') }}" alt="Logo" class="absolute">
                    <p id="datetime" class="absolute"></p>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" form="absForm">Absen</button>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
                context.drawImage(logoImg, 10, 70, 50, 50);

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
</body>
</html>
