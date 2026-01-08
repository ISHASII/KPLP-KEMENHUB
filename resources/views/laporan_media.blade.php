<!DOCTYPE html>
<html lang="en">
<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>Laporan Media Visual</x-navbar>
        <div class="container-fluid py-4">
            <!-- Form Input Data -->
            <div class="row">
                <div class="col-12">
                    @if(auth()->check() && auth()->user()->isAdmin())
                                <div class="card mb-4">
                                    <div class="card-header pb-0">
                                        <h6 id="formTitle">Tambah Data Media Visual</h6>
                                    </div>
                                    <div class="card-body">
                                        <form id="mediaForm" action="{{ route('media_visual.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" id="formMethod" name="_method" value="POST">
                                            <input type="hidden" id="dataId" name="id">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="tanggal" class="form-control-label">Tanggal</label>
                                                        <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                                            value="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="tayangan_postingan" class="form-control-label">Tayangan
                                                            Postingan</label>
                                                        <input type="number" class="form-control" id="tayangan_postingan"
                                                            name="tayangan_postingan" min="0" value="0" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="pengikut" class="form-control-label">Jumlah Pengikut</label>
                                                        <input type="number" class="form-control" id="pengikut" name="pengikut"
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

            <!-- Tabel Data (sudah rapi & seimbang) -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Data Media Visual</h6>
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
                                                Tayangan Postingan</th>
                                            <th
                                                class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                Jumlah Pengikut</th>
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
                                                        {{ number_format($item->tayangan_postingan, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <span class="badge bg-gradient-success px-3 py-2">
                                                        {{ number_format($item->pengikut, 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <button type="button" class="btn btn-sm btn-primary view-btn me-1"
                                                        data-id="{{ $item->id }}" data-tanggal="{{ $item->tanggal }}"
                                                        data-tayangan="{{ $item->tayangan_postingan }}"
                                                        data-pengikut="{{ $item->pengikut }}"
                                                        data-gambar-url="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                                        data-dokumen-url="{{ $item->dokumen ? asset('storage/' . $item->dokumen) : '' }}">
                                                        Lihat
                                                    </button>

                                                    @if(auth()->check() && auth()->user()->isAdmin())
                                                        <button type="button" class="btn btn-sm btn-info edit-btn me-1"
                                                            data-id="{{ $item->id }}" data-tanggal="{{ $item->tanggal }}"
                                                            data-tayangan="{{ $item->tayangan_postingan }}"
                                                            data-pengikut="{{ $item->pengikut }}"
                                                            data-gambar-url="{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}"
                                                            data-dokumen-url="{{ $item->dokumen ? asset('storage/' . $item->dokumen) : '' }}">
                                                            Edit
                                                        </button>
                                                        <form action="{{ route('media_visual.destroy', $item->id) }}"
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
                                                <td colspan="5" class="text-center py-4">
                                                    <p class="text-sm text-secondary mb-0">Belum ada data media visual
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    @if ($data->count() > 0)
                                        <tfoot class="bg-gray-100">
                                            <tr>
                                                <td colspan="2" class="text-end font-weight-bolder pe-4">Total:
                                                </td>
                                                <td class="text-center font-weight-bolder text-primary">
                                                    {{ number_format($data->sum('tayangan_postingan'), 0, ',', '.') }}
                                                </td>
                                                <td class="text-center font-weight-bolder text-success">
                                                    {{ number_format($data->sum('pengikut'), 0, ',', '.') }}
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

    <!-- Modal: View Media Visual -->
    <div class="modal fade" id="viewMediaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Media Visual</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p><strong>Tanggal:</strong> <span id="mediaViewTanggal"></span></p>
                            <p><strong>Tayangan Postingan:</strong> <span id="mediaViewTayangan"></span></p>
                            <p><strong>Jumlah Pengikut:</strong> <span id="mediaViewPengikut"></span></p>
                        </div>
                        <div class="col-md-6">
                            <div id="mediaViewGambarContainer" style="margin-bottom:10px; display:none;">
                                <strong>Gambar:</strong>
                                <div><img id="mediaViewGambar" class="clickable-preview" src="" alt="Gambar"
                                        style="max-width:100%; max-height:300px; border-radius:4px; cursor:pointer;">
                                </div>
                                <div><a id="mediaViewGambarDownload" href="#" download
                                        class="btn btn-sm btn-primary mt-2" style="display:none;">Download Gambar</a>
                                </div>
                            </div>
                            <div id="mediaViewDokumenContainer" style="display:none;">
                                <strong>Dokumen:</strong>
                                <div><a id="mediaViewDokumenLink" href="#" target="_blank">Buka dokumen</a></div>
                                <div id="mediaViewDokumenFrameContainer" style="margin-top:10px; display:none;">
                                    <iframe id="mediaViewDokumenIframe" src="" style="width:100%; height:400px;"
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

    <!-- CSS tambahan untuk tabel rapi (sama seperti halaman sebelumnya) -->
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

        function editData(id, tanggal, tayangan, pengikut, gambarUrl = '', dokumenUrl = '') {
            document.getElementById('formTitle').textContent = 'Edit Data Media Visual';
            document.getElementById('dataId').value = id;
            document.getElementById('tanggal').value = tanggal;
            document.getElementById('tayangan_postingan').value = tayangan;
            document.getElementById('pengikut').value = pengikut;

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

            const form = document.getElementById('mediaForm');
            form.action = `/laporan-media-visual/${id}`;
            form.querySelector('input[name="_method"]').value = 'PUT';

            document.getElementById('cancelButton').style.display = 'inline-block';
            form.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function resetForm() {
            document.getElementById('formTitle').textContent = 'Tambah Data Media Visual';
            document.getElementById('dataId').value = '';

            const form = document.getElementById('mediaForm');
            form.action = "{{ route('media_visual.store') }}";
            form.querySelector('input[name="_method"]').value = 'POST';

            form.reset();
            document.getElementById('cancelButton').style.display = 'none';

            document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
            document.getElementById('tayangan_postingan').value = 0;
            document.getElementById('pengikut').value = 0;
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id;
                    const tanggal = this.dataset.tanggal;
                    const tayangan = this.dataset.tayangan;
                    const pengikut = this.dataset.pengikut;
                    const gambarUrl = this.dataset.gambarUrl || '';
                    const dokumenUrl = this.dataset.dokumenUrl || '';
                    editData(id, tanggal, tayangan, pengikut, gambarUrl, dokumenUrl);
                });
            });

            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const d = this.dataset;
                    document.getElementById('mediaViewTanggal').textContent = d.tanggal || '-';
                    document.getElementById('mediaViewTayangan').textContent = d.tayangan || '0';
                    document.getElementById('mediaViewPengikut').textContent = d.pengikut || '0';

                    const imgContainer = document.getElementById('mediaViewGambarContainer');
                    const imgEl = document.getElementById('mediaViewGambar');
                    const imgDownload = document.getElementById('mediaViewGambarDownload');
                    if (d.gambarUrl) {
                        imgEl.src = d.gambarUrl;
                        imgContainer.style.display = 'block';
                        if (imgDownload) { imgDownload.href = d.gambarUrl; imgDownload.style.display = 'inline-block'; }
                    } else {
                        imgEl.src = '';
                        imgContainer.style.display = 'none';
                        if (imgDownload) { imgDownload.href = '#'; imgDownload.style.display = 'none'; }
                    }

                    const docContainer = document.getElementById('mediaViewDokumenContainer');
                    const docLink = document.getElementById('mediaViewDokumenLink');
                    const iframeContainer = document.getElementById('mediaViewDokumenFrameContainer');
                    const iframe = document.getElementById('mediaViewDokumenIframe');
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

                    const bsModal = new bootstrap.Modal(document.getElementById('viewMediaModal'));
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

            ['tayangan_postingan', 'pengikut'].forEach(id => {
                document.getElementById(id).addEventListener('blur', function () {
                    let val = parseInt(this.value);
                    this.value = (isNaN(val) || val < 0) ? 0 : val;
                });
            });

            document.getElementById('mediaForm').addEventListener('submit', function (e) {
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
