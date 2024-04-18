@extends('layouts.master', ['title' => 'Dashboard | Manajement Surat'])
@section('content')
    <div class="page-heading">
        <h3>Beranda</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="alert alert-info">
                    @if (Auth::guard('pegawais')->check())
                        Selamat Datang, <strong>{{ Auth::guard('pegawais')->user()->name }}</strong>
                    @endif
                    @if (Auth::check())
                        Selamat Datang, <strong>{{ Auth::user()->name }}</strong>
                    @endif
                </div>
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <i class="bi bi-files text text-primary fs-4"></i>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 mt-4">
                                        <h6 class="text-muted font-semibold">Total Arsip Digital</h6>
                                        <h6 class="font-extrabold mb-0">{{ $arsip }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <i class="bi bi-file-earmark-text text-primary fs-4"></i>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 mt-4">
                                        <h6 class="text-muted font-semibold">Kategori</h6>
                                        <h6 class="font-extrabold mb-0">{{ $kategori }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <i class="bi bi-person text-primary fs-3"></i>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7 mt-4">
                                        <h6 class="text-muted font-semibold">Petugas</h6>
                                        <h6 class="font-extrabold mb-0">{{ $admin }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Statistik Arsip {{ date('Y') }}</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="{{asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
    <script>
        async function fetchData(params) {
            
            const datas  = await fetch('{{Route("statistik.arsip")}}')
            const response = await datas.json()
            console.log(response);
            var optionsProfileVisit = {
                annotations: {
                    position: "back",
                },
                dataLabels: {
                    enabled: false,
                },
                chart: {
                    type: "bar",
                    height: 300,
                },
                fill: {
                    opacity: 1,
                },
                plotOptions: {},
                series: [{
                    name: "Arsip Digital",
                    data: [response[0].count, response[1].count, response[2].count, response[3].count, response[4].count, response[5].count, response[6].count, response[7].count, response[8].count, response[9].count, response[10].count, response[11].count],
                }, ],
                colors: "#435ebe",
                xaxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                },
            };
            var chartProfileVisit = new ApexCharts(
                document.querySelector("#chart-profile-visit"),
                optionsProfileVisit
            );
            chartProfileVisit.render()
        } 
        fetchData()  
    </script>
@endsection
