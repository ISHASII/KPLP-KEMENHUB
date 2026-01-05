<!DOCTYPE html>
<html lang="en">

<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>Laporan Siaran Pers</x-navbar>
        <div class="container-fluid py-4">
            <!-- Form Input Data -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 id="formTitle">Tambah Data Siaran Pers</h6>
                        </div>
                        <div class="card-body">
                            <form id="persForm" method="POST" action="{{ route('siaran_pers.store') }}">
                                @csrf
                                <input type="hidden" id="formMethod" name="_method" value="POST">
                                <input type="hidden" id="dataId" name="id">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tanggal" class="form-control-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                required value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jumlah_siaran_pers" class="form-control-label">Jumlah Siaran
                                                Pers</label>
                                            <input type="number" class="form-control" id="jumlah_siaran_pers"
                                                name="jumlah_siaran_pers" min="0" value="0" required
                                                placeholder="Jumlah siaran pers">
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

            <!-- Tabel Data (sudah rapi, tidak condong ke kanan lagi) -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Data Siaran Pers</h6>
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
                                                No
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-4">
                                                Tanggal
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Jumlah Siaran Pers
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">
                                        @forelse($data as $index => $item)
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
                                                    <span class="badge bg-gradient-primary px-3 py-2">
                                                        {{ number_format($item->jumlah_siaran_pers, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <button type="button" class="btn btn-sm btn-info edit-btn me-1"
                                                        data-id="{{ $item->id }}"
                                                        data-tanggal="{{ $item->tanggal }}"
                                                        data-jumlah="{{ $item->jumlah_siaran_pers }}">
                                                        Edit
                                                    </button>

                                                    <form action="{{ route('siaran_pers.destroy', $item->id) }}"
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
                                                <td colspan="4" class="text-center py-4">
                                                    <p class="text-sm text-secondary mb-0">Belum ada data siaran pers
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

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>

    <!-- CSS tambahan supaya tabel langsung rapi (copy ini saja) -->
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
    </style>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        function editData(id, tanggal, jumlah) {
            document.getElementById('formTitle').textContent = 'Edit Data Siaran Pers';
            document.getElementById('dataId').value = id;
            document.getElementById('tanggal').value = tanggal;
            document.getElementById('jumlah_siaran_pers').value = jumlah;

            const form = document.getElementById('persForm');
            form.action = `/laporan-siaran-pers/${id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';

            document.getElementById('cancelButton').style.display = 'inline-block';
            form.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function resetForm() {
            document.getElementById('formTitle').textContent = 'Tambah Data Siaran Pers';
            document.getElementById('dataId').value = '';

            const form = document.getElementById('persForm');
            form.action = "{{ route('siaran_pers.store') }}";
            form.querySelector('input[name="_method"]').value = 'POST';

            form.reset();
            document.getElementById('cancelButton').style.display = 'none';
            document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
            document.getElementById('jumlah_siaran_pers').value = 0;
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const tanggal = this.getAttribute('data-tanggal');
                    const jumlah = this.getAttribute('data-jumlah');
                    editData(id, tanggal, jumlah);
                });
            });

            document.getElementById('jumlah_siaran_pers').addEventListener('blur', function() {
                if (this.value !== '' && !isNaN(this.value)) {
                    this.value = Math.max(0, parseInt(this.value));
                }
            });

            document.getElementById('persForm').addEventListener('submit', function(e) {
                const tanggal = document.getElementById('tanggal').value;
                const jumlah = document.getElementById('jumlah_siaran_pers').value;

                if (!tanggal) {
                    e.preventDefault();
                    alert('Tanggal harus diisi!');
                    return false;
                }
                if (!jumlah || jumlah < 0) {
                    e.preventDefault();
                    alert('Jumlah siaran pers harus angka positif!');
                    return false;
                }
            });
        });
    </script>
    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
