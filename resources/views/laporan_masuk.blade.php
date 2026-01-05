<!DOCTYPE html>
<html lang="en">
<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>Pengelolaan Laporan Masuk</x-navbar>
        <div class="container-fluid py-4">

            <!-- Form Input Data -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 id="formTitle">Tambah Data Pengelolaan Laporan Masuk</h6>
                        </div>
                        <div class="card-body">
                            <form id="masukForm" method="POST" action="{{ route('laporan_masuk.store') }}">
                                @csrf
                                <input type="hidden" id="formMethod" name="_method" value="POST">
                                <input type="hidden" id="dataId" name="id">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tanggal" class="form-control-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                required value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="belum_terverifikasi" class="form-control-label">Belum
                                                Terverifikasi</label>
                                            <input type="number" class="form-control" id="belum_terverifikasi"
                                                name="belum_terverifikasi" min="0" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="terdisposisi_belum_tindak_lanjut"
                                                class="form-control-label">Terdisposisi (Belum TL)</label>
                                            <input type="number" class="form-control"
                                                id="terdisposisi_belum_tindak_lanjut"
                                                name="terdisposisi_belum_tindak_lanjut" min="0" value="0"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="terdisposisi_sedang_proses"
                                                class="form-control-label">Terdisposisi (Proses)</label>
                                            <input type="number" class="form-control" id="terdisposisi_sedang_proses"
                                                name="terdisposisi_sedang_proses" min="0" value="0"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="terdisposisi_selesai" class="form-control-label">Terdisposisi
                                                (Selesai)</label>
                                            <input type="number" class="form-control" id="terdisposisi_selesai"
                                                name="terdisposisi_selesai" min="0" value="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tertunda" class="form-control-label">Tertunda</label>
                                            <input type="number" class="form-control" id="tertunda" name="tertunda"
                                                min="0" value="0" required>
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

            <!-- Tabel Data (Tanpa Kolom Progress Per Baris) -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Data Harian Pengelolaan Laporan Masuk</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-sm fw-bold">
                                                No
                                            </th>
                                            <th class="text-uppercase text-secondary text-sm fw-bold">
                                                Tanggal
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-sm fw-bold">
                                                Belum Terverifikasi
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-sm fw-bold">
                                                Belum TL
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-sm fw-bold">
                                                Proses
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-sm fw-bold">
                                                Selesai
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-sm fw-bold">
                                                Tertunda
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-sm fw-bold">
                                                Total Hari Ini
                                            </th>
                                            <th class="text-uppercase text-secondary text-sm fw-bold">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data as $index => $item)
                                            @php
                                                $totalHariIni =
                                                    $item->belum_terverifikasi +
                                                    $item->terdisposisi_belum_tindak_lanjut +
                                                    $item->terdisposisi_sedang_proses +
                                                    $item->terdisposisi_selesai +
                                                    $item->tertunda;
                                            @endphp
                                            <tr id="row-{{ $item->id }}">
                                                <td class="px-3">
                                                    <h6 class="mb-0 text-sm">{{ $index + 1 }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0 text-sm">
                                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                                    </h6>
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge bg-gradient-secondary">{{ number_format($item->belum_terverifikasi, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge bg-gradient-warning">{{ number_format($item->terdisposisi_belum_tindak_lanjut, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge bg-gradient-info">{{ number_format($item->terdisposisi_sedang_proses, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge bg-gradient-success">{{ number_format($item->terdisposisi_selesai, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center"><span
                                                        class="badge bg-gradient-danger">{{ number_format($item->tertunda, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <strong>{{ number_format($totalHariIni, 0, ',', '.') }}</strong>
                                                </td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm bg-gradient-info edit-btn me-1"
                                                        data-id="{{ $item->id }}"
                                                        data-tanggal="{{ $item->tanggal }}"
                                                        data-belum="{{ $item->belum_terverifikasi }}"
                                                        data-blumtl="{{ $item->terdisposisi_belum_tindak_lanjut }}"
                                                        data-proses="{{ $item->terdisposisi_sedang_proses }}"
                                                        data-selesai="{{ $item->terdisposisi_selesai }}"
                                                        data-tunda="{{ $item->tertunda }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('laporan_masuk.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm bg-gradient-danger"
                                                            onclick="return confirm('Yakin hapus data ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4 text-sm text-secondary">
                                                    Belum ada data pengelolaan laporan masuk
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

    <!-- Script tetap sama, hanya tambahan kecil -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>

    <script>
        // Fungsi edit & reset form (sama seperti sebelumnya)
        function editData(id, tanggal, belum, blumtl, proses, selesai, tunda) {
            document.getElementById('formTitle').textContent = 'Edit Data Pengelolaan Laporan Masuk';
            document.getElementById('dataId').value = id;
            document.getElementById('tanggal').value = tanggal;
            document.getElementById('belum_terverifikasi').value = belum;
            document.getElementById('terdisposisi_belum_tindak_lanjut').value = blumtl;
            document.getElementById('terdisposisi_sedang_proses').value = proses;
            document.getElementById('terdisposisi_selesai').value = selesai;
            document.getElementById('tertunda').value = tunda;

            const form = document.getElementById('masukForm');
            form.action = `/pengelolaan-laporan-masuk/${id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';

            document.getElementById('cancelButton').style.display = 'inline-block';
            form.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function resetForm() {
            document.getElementById('formTitle').textContent = 'Tambah Data Pengelolaan Laporan Masuk';
            document.getElementById('dataId').value = '';
            const form = document.getElementById('masukForm');
            form.action = "{{ route('laporan_masuk.store') }}";
            form.querySelector('input[name="_method"]').value = 'POST';
            form.reset();
            document.getElementById('cancelButton').style.display = 'none';
            document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
            ['belum_terverifikasi', 'terdisposisi_belum_tindak_lanjut', 'terdisposisi_sedang_proses',
                'terdisposisi_selesai', 'tertunda'
            ].forEach(id => {
                document.getElementById(id).value = 0;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    editData(
                        this.dataset.id,
                        this.dataset.tanggal,
                        this.dataset.belum,
                        this.dataset.blumtl,
                        this.dataset.proses,
                        this.dataset.selesai,
                        this.dataset.tunda
                    );
                });
            });
        });
    </script>
    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
