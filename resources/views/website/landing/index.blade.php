<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" type="image/png">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMK Sabilillah</title>
    {{-- My CSS --}}
    <link rel="stylesheet" href="{{ asset('css/stylenew.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('img/bank_soal/website/logo/_1702460950.png') }}" alt="">
                <a href="">SMK Sabilillah</a>
            </div>
            <ul class="links">
                <li><a href="beranda">Beranda</a></li>
                <li><a href="profile">Profile</a></li>
                <li><a href="visimisi">Visi Misi</a></li>
                <li><a href="">Galeri</a></li>
                <li><a href="">Contact</a></li>
            </ul>
            <a href="/login" class="action_btn">Login</a>
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="dropdown_menu">
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#profile">Profile</a></li>
            <li><a href="#visimisi">Visi Misi</a></li>
            <li><a href="">Galeri</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="{{ route('siswa.login')}}" class="action_btn">Login</a></li>
        </div>
    </header>
    <div class="beranda" id="beranda">
        <div class="container">
            <div class="slider-wrapper">
                <div class="slider">
                    <div class="list">
                        @foreach ($beranda as $data)
                            <div class="item">
                                <img src="{{ asset('img/bank_soal/website/landing/' . $data->foto) }}" alt="{{ $data->tag }}">
                            </div>
                        @endforeach
                    </div>
                    <ul class="dots">
                        @foreach ($beranda as $index => $data)
                            <li class="{{ $index === 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><i class="fa-solid fa-chevron-left"></i></button>
            <button id="next"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
        <div class="konten">
            <div class="profile" id="profile">
                <h2>Profil SMK Sabilillah</h2>
                <p>Merupakan salah satu SMK yang difasilitasi oleh Direktorat
                    Jenderal Vokasi Kementerian Pendidikan dan Kebudayaan melalui Direktorat Sekolah Menengah
                    Kejuruan untuk dikembangkan menjadi SMK sebagai Pusat Keunggulan (Center Of Excellent)
                    Kerjasama Luar Negeri. Pegembangan tersebut difokuskan pada peningkatan kualitas pendidikan SMK
                    sebagai pusat keunggulan (Center of Excellence = COE) yang nantinya dapat menjadi Sekolah
                    Penggerak yang mampu mendemonstrasikan kepemimpinan pembelajaran (instructional leadership)
                    terutama dari kepala sekolah beserta guru di dalamnya.</p>
                <div class="video-container">
                    <iframe src="https://www.youtube.com/embed/mkpa_Menlf4" frameborder="0" allowfullscreen></iframe>
                    <iframe src="https://www.youtube.com/embed/553DJSCg-5Q" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="visimisi" id="visimisi">
            <div class="boxed">
                    <div class="box">
                        <h3>Visi</h3>
                        <p>TERWUJUDNYA TAMATAN YANG BERKAH (BERAKHLAK MULIA, ENTERPRENEUR, RELIGIUS, KREATIF, AKTIF DAN HANDAL)</p>
                    </div>
                    <div class="box">
                        <h3>Visi</h3>
                        <ul>
                            <li>1. Mewujudkan Akhlaqul Karimah bagi seluruh warga sekolah sesuai dengan norma agama dan budaya bangsa</li>
                            <li>2. Mewujudkan peserta didik yang berwawasan entrepreneurship, kompeten, dan profesional</li>
                            <li>3. Menerapkan religiositas dalam proses pendidikan yang beriman, bertaqwa, dan berbudi luhur</li>
                            <li>4. Mengembangkan sikap kreatif dalam berbagai inovasi kedalam diri peserta didik</li>
                            <li>5. Menciptakan karakter pribadi yang memiliki kesadaran tinggi dalam berintegritas, berkedisiplinan, cekatan, dan mandiri, sehingga mampu beradaptasi dalam menghadapi tantangan zaman</li>
                            <li>6. Mendukung dan berupaya dalam mewujudkan tanggungjawab, meningkatkan mutu, SDM yang profesional, dedikasi, etos kerja dalam berprilaku untuk bisa bekerja di dunia Usaha dan Dunia Industri</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- <article class="card">
                <div class="card-int">
                    <span class="card__span">Category</span>
                    <div class="img"></div>
                    <div class="card-data">
                        <p class="title">This is a test title
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut
                            labore et dolore magna aliqua.</p>
                        <button class="button">More info</button>
                    </div>
                </div>
            </article> --}}
        </div>
    </div>
    <script>
        let list = document.querySelector('.slider .list');
        let items = document.querySelectorAll('.slider .list .item');
        let dots = document.querySelectorAll('.slider .dots li');
        let prev = document.getElementById('prev');
        let next = document.getElementById('next');

        let active = 0;
        let lengthItems = items.length - 1;

        next.onclick = function() {
            if (active + 1 > lengthItems) {
                active = 0;
            } else {
                active = active + 1;
            }
            reloadSlider();
        }
        prev.onclick = function() {
            if (active - 1 < 0) {
                active = lengthItems;
            } else {
                active = active - 1;
            }
            reloadSlider();
        }
        let refreshSlider = setInterval(() => {
            next.click()
        }, 7000);

        function reloadSlider() {
            let checkLeft = items[active].offsetLeft;
            list.style.left = -checkLeft + 'px';

            let lastActiveDot = document.querySelector('.slider .dots li.active');
            lastActiveDot.classList.remove('active');
            dots[active].classList.add('active');
            clearInterval(refreshSlider);
            refreshSlider = setInterval(() => {
                next.
                click()
            }, 5000);
        }
        dots.forEach((li, key) => {
            li.addEventListener('click', function() {
                active = key;
                reloadSlider();
            })
        })
    </script>
    <script>
        const toggleBtn = document.querySelector('.toggle_btn')
        const toggleBtnIcon = document.querySelector('.toggle_btn i')
        const dropDownMenu = document.querySelector('.dropdown_menu')

        toggleBtn.onclick = function() {
            dropDownMenu.classList.toggle('open')
            const isOpen = dropDownMenu.classList.contains('open')

            toggleBtnIcon.classList = isOpen ?
                'fa-solid fa-xmark' :
                'fa-solid fa-bars'
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const berandaLink = document.querySelector(".links li a[href='beranda']");
            const profileLink = document.querySelector(".links li a[href='profile']");
            const visimisiLink = document.querySelector(".links li a[href='visimisi']");

            function handleLinkClick(targetElement, link) {
                link.addEventListener("click", function(event) {
                    event.preventDefault(); // Prevent navigating to an empty page

                    // Remove focus from other elements with the "focus" class
                    const focusedElement = document.querySelector(".focus");
                    if (focusedElement) {
                        focusedElement.classList.remove("focus");
                    }

                    // Add focus to the target element
                    targetElement.classList.add("focus");

                    // Scroll to the target element to ensure it is visible on the screen
                    targetElement.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                });
            }

            // Handle clicks for the profile and visimisi links
            handleLinkClick(document.querySelector(".beranda"), berandaLink);
            handleLinkClick(document.querySelector(".profile"), profileLink);
            handleLinkClick(document.querySelector(".visimisi"), visimisiLink);

            // Function to update active state based on the element's visibility
            function updateActiveState(targetElement, link) {
                function isElementInViewport(el) {
                    const rect = el.getBoundingClientRect();
                    return (
                        rect.top <= window.innerHeight / 2 &&
                        rect.bottom >= window.innerHeight / 2
                    );
                }

                if (isElementInViewport(targetElement)) {
                    link.classList.add("active");
                } else {
                    link.classList.remove("active");
                }
            }

            // Update active state for profile and visimisi on scroll
            window.addEventListener("scroll", function() {
                updateActiveState(document.querySelector(".beranda"), berandaLink);
                updateActiveState(document.querySelector(".profile"), profileLink);
                updateActiveState(document.querySelector(".visimisi"), visimisiLink);
            });
        });
    </script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownMenuLinks = document.querySelectorAll(".dropdown_menu li a");

        function handleDropdownClick(targetId) {
            // Check if the targetId is not empty
            if (targetId) {
                const targetElement = document.getElementById(targetId);

                // Check if the target element exists
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                } else {
                    console.error(`Element with id '${targetId}' not found.`);
                }
            } else {
                console.error('Empty targetId. Make sure the href attribute has a valid id reference.');
            }
        }

        dropdownMenuLinks.forEach(function (link) {
            link.addEventListener("click", function (event) {
                event.preventDefault();

                // Extract the target section's id from the href attribute
                const targetId = link.getAttribute("href").substring(1);

                // Handle the click and scroll to the target section
                handleDropdownClick(targetId);
            });
        });
    });
</script>



</body>

</html>