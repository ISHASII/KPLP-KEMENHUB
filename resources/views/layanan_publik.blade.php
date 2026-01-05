<!DOCTYPE html>
<html lang="en">

<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>Layanan Publik</x-navbar>
        <div class="container-fluid py-4">
            <!-- Form Input Data -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 id="formTitle">Tambah Data Layanan Publik</h6>
                        </div>
                        <div class="card-body">
                            <form id="layananForm" action="{{ route('layanan-publik.store') }}" method="POST">
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
                                </div>

                                <div class="row mt-3">
                                    <h6 class="mb-3 text-secondary">Jumlah Layanan Publik</h6>
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="penyidikan_penyelidikan"
                                                    class="form-control-label">Penyidikan & Penyelidikan</label>
                                                <input type="number" class="form-control" id="penyidikan_penyelidikan"
                                                    name="penyidikan_penyelidikan" min="0" value="0"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="patroli_kapal" class="form-control-label">Patroli
                                                    Kapal</label>
                                                <input type="number" class="form-control" id="patroli_kapal"
                                                    name="patroli_kapal" min="0" value="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="sar" class="form-control-label">SAR</label>
                                                <input type="number" class="form-control" id="sar" name="sar"
                                                    min="0" value="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="snbp" class="form-control-label">SNBP</label>
                                                <input type="number" class="form-control" id="snbp" name="snbp"
                                                    min="0" value="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="pengawasan_salvage" class="form-control-label">Pengawasan
                                                    Salvage</label>
                                                <input type="number" class="form-control" id="pengawasan_salvage"
                                                    name="pengawasan_salvage" min="0" value="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="marpol" class="form-control-label">MARPOL</label>
                                                <input type="number" class="form-control" id="marpol" name="marpol"
                                                    min="0" value="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label for="tamu_kantor" class="form-control-label">Tamu Kantor</label>
                                                <input type="number" class="form-control" id="tamu_kantor"
                                                    name="tamu_kantor" min="0" value="0" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-primary"
                                            id="submitButton">Simpan Data</button>
                                        <button type="button" class="btn bg-gradient-secondary" id="cancelButton"
                                            style="display: none;" onclick="resetForm()">Batal Edit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Data Layanan Publik</h6>
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
                                                Tanggal</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Penyidikan & Penyelidikan</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Patroli Kapal</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                SAR</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                SNBP</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Pengawasan Salvage</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                MARPOL</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Tamu Kantor</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Total</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">
                                        @forelse($allData as $item)
                                            @php
                                                $total =
                                                    $item->penyidikan_penyelidikan +
                                                    $item->patroli_kapal +
                                                    $item->sar +
                                                    $item->snbp +
                                                    $item->pengawasan_salvage +
                                                    $item->marpol +
                                                    $item->tamu_kantor;
                                            @endphp
                                            <tr id="row-{{ $item->id }}">
                                                <td class="ps-4 py-3">
                                                    <h6 class="mb-0 text-sm">
                                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                                    </h6>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span
                                                        class="badge bg-gradient-info px-3 py-2">{{ number_format($item->penyidikan_penyelidikan, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span
                                                        class="badge bg-gradient-primary px-3 py-2">{{ number_format($item->patroli_kapal, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span
                                                        class="badge bg-gradient-success px-3 py-2">{{ number_format($item->sar, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span
                                                        class="badge bg-gradient-warning px-3 py-2">{{ number_format($item->snbp, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span
                                                        class="badge bg-gradient-danger px-3 py-2">{{ number_format($item->pengawasan_salvage, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span
                                                        class="badge bg-gradient-dark px-3 py-2">{{ number_format($item->marpol, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span
                                                        class="badge bg-gradient-secondary px-3 py-2">{{ number_format($item->tamu_kantor, 0, ',', '.') }}</span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span
                                                        class="badge bg-gradient-primary px-3 py-2 font-weight-bolder">
                                                        {{ number_format($total, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <button type="button" class="btn btn-sm btn-info edit-btn me-1"
                                                        data-id="{{ $item->id }}"
                                                        data-tanggal="{{ $item->tanggal }}"
                                                        data-penyidikan="{{ $item->penyidikan_penyelidikan }}"
                                                        data-patroli="{{ $item->patroli_kapal }}"
                                                        data-sar="{{ $item->sar }}"
                                                        data-snbp="{{ $item->snbp }}"
                                                        data-salvage="{{ $item->pengawasan_salvage }}"
                                                        data-marpol="{{ $item->marpol }}"
                                                        data-tamu="{{ $item->tamu_kantor }}">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('layanan-publik.destroy', $item->id) }}"
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
                                                <td colspan="10" class="text-center py-4">
                                                    <p class="text-sm text-secondary mb-0">Belum ada data layanan
                                                        publik</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    @if ($allData->count() > 0)
                                        <tfoot class="bg-gray-100">
                                            <tr>
                                                <td class="text-end font-weight-bolder pe-4">Total:</td>
                                                <td class="text-center font-weight-bolder text-info">
                                                    {{ number_format($allData->sum('penyidikan_penyelidikan'), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder text-primary">
                                                    {{ number_format($allData->sum('patroli_kapal'), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder text-success">
                                                    {{ number_format($allData->sum('sar'), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder text-warning">
                                                    {{ number_format($allData->sum('snbp'), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder text-danger">
                                                    {{ number_format($allData->sum('pengawasan_salvage'), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder text-dark">
                                                    {{ number_format($allData->sum('marpol'), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder text-secondary">
                                                    {{ number_format($allData->sum('tamu_kantor'), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder text-primary">
                                                    {{ number_format($allData->sum('penyidikan_penyelidikan') + $allData->sum('patroli_kapal') + $allData->sum('sar') + $allData->sum('snbp') + $allData->sum('pengawasan_salvage') + $allData->sum('marpol') + $allData->sum('tamu_kantor'), 0, ',', '.') }}
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    @endif
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

        tfoot td {
            font-size: 1rem;
        }
    </style>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), {
                damping: '0.5'
            });
        }

        function editData(id, tanggal, penyidikan, patroli, sar, snbp, salvage, marpol, tamu) {
            document.getElementById('formTitle').textContent = 'Edit Data Layanan Publik';
            document.getElementById('dataId').value = id;
            document.getElementById('tanggal').value = tanggal;
            document.getElementById('penyidikan_penyelidikan').value = penyidikan;
            document.getElementById('patroli_kapal').value = patroli;
            document.getElementById('sar').value = sar;
            document.getElementById('snbp').value = snbp;
            document.getElementById('pengawasan_salvage').value = salvage;
            document.getElementById('marpol').value = marpol;
            document.getElementById('tamu_kantor').value = tamu;

            const form = document.getElementById('layananForm');
            form.action = `/layanan-publik/${id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';

            document.getElementById('cancelButton').style.display = 'inline-block';
            form.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function resetForm() {
            document.getElementById('formTitle').textContent = 'Tambah Data Layanan Publik';
            document.getElementById('dataId').value = '';

            const form = document.getElementById('layananForm');
            form.action = "{{ route('layanan-publik.store') }}";
            form.querySelector('input[name="_method"]').value = 'POST';

            form.reset();
            document.getElementById('cancelButton').style.display = 'none';

            document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
            document.querySelectorAll('input[type=number]').forEach(input => input.value = 0);
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const data = this.dataset;
                    editData(
                        data.id, data.tanggal, data.penyidikan, data.patroli,
                        data.sar, data.snbp, data.salvage, data.marpol, data.tamu
                    );
                });
            });

            // Validasi tanggal
            document.getElementById('layananForm').addEventListener('submit', function(e) {
                if (!document.getElementById('tanggal').value) {
                    e.preventDefault();
                    alert('Tanggal harus diisi!');
                }
            });
        });
    </script>

    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
