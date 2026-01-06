<!DOCTYPE html>
<html lang="en">
<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <x-navbar>Dashboard</x-navbar>

        <div class="container-fluid py-4">
            <!-- KEMENHUB THEME -- COLORS: blue + yellow -->
            <style>
                :root {
                    --kh-blue-1: #0b4fa8;
                    /* dark blue */
                    --kh-blue-2: #1976d2;
                    /* medium blue */
                    --kh-yellow: #f6c200;
                    /* kemenhub yellow accent */
                    --kh-muted: #f4f7fb;
                    --card-radius: 14px;
                }

                /* Card header style for kemenhub look */
                .kh-card-header {
                    background: linear-gradient(90deg, var(--kh-blue-1), var(--kh-blue-2));
                    color: white;
                    border-top-left-radius: var(--card-radius);
                    border-top-right-radius: var(--card-radius);
                    box-shadow: 0 6px 18px rgba(10, 50, 100, 0.08);
                }

                /* Title accent */
                .kh-title {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

                .kh-title .dot-accent {
                    width: 10px;
                    height: 10px;
                    background: var(--kh-yellow);
                    border-radius: 3px;
                    box-shadow: 0 1px 6px rgba(0, 0, 0, 0.15);
                }

                .card.h-100 {
                    border-radius: var(--card-radius);
                    overflow: hidden;
                }

                .card-body {
                    background: white;
                }

                /* small helper to make inputs fit the header without breaking design */
                .kh-header-controls input[type="date"] {
                    max-width: 160px;
                }

                /* legend and labels color tweaks for better contrast */
                .chartjs-legend,
                .chartjs-tooltip {
                    color: #111
                }

                /* responsive tweak for small screens */
                @media (max-width: 575px) {
                    .kh-header-controls input[type="date"] {
                        max-width: 120px;
                    }
                }
            </style>

            {{-- Flash Messages for Success/Error --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- ROW 1: LAYANAN PUBLIK (LEFT) + PPID (RIGHT) -->
            <div class="row">
                <!-- LAYANAN -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div
                            class="card-header pb-0 p-3 d-flex justify-content-between align-items-center kh-card-header">
                            <div>
                                <div class="kh-title">
                                    <span class="dot-accent"></span>
                                    <div>
                                        <h6 class="mb-0 text-white">Statistik Layanan Publik</h6>
                                        <p class="text-sm text-white-50 mb-0" id="periode-layanan">
                                            {{ \Carbon\Carbon::parse($layananStart)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($layananEnd)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 kh-header-controls">
                                <input type="date" id="layanan_start" class="form-control form-control-sm"
                                    value="{{ $layananStart }}">
                                <span class="text-white">s/d</span>
                                <input type="date" id="layanan_end" class="form-control form-control-sm"
                                    value="{{ $layananEnd }}">
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <canvas id="layananChart" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <!-- PPID -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div
                            class="card-header pb-0 p-3 d-flex justify-content-between align-items-center kh-card-header">
                            <div>
                                <div class="kh-title">
                                    <span class="dot-accent"></span>
                                    <div>
                                        <h6 class="mb-0 text-white">Pemohon Layanan PPID</h6>
                                        <p class="text-sm text-white-50 mb-0" id="periode-ppid">
                                            {{ \Carbon\Carbon::parse($ppidStart)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($ppidEnd)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 kh-header-controls">
                                <input type="date" id="ppid_start" class="form-control form-control-sm"
                                    value="{{ $ppidStart }}">
                                <span class="text-white">s/d</span>
                                <input type="date" id="ppid_end" class="form-control form-control-sm"
                                    value="{{ $ppidEnd }}">
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <canvas id="ppidChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 2: SKM (LEFT) + MEDIA VISUAL (RIGHT) -->
            <div class="row">
                <!-- SKM -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div
                            class="card-header pb-0 p-3 d-flex justify-content-between align-items-center kh-card-header">
                            <div>
                                <div class="kh-title">
                                    <span class="dot-accent"></span>
                                    <div>
                                        <h6 class="mb-0 text-white">Survey Kepuasan Masyarakat (SKM)</h6>
                                        <p class="text-sm text-white-50 mb-0" id="periode-skm">
                                            {{ \Carbon\Carbon::parse($skmStart)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($skmEnd)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 kh-header-controls">
                                <input type="date" id="skm_start" class="form-control form-control-sm"
                                    value="{{ $skmStart }}">
                                <span class="text-white">s/d</span>
                                <input type="date" id="skm_end" class="form-control form-control-sm"
                                    value="{{ $skmEnd }}">
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <canvas id="skmChart" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <!-- MEDIA VISUAL -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div
                            class="card-header pb-0 p-3 d-flex justify-content-between align-items-center kh-card-header">
                            <div>
                                <div class="kh-title">
                                    <span class="dot-accent"></span>
                                    <div>
                                        <h6 class="mb-0 text-white">Laporan Media Visual</h6>
                                        <p class="text-sm text-white-50 mb-0" id="periode-media">
                                            {{ \Carbon\Carbon::parse($mediaStart ?? now())->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($mediaEnd ?? now())->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 kh-header-controls">
                                <input type="date" id="media_start" class="form-control form-control-sm"
                                    value="{{ $mediaStart ?? \Carbon\Carbon::now()->startOfMonth()->toDateString() }}">
                                <span class="text-white">s/d</span>
                                <input type="date" id="media_end" class="form-control form-control-sm"
                                    value="{{ $mediaEnd ?? \Carbon\Carbon::now()->endOfMonth()->toDateString() }}">
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <canvas id="mediaChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 3: BERITA KPLP (LEFT) + SIARAN PERS (RIGHT) -->
            <div class="row">
                <!-- BERITA KPLP -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div
                            class="card-header pb-0 p-3 d-flex justify-content-between align-items-center kh-card-header">
                            <div>
                                <div class="kh-title">
                                    <span class="dot-accent"></span>
                                    <div>
                                        <h6 class="mb-0 text-white">Laporan Berita KPLP</h6>
                                        <p class="text-sm text-white-50 mb-0" id="periode-berita">
                                            {{ \Carbon\Carbon::parse($beritaStart)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($beritaEnd)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 kh-header-controls">
                                <input type="date" id="berita_start" class="form-control form-control-sm"
                                    value="{{ $beritaStart }}">
                                <span class="text-white">s/d</span>
                                <input type="date" id="berita_end" class="form-control form-control-sm"
                                    value="{{ $beritaEnd }}">
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <canvas id="beritaChart" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <!-- SIARAN PERS -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div
                            class="card-header pb-0 p-3 d-flex justify-content-between align-items-center kh-card-header">
                            <div>
                                <div class="kh-title">
                                    <span class="dot-accent"></span>
                                    <div>
                                        <h6 class="mb-0 text-white">Laporan Siaran Pers</h6>
                                        <p class="text-sm text-white-50 mb-0" id="periode-siaran">
                                            {{ \Carbon\Carbon::parse($siaranStart)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($siaranEnd)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 kh-header-controls">
                                <input type="date" id="siaran_start" class="form-control form-control-sm"
                                    value="{{ $siaranStart }}">
                                <span class="text-white">s/d</span>
                                <input type="date" id="siaran_end" class="form-control form-control-sm"
                                    value="{{ $siaranEnd }}">
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <canvas id="siaranChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW 4: PENGELOLAAN LAPORAN MASUK (full width) -->
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card h-100">
                        <div
                            class="card-header pb-0 p-3 d-flex justify-content-between align-items-center kh-card-header">
                            <div>
                                <div class="kh-title">
                                    <span class="dot-accent"></span>
                                    <div>
                                        <h6 class="mb-0 text-white">Pengelolaan Laporan Masuk</h6>
                                        <p class="text-sm text-white-50 mb-0" id="periode-pengelolaan">
                                            {{ \Carbon\Carbon::parse($pengelolaanStart)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($pengelolaanEnd)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 kh-header-controls">
                                <input type="date" id="pengelolaan_start" class="form-control form-control-sm"
                                    value="{{ $pengelolaanStart }}">
                                <span class="text-white">s/d</span>
                                <input type="date" id="pengelolaan_end" class="form-control form-control-sm"
                                    value="{{ $pengelolaanEnd }}">
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <canvas id="pengelolaanChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <x-footer></x-footer>
        </div>
    </main>

    <!-- Chart.js + Plugin Angka di Atas Bar -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
        Chart.register(ChartDataLabels);
    </script>

    <!-- ========== GRAFIK LAYANAN PUBLIK ========== -->
    <script>
        // palette helper matching kemenhub
        const KH_PALETTE = {
            blue1: 'rgba(11,79,168,0.85)',
            blue2: 'rgba(25,118,210,0.85)',
            yellow: 'rgba(246,194,0,0.95)',
            teal: 'rgba(75,192,192,0.85)',
            violet: 'rgba(153,102,255,0.85)',
            orange: 'rgba(255,159,64,0.85)',
            gray: 'rgba(99,99,99,0.85)'
        };

        let layananChart = null;

        document.addEventListener('DOMContentLoaded', () => {
            const allValues = [
                ...@json($datasets['Penyidikan & Penyelidikan'] ?? []),
                ...@json($datasets['Patroli Kapal'] ?? []),
                ...@json($datasets['SAR'] ?? []),
                ...@json($datasets['SNBP'] ?? []),
                ...@json($datasets['Pengawasan Salvage'] ?? []),
                ...@json($datasets['Marpol'] ?? []),
                ...@json($datasets['Tamu Kantor'] ?? [])
            ];
            const maxValue = Math.max(...allValues, 1);

            layananChart = new Chart(document.getElementById('layananChart'), {
                type: 'bar',
                data: {
                    labels: @json($labels ?? []),
                    datasets: [{
                        label: 'Penyidikan & Penyelidikan',
                        data: @json($datasets['Penyidikan & Penyelidikan'] ?? []),
                        backgroundColor: KH_PALETTE.blue1
                    },
                    {
                        label: 'Patroli Kapal',
                        data: @json($datasets['Patroli Kapal'] ?? []),
                        backgroundColor: KH_PALETTE.blue2
                    },
                    {
                        label: 'SAR',
                        data: @json($datasets['SAR'] ?? []),
                        backgroundColor: KH_PALETTE.yellow
                    },
                    {
                        label: 'SNBP',
                        data: @json($datasets['SNBP'] ?? []),
                        backgroundColor: KH_PALETTE.teal
                    },
                    {
                        label: 'Pengawasan Salvage',
                        data: @json($datasets['Pengawasan Salvage'] ?? []),
                        backgroundColor: KH_PALETTE.violet
                    },
                    {
                        label: 'Marpol',
                        data: @json($datasets['Marpol'] ?? []),
                        backgroundColor: KH_PALETTE.orange
                    },
                    {
                        label: 'Tamu Kantor',
                        data: @json($datasets['Tamu Kantor'] ?? []),
                        backgroundColor: KH_PALETTE.gray
                    }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 11
                                },
                                color: '#0b2540'
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#0b2540',
                            font: {
                                weight: 'bold',
                                size: 12
                            },
                            formatter: v => v > 0 ? v : ''
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxValue * 1.4,
                            ticks: {
                                color: '#0b2540'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#0b2540'
                            }
                        }
                    }
                }
            });
        });

        function updateLayanan() {
            const s = document.getElementById('layanan_start').value;
            const e = document.getElementById('layanan_end').value;
            if (!s || !e) return;
            document.getElementById('periode-layanan').innerHTML = '<small class="text-white-50">Memuat...</small>';
            fetch(`?layanan_start=${s}&layanan_end=${e}`)
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    eval(doc.querySelector('#layanan-data').innerHTML);
                    layananChart.data.labels = window.layananLabels;
                    layananChart.data.datasets.forEach((d, i) => d.data = window.layananDatasets[i] || []);
                    const newMax = Math.max(...(window.layananDatasets.flat()), 1);
                    layananChart.options.scales.y.suggestedMax = newMax * 1.4;
                    layananChart.update();
                    document.getElementById('periode-layanan').textContent = window.layananPeriode;
                });
        }
        document.getElementById('layanan_start').addEventListener('change', updateLayanan);
        document.getElementById('layanan_end').addEventListener('change', updateLayanan);
    </script>

    <!-- ========== GRAFIK PPID ========== -->
    <script>
        let ppidChart = null;
        document.addEventListener('DOMContentLoaded', () => {
            const maxPpid = Math.max(...@json($ppidValues ?? []), 1);
            ppidChart = new Chart(document.getElementById('ppidChart'), {
                type: 'bar',
                data: {
                    labels: @json($ppidLabels ?? []),
                    datasets: [{
                        label: 'Jumlah Pemohon',
                        data: @json($ppidValues ?? []),
                        backgroundColor: KH_PALETTE.blue2,
                        borderRadius: 8,
                        maxBarThickness: 80
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#0b2540',
                            font: {
                                weight: 'bold',
                                size: 13
                            },
                            formatter: v => v > 0 ? v : ''
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxPpid * 1.6,
                            ticks: {
                                color: '#0b2540'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#0b2540'
                            }
                        }
                    }
                }
            });
        });

        function updatePpid() {
            const s = document.getElementById('ppid_start').value;
            const e = document.getElementById('ppid_end').value;
            if (!s || !e) return;
            document.getElementById('periode-ppid').innerHTML = '<small class="text-white-50">Memuat...</small>';
            fetch(`?ppid_start=${s}&ppid_end=${e}`)
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    eval(doc.querySelector('#ppid-data').innerHTML);
                    ppidChart.data.labels = window.ppidLabels;
                    ppidChart.data.datasets[0].data = window.ppidValues;
                    const newMax = Math.max(...window.ppidValues, 1);
                    ppidChart.options.scales.y.suggestedMax = newMax * 1.6;
                    ppidChart.update();
                    document.getElementById('periode-ppid').textContent = window.ppidPeriode;
                });
        }
        document.getElementById('ppid_start').addEventListener('change', updatePpid);
        document.getElementById('ppid_end').addEventListener('change', updatePpid);
    </script>

    <!-- ========== GRAFIK SKM ========== -->
    <script>
        let skmChart = null;

        document.addEventListener('DOMContentLoaded', () => {
            const maxSkm = Math.max(
                ...@json($skmResponden ?? []),
                ...@json($skmIpk ?? []),
                ...@json($skmIkm ?? []),
                1
            );

            skmChart = new Chart(document.getElementById('skmChart'), {
                type: 'bar',
                data: {
                    labels: @json($skmLabels ?? []),
                    datasets: [{
                        label: 'Responden',
                        data: @json($skmResponden ?? []),
                        backgroundColor: KH_PALETTE.blue2
                    },
                    {
                        label: 'IPK',
                        data: @json($skmIpk ?? []),
                        backgroundColor: KH_PALETTE.yellow
                    },
                    {
                        label: 'IKM',
                        data: @json($skmIkm ?? []),
                        backgroundColor: KH_PALETTE.teal
                    }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#0b2540'
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#0b2540',
                            font: {
                                weight: 'bold',
                                size: 13
                            },
                            formatter: v => v > 0 ? v : ''
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxSkm * 1.5,
                            ticks: {
                                color: '#0b2540'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#0b2540'
                            }
                        }
                    }
                }
            });
        });

        function updateSkm() {
            const s = document.getElementById('skm_start').value;
            const e = document.getElementById('skm_end').value;
            if (!s || !e) return;
            document.getElementById('periode-skm').innerHTML = '<small class="text-white-50">Memuat...</small>';
            fetch(`?skm_start=${s}&skm_end=${e}`)
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    eval(doc.querySelector('#skm-data').innerHTML);
                    skmChart.data.labels = window.skmLabels;
                    skmChart.data.datasets[0].data = window.skmResponden;
                    skmChart.data.datasets[1].data = window.skmIpk;
                    skmChart.data.datasets[2].data = window.skmIkm;
                    const newMax = Math.max(...window.skmResponden, ...window.skmIpk, ...window.skmIkm, 1);
                    skmChart.options.scales.y.suggestedMax = newMax * 1.5;
                    skmChart.update();
                    document.getElementById('periode-skm').textContent = window.skmPeriode;
                });
        }
        document.getElementById('skm_start').addEventListener('change', updateSkm);
        document.getElementById('skm_end').addEventListener('change', updateSkm);
    </script>

    <!-- ========== GRAFIK MEDIA VISUAL (BAR) ========== -->
    <script>
        let mediaChart = null;

        document.addEventListener('DOMContentLoaded', () => {
            const maxMedia = Math.max(...@json($mediaTayangan ?? []), ...@json($mediaPengikut ?? []), 1);

            mediaChart = new Chart(document.getElementById('mediaChart'), {
                type: 'bar',
                data: {
                    labels: @json($mediaLabels ?? []),
                    datasets: [{
                        label: 'Tayangan/Postingan',
                        data: @json($mediaTayangan ?? []),
                        backgroundColor: KH_PALETTE.blue2
                    },
                    {
                        label: 'Pengikut',
                        data: @json($mediaPengikut ?? []),
                        backgroundColor: KH_PALETTE.yellow
                    }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#0b2540',
                            font: {
                                weight: 'bold',
                                size: 13
                            },
                            formatter: v => v > 0 ? v : ''
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxMedia * 1.5,
                            ticks: {
                                color: '#0b2540'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#0b2540'
                            }
                        }
                    }
                }
            });
        });

        function updateMedia() {
            const s = document.getElementById('media_start').value;
            const e = document.getElementById('media_end').value;
            if (!s || !e) return;
            document.getElementById('periode-media').innerHTML = '<small class="text-white-50">Memuat...</small>';
            fetch(`?media_start=${s}&media_end=${e}`)
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    eval(doc.querySelector('#media-data').innerHTML);
                    mediaChart.data.labels = window.mediaLabels;
                    mediaChart.data.datasets[0].data = window.mediaTayangan;
                    mediaChart.data.datasets[1].data = window.mediaPengikut;
                    const newMax = Math.max(...window.mediaTayangan, ...window.mediaPengikut, 1);
                    mediaChart.options.scales.y.suggestedMax = newMax * 1.5;
                    mediaChart.update();
                    document.getElementById('periode-media').textContent = window.mediaPeriode;
                });
        }
        document.getElementById('media_start').addEventListener('change', updateMedia);
        document.getElementById('media_end').addEventListener('change', updateMedia);
    </script>

    <!-- ========== GRAFIK BERITA KPLP (BAR) ========== -->
    <script>
        let beritaChart = null;

        document.addEventListener('DOMContentLoaded', () => {
            const maxBerita = Math.max(...@json($beritaPositif ?? []), ...@json($beritaNegatif ?? []), 1);

            beritaChart = new Chart(document.getElementById('beritaChart'), {
                type: 'bar',
                data: {
                    labels: @json($beritaLabels ?? []),
                    datasets: [{
                        label: 'Berita Positif',
                        data: @json($beritaPositif ?? []),
                        backgroundColor: KH_PALETTE.teal
                    },
                    {
                        label: 'Berita Negatif',
                        data: @json($beritaNegatif ?? []),
                        backgroundColor: KH_PALETTE.blue1
                    }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#0b2540',
                            font: {
                                weight: 'bold',
                                size: 13
                            },
                            formatter: v => v > 0 ? v : ''
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxBerita * 1.5,
                            ticks: {
                                color: '#0b2540'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#0b2540'
                            }
                        }
                    }
                }
            });
        });

        function updateBerita() {
            const s = document.getElementById('berita_start').value;
            const e = document.getElementById('berita_end').value;
            if (!s || !e) return;
            document.getElementById('periode-berita').innerHTML = '<small class="text-white-50">Memuat...</small>';
            fetch(`?berita_start=${s}&berita_end=${e}`)
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    eval(doc.querySelector('#berita-data').innerHTML);
                    beritaChart.data.labels = window.beritaLabels;
                    beritaChart.data.datasets[0].data = window.beritaPositif;
                    beritaChart.data.datasets[1].data = window.beritaNegatif;
                    const newMax = Math.max(...window.beritaPositif, ...window.beritaNegatif, 1);
                    beritaChart.options.scales.y.suggestedMax = newMax * 1.5;
                    beritaChart.update();
                    document.getElementById('periode-berita').textContent = window.beritaPeriode;
                });
        }
        document.getElementById('berita_start').addEventListener('change', updateBerita);
        document.getElementById('berita_end').addEventListener('change', updateBerita);
    </script>

    <!-- ========== GRAFIK SIARAN PERS (BAR) ========== -->
    <script>
        let siaranChart = null;

        document.addEventListener('DOMContentLoaded', () => {
            const maxSiaran = Math.max(...@json($siaranValues ?? []), 1);

            siaranChart = new Chart(document.getElementById('siaranChart'), {
                type: 'bar',
                data: {
                    labels: @json($siaranLabels ?? []),
                    datasets: [{
                        label: 'Jumlah Siaran Pers',
                        data: @json($siaranValues ?? []),
                        backgroundColor: KH_PALETTE.violet,
                        borderRadius: 8,
                        maxBarThickness: 80
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#0b2540',
                            font: {
                                weight: 'bold',
                                size: 13
                            },
                            formatter: v => v > 0 ? v : ''
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxSiaran * 1.6,
                            ticks: {
                                color: '#0b2540'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#0b2540'
                            }
                        }
                    }
                }
            });
        });

        function updateSiaran() {
            const s = document.getElementById('siaran_start').value;
            const e = document.getElementById('siaran_end').value;
            if (!s || !e) return;
            document.getElementById('periode-siaran').innerHTML = '<small class="text-white-50">Memuat...</small>';
            fetch(`?siaran_start=${s}&siaran_end=${e}`)
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    eval(doc.querySelector('#siaran-data').innerHTML);
                    siaranChart.data.labels = window.siaranLabels;
                    siaranChart.data.datasets[0].data = window.siaranValues;
                    const newMax = Math.max(...window.siaranValues, 1);
                    siaranChart.options.scales.y.suggestedMax = newMax * 1.6;
                    siaranChart.update();
                    document.getElementById('periode-siaran').textContent = window.siaranPeriode;
                });
        }
        document.getElementById('siaran_start').addEventListener('change', updateSiaran);
        document.getElementById('siaran_end').addEventListener('change', updateSiaran);
    </script>

    <!-- ========== GRAFIK PENGELOLAAN LAPORAN MASUK (BAR) ========== -->
    <script>
        let pengelolaanChart = null;

        document.addEventListener('DOMContentLoaded', () => {
            const maxPengelolaan = Math.max(
                ...@json($belumTerverifikasi ?? []),
                ...@json($terdisposisiBelumTindakLanjut ?? []),
                ...@json($terdisposisiSedangProses ?? []),
                ...@json($terdisposisiSelesai ?? []),
                ...@json($tertunda ?? []),
                1
            );

            pengelolaanChart = new Chart(document.getElementById('pengelolaanChart'), {
                type: 'bar',
                data: {
                    labels: @json($pengelolaanLabels ?? []),
                    datasets: [{
                        label: 'Belum Terverifikasi',
                        data: @json($belumTerverifikasi ?? []),
                        backgroundColor: KH_PALETTE.blue1
                    },
                    {
                        label: 'Terdisposisi Belum Tindak Lanjut',
                        data: @json($terdisposisiBelumTindakLanjut ?? []),
                        backgroundColor: KH_PALETTE.blue2
                    },
                    {
                        label: 'Terdisposisi Sedang Proses',
                        data: @json($terdisposisiSedangProses ?? []),
                        backgroundColor: KH_PALETTE.yellow
                    },
                    {
                        label: 'Terdisposisi Selesai',
                        data: @json($terdisposisiSelesai ?? []),
                        backgroundColor: KH_PALETTE.teal
                    },
                    {
                        label: 'Tertunda',
                        data: @json($tertunda ?? []),
                        backgroundColor: KH_PALETTE.violet
                    }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 11
                                },
                                color: '#0b2540'
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#0b2540',
                            font: {
                                weight: 'bold',
                                size: 13
                            },
                            formatter: v => v > 0 ? v : ''
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxPengelolaan * 1.5,
                            ticks: {
                                color: '#0b2540'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#0b2540'
                            }
                        }
                    }
                }
            });
        });

        function updatePengelolaan() {
            const s = document.getElementById('pengelolaan_start').value;
            const e = document.getElementById('pengelolaan_end').value;
            if (!s || !e) return;
            document.getElementById('periode-pengelolaan').innerHTML = '<small class="text-white-50">Memuat...</small>';
            fetch(`?pengelolaan_start=${s}&pengelolaan_end=${e}`)
                .then(r => r.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    eval(doc.querySelector('#pengelolaan-data').innerHTML);
                    pengelolaanChart.data.labels = window.pengelolaanLabels;
                    pengelolaanChart.data.datasets[0].data = window.belumTerverifikasi;
                    pengelolaanChart.data.datasets[1].data = window.terdisposisiBelumTindakLanjut;
                    pengelolaanChart.data.datasets[2].data = window.terdisposisiSedangProses;
                    pengelolaanChart.data.datasets[3].data = window.terdisposisiSelesai;
                    pengelolaanChart.data.datasets[4].data = window.tertunda;
                    const newMax = Math.max(...window.belumTerverifikasi, ...window.terdisposisiBelumTindakLanjut, ...
                        window.terdisposisiSedangProses, ...window.terdisposisiSelesai, ...window.tertunda, 1);
                    pengelolaanChart.options.scales.y.suggestedMax = newMax * 1.5;
                    pengelolaanChart.update();
                    document.getElementById('periode-pengelolaan').textContent = window.pengelolaanPeriode;
                });
        }
        document.getElementById('pengelolaan_start').addEventListener('change', updatePengelolaan);
        document.getElementById('pengelolaan_end').addEventListener('change', updatePengelolaan);
    </script>

    <!-- ========== DATA UNTUK AJAX (embed JSON arrays) ========== -->
    <script id="layanan-data">
        window.layananLabels = @json($labels ?? []);
        window.layananDatasets = [
            @json($datasets['Penyidikan & Penyelidikan'] ?? []),
            @json($datasets['Patroli Kapal'] ?? []),
            @json($datasets['SAR'] ?? []),
            @json($datasets['SNBP'] ?? []),
            @json($datasets['Pengawasan Salvage'] ?? []),
            @json($datasets['Marpol'] ?? []),
            @json($datasets['Tamu Kantor'] ?? [])
        ];
        window.layananPeriode =
            "{{ \Carbon\Carbon::parse($layananStart)->format('d M Y') }} - {{ \Carbon\Carbon::parse($layananEnd)->format('d M Y') }}";
    </script>

    <script id="ppid-data">
        window.ppidLabels = @json($ppidLabels ?? []);
        window.ppidValues = @json($ppidValues ?? []);
        window.ppidPeriode =
            "{{ \Carbon\Carbon::parse($ppidStart)->format('d M Y') }} - {{ \Carbon\Carbon::parse($ppidEnd)->format('d M Y') }}";
    </script>

    <script id="skm-data">
        window.skmLabels = @json($skmLabels ?? []);
        window.skmResponden = @json($skmResponden ?? []);
        window.skmIpk = @json($skmIpk ?? []);
        window.skmIkm = @json($skmIkm ?? []);
        window.skmPeriode =
            "{{ \Carbon\Carbon::parse($skmStart)->format('d M Y') }} - {{ \Carbon\Carbon::parse($skmEnd)->format('d M Y') }}";
    </script>

    <script id="media-data">
        window.mediaLabels = @json($mediaLabels ?? []);
        window.mediaTayangan = @json($mediaTayangan ?? []);
        window.mediaPengikut = @json($mediaPengikut ?? []);
        window.mediaPeriode =
            "{{ isset($mediaStart) ? \Carbon\Carbon::parse($mediaStart)->format('d M Y') : '' }} - {{ isset($mediaEnd) ? \Carbon\Carbon::parse($mediaEnd)->format('d M Y') : '' }}";
    </script>

    <script id="berita-data">
        window.beritaLabels = @json($beritaLabels ?? []);
        window.beritaPositif = @json($beritaPositif ?? []);
        window.beritaNegatif = @json($beritaNegatif ?? []);
        window.beritaPeriode =
            "{{ \Carbon\Carbon::parse($beritaStart)->format('d M Y') }} - {{ \Carbon\Carbon::parse($beritaEnd)->format('d M Y') }}";
    </script>

    <script id="siaran-data">
        window.siaranLabels = @json($siaranLabels ?? []);
        window.siaranValues = @json($siaranValues ?? []);
        window.siaranPeriode =
            "{{ \Carbon\Carbon::parse($siaranStart)->format('d M Y') }} - {{ \Carbon\Carbon::parse($siaranEnd)->format('d M Y') }}";
    </script>

    <script id="pengelolaan-data">
        window.pengelolaanLabels = @json($pengelolaanLabels ?? []);
        window.belumTerverifikasi = @json($belumTerverifikasi ?? []);
        window.terdisposisiBelumTindakLanjut = @json($terdisposisiBelumTindakLanjut ?? []);
        window.terdisposisiSedangProses = @json($terdisposisiSedangProses ?? []);
        window.terdisposisiSelesai = @json($terdisposisiSelesai ?? []);
        window.tertunda = @json($tertunda ?? []);
        window.pengelolaanPeriode =
            "{{ \Carbon\Carbon::parse($pengelolaanStart)->format('d M Y') }} - {{ \Carbon\Carbon::parse($pengelolaanEnd)->format('d M Y') }}";
    </script>


    <!-- Soft UI Scripts -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
