@extends('personal.master')
@section('navbar-link')
    <div class="navbar-nav text-center">
        <a href="#home" class="nav-item nav-link">Home</a>
        <a href="#informasi" class="nav-item nav-link">Informasi Umum</a>
        <a href="#kalender" class="nav-item nav-link">Kalender</a>
        <a href="#promo" class="nav-item nav-link">Promo</a>
        <a href="#peta" class="nav-item nav-link">Peta</a>
        <a href="#galeri" class="nav-item nav-link">Galeri</a>
        <a href="#layanan" class="nav-item nav-link">Layanan</a>
    </div>
@endsection
@section('content')
    {{-- Hero Carousel Start --}}
    <div class="container-fluid mb-lg-5 mb-3 " id="home">
        <div class="row">
            <div class="col-12 mt-2 mb-2 text-center fadeComponent">
                <!-- Slider main container -->
                <div class="swiper carousel-img">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($carouselUtama as $item)
                            <div class="swiper-slide"> <img class="img-slide"
                                    src="{{ asset('storage/hero_carousel/' . $item->gambar) }}" alt=""></div>
                        @endforeach

                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <!-- If we need scrollbar -->
                    {{-- <div class="swiper-scrollbar"></div> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Hero Carousel End --}}



    {{-- Informasi Umum start --}}
    <div class="container mt-3 mb-3" id="informasi">
        <div class="row g-3">
            <div class="col-12 mt-3 mb-2 text-center fadeComponent">
                <h5 class="text-muted">Berita Kita</h5>
                <h2>Informasi Umum</h2>
            </div>
            @foreach ($articles as $item)
                <div class="col-12 col-lg-4 col-md-4 fadeComponent">
                    <div class="card card-informasi shadow ">
                        <div class="image-container">
                            <img src="{{ asset('storage/images/' . $item->gambar) }}" class="card-img-top img-fluid ">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold" style="text-transform: uppercase;"><a
                                    href="{{ route('showDetail', ['slug' => $item->slug]) }}">{{ $item->judul }}</a></h5>
                            <div class="card-author">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="card-author-desc">
                                            <i class="bi bi-clock"></i>
                                            <span>
                                                {{ $item->created_at }}
                                            </span>
                                            |
                                            <i class="bi bi-tag"></i>
                                            <span style="text-transform: uppercase;">
                                                {{ $item->category->name }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text text-isi">{!! Str::limit($item->isi, 100) !!}
                            </p>
                            <div class="row d-flex">
                                <div class="col-12">
                                    <a class="icon-link icon-link-hover read-more"
                                        href="{{ route('showDetail', ['slug' => $item->slug]) }}">
                                        baca lebih
                                        <i class="bi bi-arrow-right mb-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    {{-- Informasi Umum end --}}

    {{-- Kalender start --}}
    <div class="container-fluid mt-3 mb-3" id="kalender">
        <div class="row">
            <div class="col-12 mt-3 mb-2 text-center fadeComponent">
                <h5 class="text-muted">Tanggal Kegiatan</h5>
                <h2>Kalender</h2>
            </div>
            <div class="col-12  mt-3 mb-2 text-center fadeComponent">
                <iframe src="https://embed.styledcalendar.com/#CyoGGoKKZJ0P5Fw6JOFq" title="Styled Calendar"
                    class="styled-calendar-container calender" data-cy="calendar-embed-iframe"></iframe>
                <script async type="module" src="https://embed.styledcalendar.com/assets/parent-window.js"></script>
            </div>
        </div>

    </div>
    {{-- Kalender end --}}

    {{-- Pojok Umkm start --}}
    <div class="container-fluid mt-3 mb-3 fadeComponent" id="promo">
        <div class="row">
            <div class="col-12 mt-3 mb-2 text-center">
                <h5 class="text-muted fadeComponent">Pojok UMKM</h5>
                <h2 class="fadeComponent">Promo</h2>
            </div>
            <div class="col-12  mt-3 mb-2 fadeComponent">
                <div class="swiper-umkm text-center ">
                    <div class="swiper-wrapper umkm-row">
                        @foreach ($promos as $item)
                            <div class="col-12 swiper-slide">
                                <a href="" data-featherlight="{{ asset('storage/promo/' . $item->gambar) }}"> <img
                                        class="img-fluid rounded " src="{{ asset('storage/promo/' . $item->gambar) }}"
                                        alt=""></a>
                            </div>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination3"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev3"></div>
                    <div class="swiper-button-next3"></div>
                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar3"></div>

                </div>
            </div>
        </div>

    </div>
    {{-- Pojok Umkm end --}}




    {{-- Peta start --}}
    <div class="container-fluid mt-3 mb-3 " id="peta">
        <div class="row">
            <div class="col-12 mt-3 mb-2 text-center fadeComponent">
                <h5 class="text-muted">Temukan lokasi</h5>
                <h2>Peta</h2>
            </div>
            <div class="col-12 mt-3 mb-2 text-center peta-gmap fadeComponent">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.4596833007448!2d106.9164157578359!3d-6.284918888990912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d7d01dd66c1%3A0x3132afedbf38cd61!2sPondok%20Gede%20Housing%201!5e0!3m2!1sid!2sid!4v1713580248512!5m2!1sid!2sid"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    {{-- Peta end --}}

    {{-- Gallery start --}}
    <div class="container-fluid mt-3 mb-3" id="galeri">
        <div class="row">
            <div class="col-12 mt-3 mb-2 text-center  fadeComponentSecond">
                <h5 class="text-muted">Dokumentasi Kegiatan</h5>
                <h2>Galeri</h2>
            </div>
            <div class="col-12 text-center mt-2">
                <div class="swiper-gallery  fadeComponentSecond">
                    <div class="swiper-wrapper gallery-row">
                        @foreach ($galleryPrev as $item)
                            <div class="col-4 swiper-slide">
                                <a href="" data-featherlight="{{ asset('storage/gallery/' . $item->image) }}">
                                    <img class="img-fluid rounded" src="{{ asset('storage/gallery/' . $item->image) }}"
                                        alt=""></a>
                            </div>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination2"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev2"></div>
                    <div class="swiper-button-next2"></div>
                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar2"></div>

                </div>
            </div>
            <div class="col-12 text-center mb-3">
                <a class="icon-link icon-link-hover read-more" href="{{ route('gallery') }}">
                    Lihat lebih banyak
                    <i class="bi bi-arrow-right mb-1"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- Gallery end --}}

    <!-- Preloader -->
    <div class="preloader">Loading...</div>

    <!-- Floating action button -->
    <div class="floating-action-button">
        <i class="bi bi-arrow-up" style="color: black"></i>
    </div>

    <!-- Footer 3 - Bootstrap Brain Component -->
    <footer class="footer fadeComponentSecond" id="layanan">
        <!-- Widgets - Bootstrap Brain Component -->
        <section class="py-4 py-md-5 py-xl-8 bg-light border-top">
            <div class="container overflow-hidden">
                <div class="row gy-4 gy-lg-0">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="widget">
                            <h4 class="widget-title mb-4">Nomor Pelayanan</h4>
                            <ul>
                                <li>
                                    <a class=" link-secondary text-decoration-none" href="tel:+15057922430">085812345678
                                        (Kantor)</a>
                                </li>
                                @foreach ($contacts as $item)
                                    <li>
                                        <a class=" link-secondary text-decoration-none"
                                            href="tel:{{ $item->no_telp }}">{{ $item->no_telp }}
                                            ({{ $item->nama }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <img src="{{ asset('assets/img/satpam-graphic.png') }}" class="satpam-graphic" alt="">
                    </div>
                    <div class="col-12 col-lg-6 contact-container">
                        <div class="widget">
                            <h4 class="widget-title mb-4">Punya keluhan?</h4>
                            <p class="mb-4">Isi form lalu klik tombol WhatsApp!</p>
                            <form action="#" onsubmit="sendWhatsAppMsg()" method="POST">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <span class="input-group-text" id="username-addon">
                                                <i class="bi bi-person-fill"></i>
                                            </span>
                                            <input type="text" class="form-control" id="username"
                                                placeholder="Nama anda" aria-label="username" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <textarea class="form-control" id="pesan" rows="3" placeholder="Ceritakan sedikit keluhan anda" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-grid">
                                            <button type="submit" style="border: none">
                                                <img alt="Chat on WhatsApp"
                                                    src="{{ asset('assets/img/WhatsAppButtonGreenLarge.svg') }}" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Copyright - Bootstrap Brain Component -->
        <div class="bg-light py-4 py-md-5 py-xl-8 border-top border-light-subtle ">
            <div class="container overflow-hidden">
                <div class="row gy-4 gy-md-0">
                    <div class="col-xs-12 col-sm-6 col-md-4 order-0 order-md-0">
                        <div class="footer-logo-wrapper text-center text-sm-start">
                            Komplek Pondok Gede Housing 1
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-4 order-2 order-md-1">
                        <div class="footer-copyright-wrapper text-center">
                            &copy; {{ date('Y') }}. All Rights Reserved.
                        </div>
                        <div class="credits text-secondary text-center mt-2 fs-7">
                            Built by Fabian with <span class="text-danger">&#9829;</span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 order-1 order-md-2">
                        <ul class="nav justify-content-center justify-content-sm-end">
                            <li class="nav-item">
                                <a class="nav-link link-dark" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-dark" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                        <path
                                            d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-dark" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                        <path
                                            d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-dark" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </footer>
@endsection
