<!DOCTYPE html>
<html lang="en">

<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>Laporan Berita KPLP</x-navbar>
        <div class="container-fluid py-4">
            <!-- Form Input Data -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 id="formTitle">Tambah Data Berita KPLP</h6>
                        </div>
                        <div class="card-body">
                            <form id="kplpForm" method="POST" action="{{ route('berita_kplp.store') }}">
                                @csrf
                                <input type="hidden" id="formMethod" name="_method" value="POST">
                                <input type="hidden" id="dataId" name="id">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tanggal" class="form-control-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                required value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="jumlah_berita_positif" class="form-control-label">Berita
                                                Positif</label>
                                            <input type="number" class="form-control" id="jumlah_berita_positif"
                                                name="jumlah_berita_positif" min="0" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="jumlah_berita_negatif" class="form-control-label">Berita
                                                Negatif</label>
                                            <input type="number" class="form-control" id="jumlah_berita_negatif"
                                                name="jumlah_berita_negatif" min="0" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-control-label">Total Berita</label>
                                            <div class="form-control bg-gray-100 text-center">
                                                <span id="totalBerita" class="font-weight-bold text-lg">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-primary" id="submitButton">Simpan
                                            Data</button>
                                        <button type="button" class="btn bg-gradient-secondary" id="cancelButton"
                                            style="display: none;" onclick="resetForm()">Batal Edit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data (sudah rapi & seimbang) -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Data Berita KPLP</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-4">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-4">
                                                Tanggal</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Berita Positif</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Berita Negatif</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Total</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">
                                        @forelse($data as $index => $item)
                                            @php
                                                $total = $item->jumlah_berita_positif + $item->jumlah_berita_negatif;
                                            @endphp
                                            <tr id="row-{{ $item->id }}">
                                                <td class="ps-4 py-3">
                                                    <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                                </td>
                                                <td class="ps-4 py-3">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                                    </h6>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span class="badge bg-gradient-success px-3 py-2">
                                                        {{ number_format($item->jumlah_berita_positif, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span class="badge bg-gradient-danger px-3 py-2">
                                                        {{ number_format($item->jumlah_berita_negatif, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span class="badge bg-gradient-primary px-3 py-2">
                                                        {{ number_format($total, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <button type="button" class="btn btn-sm btn-info edit-btn me-1"
                                                        data-id="{{ $item->id }}"
                                                        data-tanggal="{{ $item->tanggal }}"
                                                        data-positif="{{ $item->jumlah_berita_positif }}"
                                                        data-negatif="{{ $item->jumlah_berita_negatif }}">
                                                        Edit
                                                    </button>

                                                    <form action="{{ route('berita_kplp.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <p class="text-sm text-secondary mb-0">Belum ada data berita KPLP
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-footer></x-footer>
        </div>
    </main>
    <x-sidebar-plugin></x-sidebar-plugin>

    <!-- Core JS Files -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>

    <!-- CSS tambahan untuk tabel rapi -->
    <style>
        .table> :not(caption)>*>* {
            padding: 0.75rem 1rem;
            vertical-align: middle;
        }

        .table td.ps-4 {
            padding-left: 1.5rem !important;
        }

        .table .btn-sm {
            margin: 0 0.25rem;
            min-width: 70px;
        }

        .badge {
            font-size: 0.875rem;
            font-weight: 600;
        }

        #totalBerita {
            font-size: 1.25rem;
        }
    </style>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), {
                damping: '0.5'
            });
        }

        // Hitung total berita secara real-time
        function calculateTotal() {
            const positif = parseInt(document.getElementById('jumlah_berita_positif').value) || 0;
            const negatif = parseInt(document.getElementById('jumlah_berita_negatif').value) || 0;
            const total = positif + negatif;
            document.getElementById('totalBerita').textContent = total.toLocaleString('id-ID');
        }

        function editData(id, tanggal, positif, negatif) {
            document.getElementById('formTitle').textContent = 'Edit Data Berita KPLP';
            document.getElementById('dataId').value = id;
            document.getElementById('tanggal').value = tanggal;
            document.getElementById('jumlah_berita_positif').value = positif;
            document.getElementById('jumlah_berita_negatif').value = negatif;

            calculateTotal();

            const form = document.getElementById('kplpForm');
            form.action = `/laporan-berita-kplp/${id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';

            document.getElementById('cancelButton').style.display = 'inline-block';
            form.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function resetForm() {
            document.getElementById('formTitle').textContent = 'Tambah Data Berita KPLP';
            document.getElementById('dataId').value = '';

            const form = document.getElementById('kplpForm');
            form.action = "{{ route('berita_kplp.store') }}";
            form.querySelector('input[name="_method"]').value = 'POST';

            form.reset();
            document.getElementById('cancelButton').style.display = 'none';

            document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
            document.getElementById('jumlah_berita_positif').value = 0;
            document.getElementById('jumlah_berita_negatif').value = 0;
            calculateTotal();
        }

        document.addEventListener('DOMContentLoaded', function() {
            calculateTotal();

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const tanggal = this.dataset.tanggal;
                    const positif = this.dataset.positif;
                    const negatif = this.dataset.negatif;
                    editData(id, tanggal, positif, negatif);
                });
            });

            document.getElementById('jumlah_berita_positif').addEventListener('input', calculateTotal);
            document.getElementById('jumlah_berita_negatif').addEventListener('input', calculateTotal);

            ['jumlah_berita_positif', 'jumlah_berita_negatif'].forEach(id => {
                document.getElementById(id).addEventListener('blur', function() {
                    let val = parseInt(this.value);
                    this.value = (isNaN(val) || val < 0) ? 0 : val;
                    calculateTotal();
                });
            });

            document.getElementById('kplpForm').addEventListener('submit', function(e) {
                const tanggal = document.getElementById('tanggal').value;
                if (!tanggal) {
                    e.preventDefault();
                    alert('Tanggal harus diisi!');
                }
            });
        });
    </script>

    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
