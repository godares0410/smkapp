@extends('layout.master')
@section('content')
    <div class="box">
        <div class="box-body table-responsive">
            <div class="box-title">

                <h3 id="hasilElement"></h3>
                <div class="pull-right">
                    <button id="refreshButton" class="btn btn-success"><i class="fa fa-refresh"></i></button>
                    <button id="listSoalBtn" class="btn btn-primary">List Soal</button>
                </div>
            </div>
            <div id="soalContainer" class="board">
            </div>

            {{-- <div class="box-title">
                <button id="previous" class="hidden btn btn-primary">Sebelumnya</button>
                <label>
                    <input type="checkbox"> Ragu-ragu</label>
                <div class="pull-right">
                    <button id="next" class="btn btn-primary">Selanjutnya</button>
                </div>
            </div> --}}
            <div class="box-title d-flex justify-content-between align-items-center">
                <button id="previous" class="btn btn-primary">Sebelumnya</button>
                <div class="text-center">
                    <label class="checkbox-label btn btn-warning">
                        <input type="checkbox"> Ragu-ragu
                    </label>
                </div>
                <div class="pull-right">
                    <button id="next" class="btn btn-primary">Selanjutnya</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        // Data soal (contoh)
        var soal = <?php echo json_encode($soal); ?>;

        var halamanAktif = 1;
        var soalPerHalaman = 1;
        var jumlahHalaman = Math.ceil(soal.length / soalPerHalaman);

        // Tampilkan soal berdasarkan halaman yang aktif
        function tampilkanSoal() {
            var startIndex = (halamanAktif - 1) * soalPerHalaman;
            var endIndex = startIndex + soalPerHalaman;

            $("#soalContainer").empty();

            for (var i = startIndex; i < endIndex; i++) {
                if (soal[i]) {
                    var currentSoal = soal[i];
                    // var i = 5; // Contoh nilai i
                    // var nilai = i + 1;

                    var $soalElement = $("<div style='padding: 20px;'>");
                    var nomorElement = (i + 1);
                    var hasilElement = document.getElementById("hasilElement");
                    hasilElement.innerHTML = "Soal Nomor : " + nomorElement;
                    // var $soalElement.append("<h3>Soal " + (i + 1) + "</h3>");
                    // var soalElement = document.getElementById("soalElement");
                    // soalElement.setAttribute("value", nilai);

                    // $soalElement.append("<h3>Soal " + currentSoal.id_soal + "</h3>");
                    $soalElement.append("<h3>" + currentSoal.soal + "</h3>");
                    // var gambar = $soalElement.append(currentSoal.file_1)

                    if (currentSoal.file_1) {
                        var imageUrl = "{{ asset('file/soal') }}/" + currentSoal.file_1;
                        // var imageHtml = "<a href='#' data-toggle='modal' data-target='#lightboxModal'>" +
                        var imageHtml = "<a href='#' data-toggle='modal' data-target='#lightboxModal-" + currentSoal
                            .id_soal + "'>" +
                            "<img src='" + imageUrl + "' class='img-responsive pad' style='width: 400px' alt='Gambar A'>" +
                            "</a>";
                        $soalElement.append(imageHtml);

                        var modalHtml =
                            // "<div class='modal fade' id='lightboxModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>" +
                            "<div class='modal fade' id='lightboxModal-" + currentSoal.id_soal +
                            "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>" +
                            "<div class='modal-dialog modal-dialog-centered' role='document'>" +
                            "<div class='modal-content'>" +
                            "<div class='modal-body'>" +
                            "<img src='" + imageUrl +
                            "' class='img-responsive' style='width: 100%; height: auto;' alt='Gambar A'>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "</div>";
                        $("body").append(modalHtml);
                    }

                    $soalElement.append("<div class='radio'>" +
                        "<label><input type='radio' name='pilihan" + i + "' value='" + currentSoal.pil_a +
                        "'> Pilihan A: " + currentSoal.pil_a + "</label>" +
                        "</div>");

                    $soalElement.append("<div class='radio'>" +
                        "<label><input type='radio' name='pilihan" + i + "' value='" + currentSoal.pil_b +
                        "'>" + "<span>B</span>" + currentSoal.pil_b + "</label>" +
                        "</div>");

                    $soalElement.append("<div class='radio'>" +
                        "<label><input type='radio' name='pilihan" + i + "' value='" + currentSoal.pil_c +
                        "'> Pilihan C: " + currentSoal.pil_c + "</label>" +
                        "</div>");

                    $soalElement.append("<div class='radio'>" +
                        "<label><input type='radio' name='pilihan" + i + "' value='" + currentSoal.pil_d +
                        "'> Pilihan D: " + currentSoal.pil_d + "</label>" +
                        "</div>");

                    $soalElement.append("<div class='radio'>" +
                        "<label><input type='radio' name='pilihan" + i + "' value='" + currentSoal.pil_e +
                        "'> Pilihan E: " + currentSoal.pil_e + "</label>" +
                        "</div>");
                    $("#soalContainer").append($soalElement);
                }
            }
        }

        // Perbarui tampilan tombol berdasarkan halaman aktif
        function perbaruiTombol() {
            if (halamanAktif === 1) {
                $("#previous").addClass("hidden");
            } else {
                $("#previous").removeClass("hidden");
            }

            if (halamanAktif === jumlahHalaman) {
                $("#next").addClass("hidden");
            } else {
                $("#next").removeClass("hidden");
            }
        }

        // Panggil fungsi untuk pertama kali
        tampilkanSoal();
        perbaruiTombol();

        // Tambahkan event click pada tombol "Sebelumnya"
        $("#previous").on("click", function() {
            if (halamanAktif > 1) {
                halamanAktif--;
                tampilkanSoal();
                perbaruiTombol();
            }
        });

        // Tambahkan event click pada tombol "Selanjutnya"
        $("#next").on("click", function() {
            if (halamanAktif < jumlahHalaman) {
                halamanAktif++;
                tampilkanSoal();
                perbaruiTombol();
            }
        });

        function openLightbox() {
            document.querySelector(".overlay").style.display = "block";
        }

        function closeLightbox() {
            document.querySelector(".overlay").style.display = "none";
        }
        $(document).on("click", ".zoomable-image", function() {
            $(this).toggleClass("zoom-in zoom-out");
        });


        //tombol ragu

        var raguRaguChecked = false;
        $("input[type='checkbox']").on("change", function() {
            raguRaguChecked = $(this).is(":checked");
        });

        function perbaruiTombol() {
            if (halamanAktif === 1) {
                $("#previous").addClass("hidden");
            } else {
                $("#previous").removeClass("hidden");
            }

            if (halamanAktif === jumlahHalaman) {
                $("#next").addClass("hidden");
            } else {
                $("#next").removeClass("hidden");
            }

            if (raguRaguChecked) {
                $("input[type='checkbox']").prop("checked", false);
            }
        }


        // list

        // Tambahkan event click pada tombol "List Soal"
        $("#listSoalBtn").on("click", function() {
            tampilkanModalListSoal();
        });

        // Fungsi untuk menampilkan modal list soal
        function tampilkanModalListSoal() {
            var $modal = $(
                "<div class='modal fade' id='listSoalModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>"
            );
            var $modalDialog = $("<div class='modal-dialog modal-dialog-centered' role='document'>");
            var $modalContent = $("<div class='modal-content'>");

            var $modalBody = $("<div class='modal-body'>");

            // Loop melalui semua soal untuk membuat box nomor soal dalam modal
            for (var i = 0; i < soal.length; i++) {
                var $nomorSoalBox = $("<div class='nomor-soal-box' data-nomor='" + (i + 1) + "'>").text(i + 1);
                $modalBody.append($nomorSoalBox);
            }

            // Tambahkan event click pada setiap box nomor soal
            $modalBody.on("click", ".nomor-soal-box", function() {
                var nomorSoal = $(this).data("nomor");
                halamanAktif = nomorSoal;
                tampilkanSoal();
                perbaruiTombol();
                $("#listSoalModal").modal("hide");
            });

            $modalContent.append($modalBody);
            $modalDialog.append($modalContent);
            $modal.append($modalDialog);

            // Tampilkan modal list soal
            $("body").append($modal);
            $("#listSoalModal").modal("show");

            // Hapus modal dari DOM setelah ditutup
            $("#listSoalModal").on("hidden.bs.modal", function() {
                $(this).remove();
            });
        }

        //Refresh
        var refreshButton = document.getElementById("refreshButton");
        // Tambahkan event listener untuk meng-handle klik tombol
        refreshButton.addEventListener("click", function() {
            // Menggunakan metode location.reload() untuk mereload halaman
            location.reload();
        });
    </script>
@endpush
