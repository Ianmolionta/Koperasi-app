@extends('Layouts.base')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><i class="menu-icon tf-icons bx bx-user"></i></span>
        Manajemen Users
    </h4>
    
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data Users</h5>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                    <i class="bx bx-plus me-1"></i>Tambah User
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="usersTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>NIP</th>
                            <th>Jabatan</th>
                            <th>No. HP</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah/Edit -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title mb-0" id="modalTitle">Tambah User</h5>
                        <small class="text-muted">Isi formulir dengan lengkap dan benar</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="userForm" method="POST">
                        @csrf
                        <input type="hidden" id="userId" name="id" />
                        
                        <!-- Section: Data Pribadi -->
                        <div class="form-section">
                            <div class="section-header mb-3">
                                <i class="bx bx-user text-primary"></i>
                                <span>Data Pribadi</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label fw-semibold">
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-user text-primary"></i>
                                        </span>
                                        <input type="text" class="form-control" id="nama" name="nama" 
                                               placeholder="Masukkan nama lengkap">
                                    </div>
                                    <small class="text-danger" id="nama-error"></small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nip" class="form-label fw-semibold">
                                        NIP <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-id-card text-primary"></i>
                                        </span>
                                        <input type="text" class="form-control" id="nip" name="nip" 
                                               placeholder="Masukkan NIP">
                                    </div>
                                    <small class="text-danger" id="nip-error"></small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="jabatan" class="form-label fw-semibold">
                                        Jabatan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-briefcase text-primary"></i>
                                        </span>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan" 
                                               placeholder="Masukkan jabatan">
                                    </div>
                                    <small class="text-danger" id="jabatan-error"></small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label fw-semibold">
                                        No. HP <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-phone text-primary"></i>
                                        </span>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" 
                                               placeholder="08xxxxxxxxxx">
                                    </div>
                                    <small class="text-danger" id="no_hp-error"></small>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Data Login -->
                        <div class="form-section">
                            <div class="section-header mb-3">
                                <i class="bx bx-lock text-primary"></i>
                                <span>Data Login</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="username" class="form-label fw-semibold">
                                        Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-user-circle text-primary"></i>
                                        </span>
                                        <input type="text" class="form-control" id="username" name="username" 
                                               placeholder="Username untuk login">
                                    </div>
                                    <small class="text-danger" id="username-error"></small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        Password <span class="text-danger" id="passwordRequired">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-lock text-primary"></i>
                                        </span>
                                        <input type="password" class="form-control" id="password" name="password" 
                                               placeholder="Masukkan password">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bx bx-hide"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted" id="passwordHint" style="display: none;">Kosongkan jika tidak ingin mengubah password</small>
                                    <small class="text-danger" id="password-error"></small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="role" class="form-label fw-semibold">
                                        Role <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-shield text-primary"></i>
                                        </span>
                                        <input type="text" class="form-control" id="role" name="role" 
                                               placeholder="" readonly value="mentor">
                                    </div>
                                    <small class="text-danger" id="role-error"></small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-outline-secondary btn-modern" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-primary btn-modern" id="saveBtn">
                        <i class="bx bx-save me-1"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title text-white">
                        <i class="bx bx-info-circle me-2"></i>Detail User
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100 border-0">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-bold text-primary">
                                        <i class="bx bx-user me-2"></i>Informasi Pribadi
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td class="text-muted" style="width: 40%;">
                                                <i class="bx bx-user text-primary me-1"></i>Nama Lengkap
                                            </td>
                                            <td class="fw-bold" id="detailNama">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <i class="bx bx-id-card text-primary me-1"></i>NIP
                                            </td>
                                            <td class="fw-bold" id="detailNip">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <i class="bx bx-briefcase text-primary me-1"></i>Jabatan
                                            </td>
                                            <td class="fw-bold" id="detailJabatan">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <i class="bx bx-phone text-primary me-1"></i>No. HP
                                            </td>
                                            <td class="fw-bold" id="detailNoHp">-</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100 border-0">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-bold text-primary">
                                        <i class="bx bx-lock me-2"></i>Informasi Akun
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless mb-0">
                                        <tr>
                                            <td class="text-muted" style="width: 40%;">
                                                <i class="bx bx-user-circle text-primary me-1"></i>Username
                                            </td>
                                            <td class="fw-bold" id="detailUsername">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <i class="bx bx-shield text-primary me-1"></i>Role
                                            </td>
                                            <td id="detailRole">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <i class="bx bx-calendar-plus text-primary me-1"></i>Dibuat Pada
                                            </td>
                                            <td class="fw-bold" id="detailCreated">-</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <i class="bx bx-calendar-edit text-primary me-1"></i>Terakhir Update
                                            </td>
                                            <td class="fw-bold" id="detailUpdated">-</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            let isEditMode = false;
            let currentUserId = null;

            // Initialize DataTable
            const table = $('#usersTable').DataTable({
                processing: true,
                order: [],
                language: {
                    search: "Pencarian:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });

            // Load data users
            function loadUsers() {
                $.ajax({
                    url: '/v1/users',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        table.clear();
                        
                        if (response.data && response.data.length > 0) {
                            $.each(response.data, function (index, user) {
                                const roleBadge = getRoleBadge(user.role);
                                
                                const actions = `
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-info btn-detail" data-id="${user.id}" title="Detail">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-edit" data-id="${user.id}" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-delete" data-id="${user.id}" title="Hapus">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                `;
                                
                                table.row.add([
                                    index + 1,
                                    user.nama || '-',
                                    user.username || '-',
                                    user.nip || '-',
                                    user.jabatan || '-',
                                    user.no_hp || '-',
                                    roleBadge,
                                    actions
                                ]);
                            });
                        }
                        
                        table.draw();
                    },
                    error: function (xhr) {
                        console.error('Error loading users:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data users',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            }

            // Helper function untuk role badge
            function getRoleBadge(role) {
                const badges = {
                    'admin': '<span class="badge bg-danger">Admin</span>',
                    'manager': '<span class="badge bg-warning">Manager</span>',
                    'staff': '<span class="badge bg-info">Staff</span>',
                    'kepala': '<span class="badge bg-success">Kepala</span>'
                };
                return badges[role] || `<span class="badge bg-secondary">${role}</span>`;
            }

            // Reset form modal
            function resetForm() {
                $('#userForm')[0].reset();
                $('#userId').val('');
                isEditMode = false;
                currentUserId = null;
                $('#modalTitle').text('Tambah User');
                $('#passwordRequired').show();
                $('#passwordHint').hide();
                $('#password').attr('placeholder', 'Masukkan password');
                $('.text-danger').text('');
                $('.form-control, .form-select').removeClass('is-invalid');
            }

            // Show modal tambah
            $('#userModal').on('show.bs.modal', function () {
                if (!isEditMode) {
                    resetForm();
                }
            });

            // Toggle password visibility
            $('#togglePassword').click(function () {
                const passwordField = $('#password');
                const icon = $(this).find('i');
                
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('bx-show').addClass('bx-hide');
                }
            });

            // Save data
            $('#saveBtn').click(function () {
                // Clear previous errors
                $('.text-danger').text('');
                $('.form-control, .form-select').removeClass('is-invalid');

                const formData = {
                    nama: $('#nama').val(),
                    username: $('#username').val(),
                    password: $('#password').val(),
                    jabatan: $('#jabatan').val(),
                    nip: $('#nip').val(),
                    no_hp: $('#no_hp').val(),
                    role: $('#role').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                const url = isEditMode ? `/v1/users/update/${currentUserId}` : '/v1/users/create';

                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#userModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message || 'Data berhasil disimpan',
                                confirmButtonColor: '#28a745'
                            }).then(() => {
                                loadUsers();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message || 'Terjadi kesalahan',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            // Validation errors
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                $(`#${key}`).addClass('is-invalid');
                                $(`#${key}-error`).text(value[0]);
                            });
                            Swal.close();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan data',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    }
                });
            });

            // Detail button
            $(document).on('click', '.btn-detail', function () {
                const userId = $(this).data('id');
                
                $.ajax({
                    url: `/v1/users/get/${userId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success' && response.data) {
                            const user = response.data;
                            
                            $('#detailNama').text(user.nama || '-');
                            $('#detailNip').text(user.nip || '-');
                            $('#detailJabatan').text(user.jabatan || '-');
                            $('#detailNoHp').text(user.no_hp || '-');
                            $('#detailUsername').text(user.username || '-');
                            $('#detailRole').html(getRoleBadge(user.role));
                            $('#detailCreated').text(formatDate(user.created_at));
                            $('#detailUpdated').text(formatDate(user.updated_at));
                            
                            $('#detailModal').modal('show');
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat detail user',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            });

            // Edit button
            $(document).on('click', '.btn-edit', function () {
                const userId = $(this).data('id');
                currentUserId = userId;
                isEditMode = true;
                
                $.ajax({
                    url: `/v1/users/get/${userId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success' && response.data) {
                            const user = response.data;
                            
                            $('#userId').val(user.id);
                            $('#nama').val(user.nama);
                            $('#username').val(user.username);
                            $('#jabatan').val(user.jabatan);
                            $('#nip').val(user.nip);
                            $('#no_hp').val(user.no_hp);
                            $('#role').val(user.role);
                            
                            $('#modalTitle').text('Edit User');
                            $('#passwordRequired').hide();
                            $('#passwordHint').show();
                            $('#password').attr('placeholder', 'Kosongkan jika tidak ingin mengubah');
                            
                            $('#userModal').modal('show');
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data user',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            });

            // Delete button
            $(document).on('click', '.btn-delete', function () {
                const userId = $(this).data('id');
                
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus user ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menghapus...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => { Swal.showLoading(); }
                        });

                        $.ajax({
                            url: `/v1/users/delete/${userId}`,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Terhapus!',
                                        text: response.message || 'Data berhasil dihapus',
                                        confirmButtonColor: '#28a745'
                                    }).then(() => {
                                        loadUsers();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: response.message || 'Gagal menghapus data',
                                        confirmButtonColor: '#dc3545'
                                    });
                                }
                            },
                            error: function (xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus data',
                                    confirmButtonColor: '#dc3545'
                                });
                            }
                        });
                    }
                });
            });

            // Helper function format date
            function formatDate(dateString) {
                if (!dateString) return '-';
                const date = new Date(dateString);
                return date.toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            // Initial load
            loadUsers();
        });
    </script>

    <style>
        /* Form Sections */
        .form-section {
            margin-bottom: 1.75rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px dashed #e9ecef;
        }
        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e0e7ff;
        }
        .section-header i {
            font-size: 1.25rem;
        }

        /* Form Styling */
        .form-label {
            color: #495057;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .form-control,
        .form-select {
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.625rem 0.875rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }
        
        .input-group-text {
            border: 1.5px solid #e0e0e0;
            border-right: none;
            background: #f8f9fa;
            border-radius: 8px 0 0 8px;
        }
        
        .input-group .form-control,
        .input-group .form-select {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }

        /* Button Groups */
        .btn-group-sm .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        /* Modal */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        }

        .card {
            border: none;
            transition: all 0.3s ease;
            border-radius: 10px;
        }
        
        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.15);
            transform: translateY(-3px);
        }

        .table-borderless td {
            padding: 0.875rem 0.5rem;
            vertical-align: top;
        }
        
        .table-borderless tr {
            border-bottom: 1px solid #e0e7ff;
        }
        
        .table-borderless tr:last-child {
            border-bottom: none;
        }

        /* Badge */
        .badge {
            padding: 0.35em 0.65em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Modern Button */
        .btn-modern {
            padding: 0.625rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border-width: 1.5px;
        }
        
        .btn-modern i {
            font-size: 1rem;
        }
        
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Validation */
        .is-invalid {
            border-color: #dc3545 !important;
        }
        
        small.text-danger {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.875rem;
        }
    </style>
@endsection