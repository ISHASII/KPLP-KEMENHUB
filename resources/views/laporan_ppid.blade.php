<!DOCTYPE html>
<html lang="en">

<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>Laporan PPID</x-navbar>
        <div class="container-fluid py-4">
            <!-- Form Input Data -->
            <div class="row">
                <div class="col-12">
                    @if(auth()->check() && auth()->user()->isAdmin())
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6 id="formTitle">Tambah Data Laporan PPID</h6>
                                    </div>
                                    <div class="card-body">
                                        <form id="ppidForm" action="{{ route('ppid.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="formMethod" name="_method" value="POST">
                                            <input type="hidden" id="dataId" name="id">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="tanggal" class="form-control-label">Tanggal</label>
                                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                                            value="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="jumlah_pemohon" class="form-control-label">Jumlah
                                                            Pemohon</label>
                                                        <input type="number" class="form-control" id="jumlah_pemohon"
                                                            name="jumlah_pemohon" min="0" value="0" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gambar" class="form-control-label">Gambar (opsional)</label>
                                                        <input type="file" class="form-control" id="gambar" name="gambar"
                                                            accept="image/*">
                                                        <img id="gambarPreview" src=""
                                                            style="max-height:100px; display:none; margin-top:10px;">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="dokumen" class="form-control-label">Dokumen (opsional)</label>
                                                        <input type="file" class="form-control" id="dokumen" name="dokumen"
                                                            accept=".pdf,.doc,.docx">
                                                        <div id="dokumenPreview" style="margin-top:10px; display:none;">
                                                            <a href="#" target="_blank" id="dokumenLink">Lihat dokumen</a>
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
                    @endif

            <!-- Tabel Data (sudah rapi & seimbang) -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Data Laporan PPID</h6>
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
                                                Jumlah Pemohon</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Status</th>
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
                                                    <span class="badge bg-gradient-primary px-3 py-2">
                                                        {{ number_format($item->jumlah_pemohon, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    @if ($item->jumlah_pemohon == 0)
                                                        <span class="badge badge-lg bg-gradient-secondary">Tidak
                                                            Ada</span>
                                                    @elseif($item->jumlah_pemohon <= 5)
                                                        <span class="badge badge-lg bg-gradient-info">Rendah</span>
                                                    @elseif($item->jumlah_pemohon <= 15)
                                                        <span class="badge badge-lg bg-gradient-success">Sedang</span>
                                                    @else
                                                        <span class="badge badge-lg bg-gradient-danger">Tinggi</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <button type="button" class="btn btn-sm btn-primary view-btn me-1"
                                                        data-id="{{ $item->id }}" data-tanggal="{{ $item->tanggal }}"
                                                        data-jumlah="{{ $item->jumlah_pemohon }}"
                                                        data-gambar-url="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                                        data-dokumen-url="{{ $item->dokumen ? asset('storage/' . $item->dokumen) : '' }}">
                                                        Lihat
                                                    </button>

                                                    @if(auth()->check() && auth()->user()->isAdmin())
                                                        <button type="button" class="btn btn-sm btn-info edit-btn me-1"
                                                            data-id="{{ $item->id }}" data-tanggal="{{ $item->tanggal }}"
                                                            data-jumlah="{{ $item->jumlah_pemohon }}"
                                                            data-gambar-url="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                                            data-dokumen-url="{{ $item->dokumen ? asset('storage/' . $item->dokumen) : '' }}">
                                                            Edit
                                                        </button>
                                                        <form action="{{ route('ppid.destroy', $item->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-4">
                                                    <p class="text-sm text-secondary mb-0">Belum ada data laporan PPID
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    @if ($data->count() > 0)
                                        <tfoot class="bg-gray-100">
                                            <tr>
                                                <td colspan="2" class="text-end font-weight-bolder pe-4">Total
                                                    Pemohon:</td>
                                                <td class="text-center font-weight-bolder text-primary">
                                                    {{ number_format($data->sum('jumlah_pemohon'), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder">
                                                    @php
                                                        $totalAll = $data->sum('jumlah_pemohon');
                                                    @endphp
                                                    @if ($totalAll == 0)
                                                        <span class="badge bg-gradient-secondary">Tidak Ada</span>
                                                    @elseif($totalAll <= 50)
                                                        <span class="badge bg-gradient-info">Rendah</span>
                                                    @elseif($totalAll <= 150)
                                                        <span class="badge bg-gradient-success">Sedang</span>
                                                    @else
                                                        <span class="badge bg-gradient-danger">Tinggi</span>
                                                    @endif
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-end font-weight-bolder pe-4">Rata-rata
                                                    per Hari:</td>
                                                <td class="text-center font-weight-bolder text-success">
                                                    {{ number_format($data->avg('jumlah_pemohon'), 2, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder text-info" colspan="2">
                                                    Total Data: {{ $data->count() }}
                                                </td>
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

    <!-- Modal: View Laporan PPID -->
    <div class="modal fade" id="viewPpidModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Laporan PPID</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p><strong>Tanggal:</strong> <span id="ppidViewTanggal"></span></p>
                            <p><strong>Jumlah Pemohon:</strong> <span id="ppidViewJumlah"></span></p>
                        </div>
                        <div class="col-md-6">
                            <div id="ppidViewGambarContainer" style="margin-bottom:10px; display:none;">
                                <strong>Gambar:</strong>
                                <div><img id="ppidViewGambar" class="clickable-preview" src="" alt="Gambar"
                                        style="max-width:100%; max-height:300px; border-radius:4px; cursor:pointer;">
                                </div>
                                <div><a id="ppidViewGambarDownload" href="#" download
                                        class="btn btn-sm btn-primary mt-2" style="display:none;">Download Gambar</a>
                                </div>
                            </div>
                            <div id="ppidViewDokumenContainer" style="display:none;">
                                <strong>Dokumen:</strong>
                                <div><a id="ppidViewDokumenLink" href="#" target="_blank">Buka dokumen</a></div>
                                <div id="ppidViewDokumenFrameContainer" style="margin-top:10px; display:none;">
                                    <iframe id="ppidViewDokumenIframe" src="" style="width:100%; height:400px;"
                                        frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    @include('components.image-preview-modal')

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

        .badge-lg {
            font-size: 1rem !important;
            padding: 0.5rem 1rem !important;
        }
    </style>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), {
                damping: '0.5'
            });
        }

        function editData(id, tanggal, jumlah, gambarUrl = '', dokumenUrl = '') {
            document.getElementById('formTitle').textContent = 'Edit Data Laporan PPID';
            document.getElementById('dataId').value = id;
            document.getElementById('tanggal').value = tanggal;
            document.getElementById('jumlah_pemohon').value = jumlah;

            // previews
            const imgEl = document.getElementById('gambarPreview');
            const docPreview = document.getElementById('dokumenPreview');
            const docLink = document.getElementById('dokumenLink');

            if (gambarUrl) {
                imgEl.src = gambarUrl;
                imgEl.style.display = 'block';
            } else {
                imgEl.src = '';
                imgEl.style.display = 'none';
            }

            if (dokumenUrl) {
                docLink.href = dokumenUrl;
                docLink.textContent = dokumenUrl.split('/').pop();
                docPreview.style.display = 'block';
            } else {
                docLink.href = '#';
                docLink.textContent = 'Lihat dokumen';
                docPreview.style.display = 'none';
            }

            const form = document.getElementById('ppidForm');
            form.action = `/laporan-ppid/${id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';

            document.getElementById('cancelButton').style.display = 'inline-block';
            form.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function resetForm() {
            document.getElementById('formTitle').textContent = 'Tambah Data Laporan PPID';
            document.getElementById('dataId').value = '';

            const form = document.getElementById('ppidForm');
            form.action = "{{ route('ppid.store') }}";
            form.querySelector('input[name="_method"]').value = 'POST';

            form.reset();
            document.getElementById('cancelButton').style.display = 'none';

            document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
            document.getElementById('jumlah_pemohon').value = 0;

            // hide previews
            const imgPreview = document.getElementById('gambarPreview');
            if (imgPreview) { imgPreview.style.display = 'none'; imgPreview.src = ''; }
            const dokPreview = document.getElementById('dokumenPreview');
            if (dokPreview) { dokPreview.style.display = 'none'; }
            const dokLink = document.getElementById('dokumenLink');
            if (dokLink) { dokLink.href = '#'; dokLink.textContent = 'Lihat dokumen'; }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Edit button: also pass file urls
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const tanggal = this.dataset.tanggal;
                    const jumlah = this.dataset.jumlah;
                    const gambarUrl = this.dataset.gambarUrl || '';
                    const dokumenUrl = this.dataset.dokumenUrl || '';
                    editData(id, tanggal, jumlah, gambarUrl, dokumenUrl);
                });
            });

            // View button: open modal with details
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const d = this.dataset;
                    document.getElementById('ppidViewTanggal').textContent = d.tanggal || '-';
                    document.getElementById('ppidViewJumlah').textContent = d.jumlah || '0';

                    const imgContainer = document.getElementById('ppidViewGambarContainer');
                    const imgEl = document.getElementById('ppidViewGambar');
                    const imgDownload = document.getElementById('ppidViewGambarDownload');
                    if (d.gambarUrl) {
                        imgEl.src = d.gambarUrl;
                        imgContainer.style.display = 'block';
                        if (imgDownload) { imgDownload.href = d.gambarUrl; imgDownload.style.display = 'inline-block'; }
                    } else {
                        imgEl.src = '';
                        imgContainer.style.display = 'none';
                        if (imgDownload) { imgDownload.href = '#'; imgDownload.style.display = 'none'; }
                    }

                    const docContainer = document.getElementById('ppidViewDokumenContainer');
                    const docLink = document.getElementById('ppidViewDokumenLink');
                    const iframeContainer = document.getElementById('ppidViewDokumenFrameContainer');
                    const iframe = document.getElementById('ppidViewDokumenIframe');
                    if (d.dokumenUrl) {
                        docLink.href = d.dokumenUrl;
                        docLink.textContent = d.dokumenUrl.split('/').pop();
                        docContainer.style.display = 'block';
                        if (d.dokumenUrl.toLowerCase().endsWith('.pdf')) {
                            iframe.src = d.dokumenUrl;
                            iframeContainer.style.display = 'block';
                        } else {
                            iframe.src = '';
                            iframeContainer.style.display = 'none';
                        }
                    } else {
                        docLink.href = '#';
                        docLink.textContent = 'Buka dokumen';
                        docContainer.style.display = 'none';
                        iframe.src = '';
                        iframeContainer.style.display = 'none';
                    }

                    const bsModal = new bootstrap.Modal(document.getElementById('viewPpidModal'));
                    bsModal.show();
                });
            });

            // Preview handlers for file inputs
            const gambarInput = document.getElementById('gambar');
            const dokumenInput = document.getElementById('dokumen');

            if (gambarInput) {
                gambarInput.addEventListener('change', function () {
                    const file = this.files[0];
                    const imgEl = document.getElementById('gambarPreview');
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            imgEl.src = e.target.result;
                            imgEl.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        imgEl.src = '';
                        imgEl.style.display = 'none';
                    }
                });
            }

            if (dokumenInput) {
                dokumenInput.addEventListener('change', function () {
                    const file = this.files[0];
                    const docPreview = document.getElementById('dokumenPreview');
                    const docLink = document.getElementById('dokumenLink');
                    if (file) {
                        docLink.href = URL.createObjectURL(file);
                        docLink.textContent = file.name;
                        docPreview.style.display = 'block';
                    } else {
                        docLink.href = '#';
                        docLink.textContent = 'Lihat dokumen';
                        docPreview.style.display = 'none';
                    }
                });
            }

            document.getElementById('jumlah_pemohon').addEventListener('blur', function () {
                let val = parseInt(this.value);
                this.value = (isNaN(val) || val < 0) ? 0 : val;
            });

            document.getElementById('ppidForm').addEventListener('submit', function (e) {
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
