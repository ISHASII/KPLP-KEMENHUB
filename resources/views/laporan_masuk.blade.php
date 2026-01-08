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
                    @if(auth()->check() && auth()->user()->isAdmin())
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6 id="formTitle">Tambah Data Pengelolaan Laporan Masuk</h6>
                                    </div>
                                    <div class="card-body">
                                        <form id="masukForm" method="POST" action="{{ route('laporan_masuk.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="formMethod" name="_method" value="POST">
                                            <input type="hidden" id="dataId" name="id">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="tanggal" class="form-control-label">Tanggal</label>
                                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                                            value="{{ date('Y-m-d') }}">
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
                                                            name="terdisposisi_belum_tindak_lanjut" min="0" value="0" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="terdisposisi_sedang_proses"
                                                            class="form-control-label">Terdisposisi (Proses)</label>
                                                        <input type="number" class="form-control" id="terdisposisi_sedang_proses"
                                                            name="terdisposisi_sedang_proses" min="0" value="0" required>
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
                                                    <button type="button" class="btn btn-sm btn-primary view-btn me-1"
                                                        data-id="{{ $item->id }}" data-tanggal="{{ $item->tanggal }}"
                                                        data-belum="{{ $item->belum_terverifikasi }}"
                                                        data-blumtl="{{ $item->terdisposisi_belum_tindak_lanjut }}"
                                                        data-proses="{{ $item->terdisposisi_sedang_proses }}"
                                                        data-selesai="{{ $item->terdisposisi_selesai }}"
                                                        data-tunda="{{ $item->tertunda }}"
                                                        data-gambar-url="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                                        data-dokumen-url="{{ $item->dokumen ? asset('storage/' . $item->dokumen) : '' }}">
                                                        Lihat
                                                    </button>

                                                    @if(auth()->check() && auth()->user()->isAdmin())
                                                        <button type="button" class="btn btn-sm bg-gradient-info edit-btn me-1"
                                                            data-id="{{ $item->id }}" data-tanggal="{{ $item->tanggal }}"
                                                            data-belum="{{ $item->belum_terverifikasi }}"
                                                            data-blumtl="{{ $item->terdisposisi_belum_tindak_lanjut }}"
                                                            data-proses="{{ $item->terdisposisi_sedang_proses }}"
                                                            data-selesai="{{ $item->terdisposisi_selesai }}"
                                                            data-tunda="{{ $item->tertunda }}"
                                                            data-gambar-url="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                                            data-dokumen-url="{{ $item->dokumen ? asset('storage/' . $item->dokumen) : '' }}">
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
                                                    @endif
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

    <!-- Modal: View Pengelolaan Laporan Masuk -->
    <div class="modal fade" id="viewMasukModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pengelolaan Laporan Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p><strong>Tanggal:</strong> <span id="masukViewTanggal"></span></p>
                            <p><strong>Belum Terverifikasi:</strong> <span id="masukViewBelum"></span></p>
                            <p><strong>Belum TL:</strong> <span id="masukViewBelumTL"></span></p>
                            <p><strong>Proses:</strong> <span id="masukViewProses"></span></p>
                            <p><strong>Selesai:</strong> <span id="masukViewSelesai"></span></p>
                            <p><strong>Tertunda:</strong> <span id="masukViewTunda"></span></p>
                        </div>
                        <div class="col-md-6">
                            <div id="masukViewGambarContainer" style="margin-bottom:10px; display:none;">
                                <strong>Gambar:</strong>
                                <div><img id="masukViewGambar" class="clickable-preview" src="" alt="Gambar"
                                        style="max-width:100%; max-height:300px; border-radius:4px; cursor:pointer;">
                                </div>
                                <div><a id="masukViewGambarDownload" href="#" download
                                        class="btn btn-sm btn-primary mt-2" style="display:none;">Download Gambar</a>
                                </div>
                            </div>
                            <div id="masukViewDokumenContainer" style="display:none;">
                                <strong>Dokumen:</strong>
                                <div><a id="masukViewDokumenLink" href="#" target="_blank">Buka dokumen</a></div>
                                <div id="masukViewDokumenFrameContainer" style="margin-top:10px; display:none;">
                                    <iframe id="masukViewDokumenIframe" src="" style="width:100%; height:400px;"
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

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    editData(
                        this.dataset.id,
                        this.dataset.tanggal,
                        this.dataset.belum,
                        this.dataset.blumtl,
                        this.dataset.proses,
                        this.dataset.selesai,
                        this.dataset.tunda,
                        this.dataset.gambarUrl || '',
                        this.dataset.dokumenUrl || ''
                    );
                });
            });

            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const d = this.dataset;
                    document.getElementById('masukViewTanggal').textContent = d.tanggal || '-';
                    document.getElementById('masukViewBelum').textContent = d.belum || '0';
                    document.getElementById('masukViewBelumTL').textContent = d.blumtl || '0';
                    document.getElementById('masukViewProses').textContent = d.proses || '0';
                    document.getElementById('masukViewSelesai').textContent = d.selesai || '0';
                    document.getElementById('masukViewTunda').textContent = d.tunda || '0';

                    const imgContainer = document.getElementById('masukViewGambarContainer');
                    const imgEl = document.getElementById('masukViewGambar');
                    const imgDownload = document.getElementById('masukViewGambarDownload');
                    if (d.gambarUrl) {
                        imgEl.src = d.gambarUrl;
                        imgContainer.style.display = 'block';
                        if (imgDownload) { imgDownload.href = d.gambarUrl; imgDownload.style.display = 'inline-block'; }
                    } else {
                        imgEl.src = '';
                        imgContainer.style.display = 'none';
                        if (imgDownload) { imgDownload.href = '#'; imgDownload.style.display = 'none'; }
                    }

                    const docContainer = document.getElementById('masukViewDokumenContainer');
                    const docLink = document.getElementById('masukViewDokumenLink');
                    const iframeContainer = document.getElementById('masukViewDokumenFrameContainer');
                    const iframe = document.getElementById('masukViewDokumenIframe');
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

                    const bsModal = new bootstrap.Modal(document.getElementById('viewMasukModal'));
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
        });
    </script>
    @include('components.image-preview-modal')

    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
