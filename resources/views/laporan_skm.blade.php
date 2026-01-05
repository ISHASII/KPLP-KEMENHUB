<!DOCTYPE html>
<html lang="en">

<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>Laporan SKM</x-navbar>
        <div class="container-fluid py-4">
            <!-- Form Input Data -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 id="formTitle">Tambah Data Survei Kepuasan Masyarakat (SKM)</h6>
                        </div>
                        <div class="card-body">
                            <form id="skmForm" action="{{ route('skm.store') }}" method="POST">
                                @csrf
                                <input type="hidden" id="formMethod" name="_method" value="POST">
                                <input type="hidden" id="dataId" name="id">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tanggal" class="form-control-label">Tanggal Survei</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                required value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="responden" class="form-control-label">Jumlah Responden</label>
                                            <input type="number" class="form-control" id="responden" name="responden"
                                                min="0" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ipk" class="form-control-label">IPK (Indeks
                                                Kepuasan)</label>
                                            <div class="input-group">
                                                <input type="number" step="0.01" class="form-control" id="ipk"
                                                    name="ipk" min="0" max="100" value="0.00"
                                                    required>
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <small class="text-muted">Contoh: 85.50</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ikm" class="form-control-label">IKM (Indeks
                                                Kualitas)</label>
                                            <div class="input-group">
                                                <input type="number" step="0.01" class="form-control" id="ikm"
                                                    name="ikm" min="0" max="100" value="0.00"
                                                    required>
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <small class="text-muted">Contoh: 87.25</small>
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
                            <h6>Data Survei Kepuasan Masyarakat (SKM)</h6>
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
                                                Responden</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                IPK</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                IKM</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Aksi</th>
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
                                                    <span class="badge bg-gradient-info px-3 py-2">
                                                        {{ number_format($item->responden, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span class="badge bg-gradient-primary px-3 py-2">
                                                        {{ number_format($item->ipk, 2) }}%
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span class="badge bg-gradient-success px-3 py-2">
                                                        {{ number_format($item->ikm, 2) }}%
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <button type="button" class="btn btn-sm btn-info edit-btn me-1"
                                                        data-id="{{ $item->id }}"
                                                        data-tanggal="{{ $item->tanggal }}"
                                                        data-responden="{{ $item->responden }}"
                                                        data-ipk="{{ $item->ipk }}"
                                                        data-ikm="{{ $item->ikm }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('skm.destroy', $item->id) }}"
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
                                                    <p class="text-sm text-secondary mb-0">Belum ada data survei
                                                        kepuasan masyarakat</p>
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

    <!-- CSS tambahan untuk tabel rapi (sama di semua halaman) -->
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
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), {
                damping: '0.5'
            });
        }

        function editData(id, tanggal, responden, ipk, ikm) {
            document.getElementById('formTitle').textContent = 'Edit Data Survei SKM';
            document.getElementById('dataId').value = id;
            document.getElementById('tanggal').value = tanggal;
            document.getElementById('responden').value = responden;
            document.getElementById('ipk').value = parseFloat(ipk).toFixed(2);
            document.getElementById('ikm').value = parseFloat(ikm).toFixed(2);

            const form = document.getElementById('skmForm');
            form.action = `/laporan-skm/${id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';

            document.getElementById('cancelButton').style.display = 'inline-block';
            form.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function resetForm() {
            document.getElementById('formTitle').textContent = 'Tambah Data Survei Kepuasan Masyarakat (SKM)';
            document.getElementById('dataId').value = '';

            const form = document.getElementById('skmForm');
            form.action = "{{ route('skm.store') }}";
            form.querySelector('input[name="_method"]').value = 'POST';

            form.reset();
            document.getElementById('cancelButton').style.display = 'none';

            document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
            document.getElementById('responden').value = 0;
            document.getElementById('ipk').value = '0.00';
            document.getElementById('ikm').value = '0.00';
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const tanggal = this.dataset.tanggal;
                    const responden = this.dataset.responden;
                    const ipk = this.dataset.ipk;
                    const ikm = this.dataset.ikm;
                    editData(id, tanggal, responden, ipk, ikm);
                });
            });

            // Format desimal otomatis saat blur
            ['ipk', 'ikm'].forEach(id => {
                document.getElementById(id).addEventListener('blur', function() {
                    let val = parseFloat(this.value);
                    if (isNaN(val)) val = 0;
                    val = Math.max(0, Math.min(100, val));
                    this.value = val.toFixed(2);
                });
            });

            // Validasi saat submit
            document.getElementById('skmForm').addEventListener('submit', function(e) {
                const tanggal = document.getElementById('tanggal').value;
                const responden = parseInt(document.getElementById('responden').value);
                const ipk = parseFloat(document.getElementById('ipk').value);
                const ikm = parseFloat(document.getElementById('ikm').value);

                if (!tanggal) {
                    e.preventDefault();
                    alert('Tanggal survei harus diisi!');
                    return;
                }
                if (isNaN(responden) || responden < 0) {
                    e.preventDefault();
                    alert('Jumlah responden harus angka positif!');
                    return;
                }
                if (isNaN(ipk) || ipk < 0 || ipk > 100) {
                    e.preventDefault();
                    alert('IPK harus antara 0.00 - 100.00!');
                    return;
                }
                if (isNaN(ikm) || ikm < 0 || ikm > 100) {
                    e.preventDefault();
                    alert('IKM harus antara 0.00 - 100.00!');
                    return;
                }
            });
        });
    </script>

    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
