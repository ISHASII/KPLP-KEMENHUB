<!DOCTYPE html>
<html lang="en">

<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <x-navbar>Kelola Akun</x-navbar>
        <div class="container-fluid py-4">
            <!-- Form Input Data -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6 id="formTitle">Tambah Akun Baru</h6>
                        </div>
                        <div class="card-body">
                            <form id="userForm" action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <input type="hidden" id="formMethod" name="_method" value="POST">
                                <input type="hidden" id="dataId" name="id">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">Nama Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" required value="{{ old('name') }}"
                                                placeholder="Masukkan nama lengkap">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="username" class="form-control-label">Username <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                id="username" name="username" required value="{{ old('username') }}"
                                                placeholder="Masukkan username">
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" required value="{{ old('email') }}"
                                                placeholder="Masukkan email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- role field removed: role now always defaults to 'user' and cannot be edited -->
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="password" class="form-control-label">Password <span
                                                    class="text-danger" id="passwordRequired">*</span></label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password"
                                                placeholder="Masukkan password (min. 8 karakter)">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted" id="passwordHint" style="display: none;">Kosongkan
                                                jika tidak ingin mengubah password</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-control-label">Konfirmasi
                                                Password <span class="text-danger"
                                                    id="passwordConfirmRequired">*</span></label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation" placeholder="Ulangi password">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn bg-gradient-primary" id="submitButton">
                                            <i class="fa-solid fa-plus me-2"></i>Simpan Akun
                                        </button>
                                        <button type="button" class="btn bg-gradient-secondary" id="cancelButton"
                                            style="display: none;" onclick="resetForm()">
                                            <i class="fa-solid fa-times me-2"></i>Batal Edit
                                        </button>
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
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Daftar Akun Pengguna</h6>
                            <span class="badge bg-gradient-primary">Total: {{ $users->count() }} Akun</span>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mx-4" role="alert">
                                    <i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
                                    <i class="fa-solid fa-exclamation-circle me-2"></i>{{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
                                    <i class="fa-solid fa-exclamation-triangle me-2"></i>
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-4">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Pengguna</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Username</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">
                                                Role</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">
                                                Status</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">
                                                Dibuat</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">
                                                Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">
                                        @forelse($users as $index => $user)
                                            <tr id="row-{{ $user->id }}">
                                                <td class="ps-4 py-3">
                                                    <span class="text-sm font-weight-bold">{{ $index + 1 }}</span>
                                                </td>
                                                <td class="py-3">
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3">
                                                    <span class="text-sm font-weight-bold">{{ $user->username }}</span>
                                                </td>
                                                <td class="text-center py-3">
                                                    @if($user->role === 'admin')
                                                        <span class="badge bg-gradient-danger px-3 py-2">Admin</span>
                                                    @else
                                                        <span class="badge bg-gradient-info px-3 py-2">User</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    @if($user->is_active)
                                                        <span class="badge bg-gradient-success px-3 py-2">
                                                            <i class="fa-solid fa-check me-1"></i>Aktif
                                                        </span>
                                                    @else
                                                        <span class="badge bg-gradient-secondary px-3 py-2">
                                                            <i class="fa-solid fa-ban me-1"></i>Nonaktif
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <span class="text-xs text-secondary">
                                                        {{ $user->created_at->format('d/m/Y H:i') }}
                                                    </span>
                                                </td>
                                                <td class="text-center py-3">
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-sm btn-info edit-btn me-1"
                                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                            data-username="{{ $user->username }}"
                                                            data-email="{{ $user->email }}" data-role="{{ $user->role }}"
                                                            title="Edit Akun">
                                                            <i class="fa-solid fa-edit"></i>
                                                        </button>

                                                        @if($user->id !== auth()->id())
                                                            <form action="{{ route('users.toggle-status', $user->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit"
                                                                    class="btn btn-sm {{ $user->is_active ? 'btn-warning' : 'btn-success' }} me-1"
                                                                    onclick="return confirm('{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }} akun {{ $user->name }}?')"
                                                                    title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }} Akun">
                                                                    <i
                                                                        class="fa-solid {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus akun {{ $user->name }}? Tindakan ini tidak dapat dibatalkan!')"
                                                                    title="Hapus Akun">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button type="button" class="btn btn-sm btn-info disabled" aria-disabled="true" title="Ini adalah akun Anda" style="pointer-events: none;">
                                                                <i class="fa-solid fa-user me-1"></i>
                                                                <span class="text-uppercase small mb-0">Anda</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="text-center">
                                                        <i class="fa-solid fa-users fa-3x text-secondary mb-3"></i>
                                                        <p class="text-sm text-secondary mb-0">Belum ada data akun pengguna
                                                        </p>
                                                    </div>
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

    <script>
        // Edit button handler
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const username = this.dataset.username;
                const email = this.dataset.email;
                const role = this.dataset.role;

                // Update form
                document.getElementById('formTitle').textContent = 'Edit Akun: ' + name;
                document.getElementById('userForm').action = '/kelola-akun/' + id;
                document.getElementById('formMethod').value = 'PUT';
                document.getElementById('dataId').value = id;

                // Fill form fields
                document.getElementById('name').value = name;
                document.getElementById('username').value = username;
                document.getElementById('email').value = email;
                document.getElementById('role').value = role;
                document.getElementById('password').value = '';
                document.getElementById('password_confirmation').value = '';

                // Update password requirements
                document.getElementById('password').removeAttribute('required');
                document.getElementById('password_confirmation').removeAttribute('required');
                document.getElementById('passwordRequired').style.display = 'none';
                document.getElementById('passwordConfirmRequired').style.display = 'none';
                document.getElementById('passwordHint').style.display = 'block';

                // Update buttons
                document.getElementById('submitButton').innerHTML = '<i class="fa-solid fa-save me-2"></i>Update Akun';
                document.getElementById('cancelButton').style.display = 'inline-block';



                // Scroll to form
                document.querySelector('.card').scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Reset form function
        function resetForm() {
            document.getElementById('formTitle').textContent = 'Tambah Akun Baru';
            document.getElementById('userForm').action = '{{ route('users.store') }}';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('dataId').value = '';

            // Clear all fields
            document.getElementById('name').value = '';
            document.getElementById('username').value = '';
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';

            // Restore password requirements
            document.getElementById('password').setAttribute('required', 'required');
            document.getElementById('password_confirmation').setAttribute('required', 'required');
            document.getElementById('passwordRequired').style.display = 'inline';
            document.getElementById('passwordConfirmRequired').style.display = 'inline';
            document.getElementById('passwordHint').style.display = 'none';

            // Update buttons
            document.getElementById('submitButton').innerHTML = '<i class="fa-solid fa-plus me-2"></i>Simpan Akun';
            document.getElementById('cancelButton').style.display = 'none';
        }

        // Initialize perfect scrollbar for Windows
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>
