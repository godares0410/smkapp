<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Layout</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .border-red {
            border: 2px solid red;
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
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-3">
                <h5>Form Input</h5>
                <form id="absForm" action="{{ route('abs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="idsiswa" name="idsiswa" autofocus>
                    </div>
                    <input type="hidden" id="screenshot" name="screenshot">
                <div class="card mt-4">
                    <div class="card-body">
                        This is a card box under the form.
                    </div>
                </div>
            </div>

            <!-- Kolom Tengah -->
            <div class="col-md-6">
                <div class="border-red p-3 relative">
                    <h5>Foto Absensi</h5>
                    <video id="video" width="100%" height="auto" autoplay>
                        Your browser does not support the video tag.
                    </video>
                    <img src="{{ asset('img/website/logo/_1716541080.png') }}" class="absolute" style="top: 70px; left: 10px; width: 50px;" alt="">
                    <p id="datetime" class="absolute" style="top: 500px; left: 10px; color: white;"></p>
                </div>
                <br>
                    <button type="submit" class="btn btn-primary">Absen</button>
            </div>
            </form>

            <!-- Kolom Kanan -->
            <div class="col-md-3">
                <h5>List</h5>
                <ul class="list-group">
                    <li class="list-group-item">Item 1</li>
                    <li class="list-group-item">Item 2</li>
                    <li class="list-group-item">Item 3</li>
                    <li class="list-group-item">Item 4</li>
                </ul>
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

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                video.srcObject = stream;
                video.play();
            });
        }

        form.addEventListener('submit', function(event) {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/png');
            screenshotInput.value = dataUrl;
        });
    </script>
    <script>
        function updateDateTime() {
            const now = new Date();
            const date = now.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            const time = now.toLocaleTimeString('id-ID');
            document.getElementById('datetime').textContent = `${date}, ${time}`;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call to display the time immediately
    </script>
</body>
</html>
