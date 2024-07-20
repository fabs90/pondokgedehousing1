@extends('admin.layouts.master')
@section('page-title', 'Home')
@section('page-breadcrumb', '')
@section('dashboard-content')
    {{-- Left Sides Columns --}}
    <div class="col-lg-12">
        <div class="row">
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item filter-option" href="#"
                                    data-item="{{ $carouselUtama + $carouselPromo + $carouselGaleri + $informasi + $kontak }}"
                                    data-text="Semua Item">Semua Item</a></li>

                            <li><a class="dropdown-item filter-option" href="#" data-item="{{ $carouselUtama }}"
                                    data-text="Carousel Menu">Carousel Menu
                                    Utama</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-item="{{ $carouselPromo }}"
                                    data-text="Carousel Promo">Carousel Promo</a>
                            </li>
                            <li><a class="dropdown-item filter-option" href="#" data-item="{{ $carouselGaleri }}"
                                    data-text="Carousel Galeri">Carousel Galeri</a>
                            </li>
                            <li><a class="dropdown-item filter-option" href="#" data-item="{{ $informasi }}"
                                    data-text="Informasi">Informasi</a></li>
                            <li><a class="dropdown-item filter-option" href="#" data-item="{{ $kontak }}"
                                    data-text="Kontak">Kontak</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Total Item <span>| {{ date('Y-m-d') }}</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-archive"></i>
                            </div>
                            <div class="ps-3">
                                <h6 id="total-item">
                                    {{ $carouselUtama + $carouselPromo + $carouselGaleri + $informasi + $kontak }}</h6>
                                <span id="percentage-change" class="text-success small pt-1 fw-bold">Semua Item</span>
                                {{-- <span class="text-muted small pt-2 ps-1">increase</span> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Sales Card -->


            <!-- Calendar Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Kalender</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-calendar"></i>
                            </div>
                            <div class="ps-3">
                                <h5 style="font-weight: 700; color:#012970;">Tambah jadwal di kalender?
                                    </h6>
                                    <span class="text-success small pt-1 fw-bold" style="margin-left:4px;"><a
                                            href="https://calendar.google.com/calendar/u/0/r" target="_blank">Klik
                                            disini!</a></span>

                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Calendar Card -->


            <!-- Website Traffic -->
            <div class="col-12">
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Website Traffic <span>| Today</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Access From',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                                value: {{ $trafficWeb[0]->counter }},
                                                name: 'Search Engine'
                                            },
                                            {
                                                value: 735,
                                                name: 'WhatsApp'
                                            },
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
            <!-- End Website Traffic -->


        </div>
    </div><!-- End Left side columns -->

@endsection
