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
                    @if(auth()->check() && auth()->user()->isAdmin())
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6 id="formTitle">Tambah Data Berita KPLP</h6>
                                    </div>
                                    <div class="card-body">
                                        <form id="kplpForm" method="POST" action="{{ route('berita_kplp.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="formMethod" name="_method" value="POST">
                                            <input type="hidden" id="dataId" name="id">

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="tanggal" class="form-control-label">Tanggal</label>
                                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                                            value="{{ date('Y-m-d') }}">
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
                                                    <button type="button" class="btn btn-sm btn-primary view-btn me-1"
                                                        data-id="{{ $item->id }}" data-tanggal="{{ $item->tanggal }}"
                                                        data-positif="{{ $item->jumlah_berita_positif }}"
                                                        data-negatif="{{ $item->jumlah_berita_negatif }}"
                                                        data-gambar-url="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                                        data-dokumen-url="{{ $item->dokumen ? asset('storage/' . $item->dokumen) : '' }}">
                                                        Lihat
                                                    </button>
                                                    @if(auth()->check() && auth()->user()->isAdmin())
                                                        <button type="button" class="btn btn-sm btn-info edit-btn me-1"
                                                            data-id="{{ $item->id }}" data-tanggal="{{ $item->tanggal }}"
                                                            data-positif="{{ $item->jumlah_berita_positif }}"
                                                            data-negatif="{{ $item->jumlah_berita_negatif }}"
                                                            data-gambar-url="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                                            data-dokumen-url="{{ $item->dokumen ? asset('storage/' . $item->dokumen) : '' }}">
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
                                                    @endif
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

    <!-- Modal: View Berita KPLP -->
    <div class="modal fade" id="viewBeritaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Berita KPLP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p><strong>Tanggal:</strong> <span id="beritaViewTanggal"></span></p>
                            <p><strong>Berita Positif:</strong> <span id="beritaViewPositif"></span></p>
                            <p><strong>Berita Negatif:</strong> <span id="beritaViewNegatif"></span></p>
                            <p><strong>Total:</strong> <span id="beritaViewTotal"></span></p>
                        </div>
                        <div class="col-md-6">
                            <div id="beritaViewGambarContainer" style="margin-bottom:10px; display:none;">
                                <strong>Gambar:</strong>
                                <div><img id="beritaViewGambar" class="clickable-preview" src="" alt="Gambar"
                                        style="max-width:100%; max-height:300px; border-radius:4px; cursor:pointer;">
                                </div>
                                <div><a id="beritaViewGambarDownload" href="#" download
                                        class="btn btn-sm btn-primary mt-2" style="display:none;">Download Gambar</a>
                                </div>
                            </div>
                            <div id="beritaViewDokumenContainer" style="display:none;">
                                <strong>Dokumen:</strong>
                                <div><a id="beritaViewDokumenLink" href="#" target="_blank">Buka dokumen</a></div>
                                <div id="beritaViewDokumenFrameContainer" style="margin-top:10px; display:none;">
                                    <iframe id="beritaViewDokumenIframe" src="" style="width:100%; height:400px;"
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

        // Hitung total berita secara real-time (tahan error jika form tidak ada untuk user non-admin)
        function calculateTotal() {
            const posEl = document.getElementById('jumlah_berita_positif');
            const negEl = document.getElementById('jumlah_berita_negatif');
            const totalEl = document.getElementById('totalBerita');
            if (!totalEl) return;
            if (!posEl || !negEl) {
                totalEl.textContent = '0';
                return;
            }
            const positif = parseInt(posEl.value) || 0;
            const negatif = parseInt(negEl.value) || 0;
            const total = positif + negatif;
            totalEl.textContent = total.toLocaleString('id-ID');
        }

        function editData(id, tanggal, positif, negatif, gambarUrl = '', dokumenUrl = '') {
            document.getElementById('formTitle').textContent = 'Edit Data Berita KPLP';
            document.getElementById('dataId').value = id;
            document.getElementById('tanggal').value = tanggal;
            const positifEl = document.getElementById('jumlah_berita_positif');
            const negatifEl = document.getElementById('jumlah_berita_negatif');
            if (positifEl) positifEl.value = positif;
            if (negatifEl) negatifEl.value = negatif;

            // previews
            const imgEl = document.getElementById('gambarPreview');
            const docPreview = document.getElementById('dokumenPreview');
            const docLink = document.getElementById('dokumenLink');

            if (imgEl) {
                if (gambarUrl) {
                    imgEl.src = gambarUrl;
                    imgEl.style.display = 'block';
                } else {
                    imgEl.src = '';
                    imgEl.style.display = 'none';
                }
            }

            if (docLink && docPreview) {
                if (dokumenUrl) {
                    docLink.href = dokumenUrl;
                    docLink.textContent = dokumenUrl.split('/').pop();
                    docPreview.style.display = 'block';
                } else {
                    docLink.href = '#';
                    docLink.textContent = 'Lihat dokumen';
                    docPreview.style.display = 'none';
                }
            }

            calculateTotal();

            const form = document.getElementById('kplpForm');
            if (form) {
                form.action = `/laporan-berita-kplp/${id}`;
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput) methodInput.value = 'PUT';

                document.getElementById('cancelButton').style.display = 'inline-block';
                form.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        function resetForm() {
            document.getElementById('formTitle').textContent = 'Tambah Data Berita KPLP';
            document.getElementById('dataId').value = '';

            const form = document.getElementById('kplpForm');
            if (form) {
                form.action = "{{ route('berita_kplp.store') }}";
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput) methodInput.value = 'POST';

                form.reset();
                document.getElementById('cancelButton').style.display = 'none';

                const tanggalEl = document.getElementById('tanggal');
                if (tanggalEl) tanggalEl.value = '{{ date('Y-m-d') }}';
                const positifEl = document.getElementById('jumlah_berita_positif');
                const negatifEl = document.getElementById('jumlah_berita_negatif');
                if (positifEl) positifEl.value = 0;
                if (negatifEl) negatifEl.value = 0;
            }

            calculateTotal();
        }

        document.addEventListener('DOMContentLoaded', function () {
            calculateTotal();

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const tanggal = this.dataset.tanggal;
                    const positif = this.dataset.positif;
                    const negatif = this.dataset.negatif;
                    const gambarUrl = this.dataset.gambarUrl || '';
                    const dokumenUrl = this.dataset.dokumenUrl || '';
                    editData(id, tanggal, positif, negatif, gambarUrl, dokumenUrl);
                });
            });

            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const d = this.dataset;
                    document.getElementById('beritaViewTanggal').textContent = d.tanggal || '-';
                    document.getElementById('beritaViewPositif').textContent = d.positif || '0';
                    document.getElementById('beritaViewNegatif').textContent = d.negatif || '0';
                    const total = (parseInt(d.positif) || 0) + (parseInt(d.negatif) || 0);
                    document.getElementById('beritaViewTotal').textContent = total.toLocaleString('id-ID');

                    const imgContainer = document.getElementById('beritaViewGambarContainer');
                    const imgEl = document.getElementById('beritaViewGambar');
                    const imgDownload = document.getElementById('beritaViewGambarDownload');
                    if (d.gambarUrl) {
                        if (imgEl) {
                            imgEl.src = d.gambarUrl;
                        }
                        if (imgContainer) imgContainer.style.display = 'block';
                        if (imgDownload) { imgDownload.href = d.gambarUrl; imgDownload.style.display = 'inline-block'; }
                    } else {
                        if (imgEl) imgEl.src = '';
                        if (imgContainer) imgContainer.style.display = 'none';
                        if (imgDownload) { imgDownload.href = '#'; imgDownload.style.display = 'none'; }
                    }

                    const docContainer = document.getElementById('beritaViewDokumenContainer');
                    const docLink = document.getElementById('beritaViewDokumenLink');
                    const iframeContainer = document.getElementById('beritaViewDokumenFrameContainer');
                    const iframe = document.getElementById('beritaViewDokumenIframe');
                    if (d.dokumenUrl) {
                        if (docLink) {
                            docLink.href = d.dokumenUrl;
                            docLink.textContent = d.dokumenUrl.split('/').pop();
                        }
                        if (docContainer) docContainer.style.display = 'block';
                        if (d.dokumenUrl.toLowerCase().endsWith('.pdf')) {
                            if (iframe) iframe.src = d.dokumenUrl;
                            if (iframeContainer) iframeContainer.style.display = 'block';
                        } else {
                            if (iframe) iframe.src = '';
                            if (iframeContainer) iframeContainer.style.display = 'none';
                        }
                    } else {
                        if (docLink) {
                            docLink.href = '#';
                            docLink.textContent = 'Buka dokumen';
                        }
                        if (docContainer) docContainer.style.display = 'none';
                        if (iframe) iframe.src = '';
                        if (iframeContainer) iframeContainer.style.display = 'none';
                    }

                    const bsModal = new bootstrap.Modal(document.getElementById('viewBeritaModal'));
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

            const positifEl = document.getElementById('jumlah_berita_positif');
            const negatifEl = document.getElementById('jumlah_berita_negatif');
            if (positifEl) positifEl.addEventListener('input', calculateTotal);
            if (negatifEl) negatifEl.addEventListener('input', calculateTotal);

            ['jumlah_berita_positif', 'jumlah_berita_negatif'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('blur', function () {
                        let val = parseInt(this.value);
                        this.value = (isNaN(val) || val < 0) ? 0 : val;
                        calculateTotal();
                    });
                }
            });

            const kplpForm = document.getElementById('kplpForm');
            if (kplpForm) {
                kplpForm.addEventListener('submit', function (e) {
                    const tanggalEl = document.getElementById('tanggal');
                    const tanggal = tanggalEl ? tanggalEl.value : null;
                    if (!tanggal) {
                        e.preventDefault();
                        alert('Tanggal harus diisi!');
                    }
                });
            }
        });
    </script>

    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
