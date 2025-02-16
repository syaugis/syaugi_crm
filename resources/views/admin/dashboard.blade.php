<x-app-admin-layout :assets="$assets ?? []">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row row-cols-1">
                <div class="d-slider1 overflow-hidden ">
                    <ul class="swiper-wrapper list-inline m-0 p-0 mb-2">
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="border bg-soft-info rounded p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Jumlah Produk</p>
                                        <h4 class="counter" style="visibility: visible;"> {{ $data['total_products'] }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="border bg-soft-success rounded p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Jumlah Proyek</p>
                                        <h4 class="counter">{{ $data['total_project'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="border bg-soft-success rounded p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Jumlah Pelanggan</p>
                                        <h4 class="counter">{{ $data['total_customers'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                            <div class="card-body">
                                <div class="progress-widget">
                                    <div class="border bg-soft-success rounded p-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                        </svg>
                                    </div>
                                    <div class="progress-detail">
                                        <p class="mb-2">Jumlah Calon Pelanggan</p>
                                        <h4 class="counter">
                                            {{ $data['total_new_lead'] }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" data-aos="fade-up" data-aos-delay="800">
                        <div class="card-header d-flex justify-content-between flex-wrap">
                            <div class="header-title">
                                <h4 class="card-title">2</h4>
                                <p class="mb-0">Jumlah Calon Pelanggan</p>
                            </div>
                            <div class="d-flex align-items-center align-self-center">
                                <div class="d-flex align-items-center text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g id="Solid dot2">
                                            <circle id="Ellipse 65" cx="12" cy="12" r="8"
                                                fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                    <div class="ms-2">
                                        <span class="text-gray">Pelanggan</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center ms-3 text-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g id="Solid dot3">
                                            <circle id="Ellipse 66" cx="12" cy="12" r="8"
                                                fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                    <div class="ms-2">
                                        <span class="text-gray">Calon Pelanggan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="#" class="text-gray dropdown-toggle" id="dropdownMenuButton2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Minggu
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item" href="#">Minggu</a></li>
                                    <li><a class="dropdown-item" href="#">Bulan</a></li>
                                    <li><a class="dropdown-item" href="#">Tahun</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="d-main" class="d-main"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right --}}
        <div class="col-md-12 col-lg-4">
            <div class="row">

                <div class="col-md-6 col-lg-12">
                    <div class="card" data-aos="fade-up" data-aos-delay="1100">
                        <div class="card-body d-flex justify-content-around text-center">
                            <div>
                                <h2 class="mb-2"> Rp{{ number_format($data['total_revenues'], 2, ',', '.') }} </h2>
                                <p class="mb-0 text-gray">Jumlah Penghasilan
                                    @role('sales')
                                        yang telah anda tambahkan
                                    @endrole
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @role('sales')
                    <div class="col-md-6 col-lg-12">
                        <div class="card" data-aos="fade-up" data-aos-delay="1100">
                            <div class="card-body d-flex justify-content-around text-center">
                                <div>
                                    <h2 class="mb-2"> {{ $data['total_sales_lead'] }} </h2>
                                    <p class="mb-0 text-gray">Jumlah Calon Pelanggan yang telah anda tambahkan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endrole

            </div>
        </div>
    </div>
</x-app-admin-layout>
