@extends('Layouts.Base')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> <i
                class="menu-icon tf-icons bx bx-purchase-tag"></i></span>
        Kategori UMKM</h4>
    
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data Kategori UMKM</h5>
            @if (auth()->user()->role !== 'admin')
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <i class="bx bx-plus me-1"></i>Tambah Data
                </button>
            </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah/Edit -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Kategori UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="upsertDataForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id" name="id" />
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" id="nama_kategori" name="nama_kategori" class="form-control"
                                    placeholder="Masukan Nama Kategori" />
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="simpanData">
                        <i class="bx bx-save me-1"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // ==================== USER ROLE & AUTHENTICATION ====================
            const currentUser = {
                id: "{{ auth()->user()->id ?? '' }}",
                nama: "{{ auth()->user()->nama ?? '' }}",
                role: "{{ auth()->user()->role ?? '' }}"
            };

            const isAdmin = currentUser.role === 'admin';

            // ==================== VALIDATION SYSTEM ====================
            const ValidationRules = {
                nama_kategori: {
                    required: true,
                    minLength: 3,
                    maxLength: 255,
                    messages: {
                        required: 'Nama Kategori wajib diisi',
                        minLength: 'Nama Kategori minimal 3 karakter',
                        maxLength: 'Nama Kategori maksimal 255 karakter'
                    }
                }
            };

            // Fungsi untuk validasi individual field
            function validateField(fieldName, value) {
                const rules = ValidationRules[fieldName];
                if (!rules) return { valid: true };

                // Required validation
                if (rules.required && (!value || value.trim() === '')) {
                    return {
                        valid: false,
                        message: rules.messages.required
                    };
                }

                // Skip other validations if field is empty and not required
                if (!value || value.trim() === '') {
                    return { valid: true };
                }

                // MinLength validation
                if (rules.minLength && value.length < rules.minLength) {
                    return {
                        valid: false,
                        message: rules.messages.minLength
                    };
                }

                // MaxLength validation
                if (rules.maxLength && value.length > rules.maxLength) {
                    return {
                        valid: false,
                        message: rules.messages.maxLength
                    };
                }

                return { valid: true };
            }

            // Fungsi untuk set field state (valid/invalid)
            function setFieldState(fieldName, isValid, message = '') {
                const $field = $(`[name="${fieldName}"]`);
                const $feedback = $field.siblings('.invalid-feedback');

                // Remove previous states
                $field.removeClass('is-invalid is-valid');

                if (isValid) {
                    // Set valid state (hijau)
                    $field.addClass('is-valid');
                    $feedback.text('');
                } else {
                    // Set invalid state (merah)
                    $field.addClass('is-invalid');
                    $feedback.text(message);
                }
            }

            // Fungsi untuk clear field state
            function clearFieldState(fieldName) {
                const $field = $(`[name="${fieldName}"]`);
                const $feedback = $field.siblings('.invalid-feedback');
                
                $field.removeClass('is-invalid is-valid');
                $feedback.text('');
            }

            // Fungsi untuk clear semua field states
            function clearAllFieldStates() {
                $('#upsertDataForm input, #upsertDataForm select, #upsertDataForm textarea').each(function() {
                    const fieldName = $(this).attr('name');
                    if (fieldName && fieldName !== '_token') {
                        clearFieldState(fieldName);
                    }
                });
            }

            // Fungsi untuk validate seluruh form
            function validateForm() {
                let isFormValid = true;
                const formData = new FormData($('#upsertDataForm')[0]);

                for (let fieldName in ValidationRules) {
                    const value = formData.get(fieldName) || '';
                    const validation = validateField(fieldName, value);

                    if (!validation.valid) {
                        setFieldState(fieldName, false, validation.message);
                        isFormValid = false;
                    } else {
                        setFieldState(fieldName, true);
                    }
                }

                return isFormValid;
            }

            // Real-time validation on input/change
            $('#upsertDataForm').on('input change', 'input, select, textarea', function() {
                const fieldName = $(this).attr('name');
                
                if (fieldName && fieldName !== '_token' && ValidationRules[fieldName]) {
                    const value = $(this).val() || '';
                    const validation = validateField(fieldName, value);

                    if (validation.valid) {
                        setFieldState(fieldName, true);
                    } else {
                        setFieldState(fieldName, false, validation.message);
                    }
                }
            });

            // ==================== DATA TABLE ====================
            
            function getData() {
                $.ajax({
                    url: '/v1/kategori-Umkm',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Destroy existing DataTable if it exists
                        if ($.fn.DataTable.isDataTable('#table')) {
                            $('#table').DataTable().destroy();
                        }

                        let tableBody = "";

                        // Cek apakah data kosong atau tidak ada
                        if (!response.data || response.data.length === 0) {
                            $("#table tbody").html('');
                            initializeEmptyDataTable();
                            return;
                        }

                        // Jika ada data, generate rows
                        $.each(response.data, function(index, item) {
                            tableBody += "<tr>";
                            tableBody += "<td class='text-center'>" + (index + 1) + "</td>";
                            tableBody += "<td>" + item.nama_kategori + "</td>";
                            tableBody += "<td class='text-center'>";
                            
                            // Tombol Edit dan Hapus - hanya untuk non-admin
                            if (!isAdmin) {
                                tableBody += "<button type='button' class='btn btn-outline-primary btn-sm edit-btn me-1' data-id='" + item.id + "' title='Edit'><i class='bx bx-pencil'></i></button>";
                                tableBody += "<button type='button' class='btn btn-outline-danger btn-sm delete-confirm' data-id='" + item.id + "' title='Hapus'><i class='bx bx-trash'></i></button>";
                            } else {
                                tableBody += "<span class='badge bg-secondary'>Hanya Lihat</span>";
                            }
                            
                            tableBody += "</td>";
                            tableBody += "</tr>";
                        });

                        $("#table tbody").html(tableBody);
                        initializeDataTable();
                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data dari server");
                        if ($.fn.DataTable.isDataTable('#table')) {
                            $('#table').DataTable().destroy();
                        }
                        $("#table tbody").html('');
                        initializeErrorDataTable();
                    }
                });
            }

            function initializeDataTable() {
                $('#table').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    order: [],
                    autoWidth: false,
                    responsive: true,
                    language: getDataTableLanguage('Data Tidak Ditemukan', 'Tidak ada data yang sesuai dengan pencarian Anda'),
                    columnDefs: [{
                            width: "10%",
                            targets: 0,
                            orderable: false,
                            className: 'text-center'
                        },
                        {
                            width: "70%",
                            targets: 1
                        },
                        {
                            width: "20%",
                            targets: 2,
                            orderable: false,
                            className: 'text-center'
                        }
                    ],
                    pageLength: 10,
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]]
                });
            }

            function initializeEmptyDataTable() {
                $('#table').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    order: [],
                    autoWidth: false,
                    responsive: true,
                    language: getDataTableLanguage('Data Tidak Tersedia', 'Belum ada data kategori yang ditambahkan'),
                    columnDefs: [{
                            width: "10%",
                            targets: 0,
                            orderable: false,
                            className: 'text-center'
                        },
                        {
                            width: "70%",
                            targets: 1
                        },
                        {
                            width: "20%",
                            targets: 2,
                            orderable: false,
                            className: 'text-center'
                        }
                    ],
                    pageLength: 10,
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]]
                });
            }

            function initializeErrorDataTable() {
                $('#table').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    order: [],
                    autoWidth: false,
                    responsive: true,
                    language: {
                        search: "Pencarian:",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        emptyTable: `
                            <div class="text-center py-4">
                                <div class="mb-3">
                                    <i class="bx bx-error-circle bx-lg text-danger"></i>
                                </div>
                                <h6 class="text-danger">Gagal Memuat Data</h6>
                                <p class="text-muted small mb-0">Terjadi kesalahan saat mengambil data dari server</p>
                            </div>
                        `,
                        info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                        infoEmpty: "Tidak ada data yang tersedia",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        }
                    },
                    columnDefs: [{
                            width: "10%",
                            targets: 0,
                            orderable: false,
                            className: 'text-center'
                        },
                        {
                            width: "70%",
                            targets: 1
                        },
                        {
                            width: "20%",
                            targets: 2,
                            orderable: false,
                            className: 'text-center'
                        }
                    ],
                    pageLength: 10,
                    lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]]
                });
            }

            function getDataTableLanguage(title, message) {
                return {
                    search: "Pencarian:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: `
                        <div class="text-center py-4">
                            <div class="mb-3">
                                <i class="bx bx-data bx-lg text-muted"></i>
                            </div>
                            <h6 class="text-muted">${title}</h6>
                            <p class="text-muted small mb-0">${message}</p>
                        </div>
                    `,
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                    emptyTable: `
                        <div class="text-center py-4">
                            <div class="mb-3">
                                <i class="bx bx-data bx-lg text-muted"></i>
                            </div>
                            <h6 class="text-muted">${title}</h6>
                            <p class="text-muted small mb-0">${message}</p>
                        </div>
                    `
                };
            }

            getData();

            // ==================== EVENT HANDLERS ====================

            // Event handler untuk simpan data
            $(document).on('click', '#simpanData', function(e) {
                e.preventDefault();

                // Check role - admin tidak bisa simpan data
                if (isAdmin) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Akses Ditolak',
                        text: 'Anda tidak memiliki izin untuk melakukan aksi ini',
                        confirmButtonColor: '#dc3545'
                    });
                    return false;
                }

                // Validasi form
                if (!validateForm()) {
                    return false;
                }

                let id = $('#id').val();
                let formData = new FormData($('#upsertDataForm')[0]);
                let url = id ? `/v1/kategori-Umkm/update/${id}` : '/v1/kategori-Umkm/create';
                let method = 'POST';

                // Disable button untuk mencegah double submit
                $(this).prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i>Menyimpan...');

                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.code === 422 && response.errors) {
                            // Tampilkan error dari server
                            for (let fieldName in response.errors) {
                                setFieldState(fieldName, false, response.errors[fieldName][0]);
                            }
                            $('#simpanData').prop('disabled', false).html('<i class="bx bx-save me-1"></i>Simpan Data');
                        } else if (response.status === 'success') {
                            const modalEl = document.getElementById('basicModal');
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) {
                                modal.hide();
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil disimpan',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            $('#simpanData').prop('disabled', false).html('<i class="bx bx-save me-1"></i>Simpan Data');
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat menyimpan data',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        $('#simpanData').prop('disabled', false).html('<i class="bx bx-save me-1"></i>Simpan Data');
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menyimpan data',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            });

            // Event handler untuk edit - hanya untuk non-admin
            $(document).on('click', '.edit-btn', function() {
                // Check role - admin tidak bisa edit
                if (isAdmin) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Akses Ditolak',
                        text: 'Admin tidak memiliki izin untuk mengedit data',
                        confirmButtonColor: '#dc3545'
                    });
                    return false;
                }

                let id = $(this).data('id');
                $.ajax({
                    url: `/v1/kategori-Umkm/get/${id}`,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        const modalEl = document.getElementById('basicModal');
                        const modal = new bootstrap.Modal(modalEl);

                        // Ubah judul modal
                        $('#exampleModalLabel1').text('Edit Kategori UMKM');

                        // Populate form fields with existing data
                        $('#id').val(response.data.id);
                        $('#nama_kategori').val(response.data.nama_kategori);

                        // Clear validation states
                        clearAllFieldStates();

                        modal.show();

                        // Trigger validation untuk field yang sudah terisi
                        $('#nama_kategori').trigger('change');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data for edit:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Gagal mengambil data untuk diedit',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            });

            // Fungsi untuk delete data
            function deleteDataById(id) {
                // Check role - admin tidak bisa delete
                if (isAdmin) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Akses Ditolak',
                        text: 'Admin tidak memiliki izin untuk menghapus data',
                        confirmButtonColor: '#dc3545'
                    });
                    return false;
                }

                if (!id) {
                    console.error('ID tidak valid');
                    return;
                }

                $.ajax({
                    type: 'DELETE',
                    url: `/v1/kategori-Umkm/delete/${id}`,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Data gagal dihapus',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menghapus data',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            }

            // Event handler untuk delete - hanya untuk non-admin
            $(document).on('click', '.delete-confirm', function() {
                // Check role - admin tidak bisa delete
                if (isAdmin) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Akses Ditolak',
                        text: 'Admin tidak memiliki izin untuk menghapus data',
                        confirmButtonColor: '#dc3545'
                    });
                    return false;
                }

                const id = $(this).data('id');
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteDataById(id);
                    }
                });
            });

            // Reset modal ketika ditutup
            $('#basicModal').on('hidden.bs.modal', function() {
                $('#upsertDataForm')[0].reset();
                $('#id').val('');
                $('#exampleModalLabel1').text('Tambah Kategori UMKM');
                $('#simpanData').prop('disabled', false).html('<i class="bx bx-save me-1"></i>Simpan Data');
                
                // Clear all validation states
                clearAllFieldStates();
            });

            // Reset modal ketika dibuka untuk tambah data
            $('#basicModal').on('show.bs.modal', function(e) {
                // Cek apakah ini bukan dari tombol edit
                if (!$(e.relatedTarget).hasClass('edit-btn')) {
                    $('#exampleModalLabel1').text('Tambah Kategori UMKM');
                    clearAllFieldStates();
                }
            });
        });
    </script>

    <style>
        /* Fix untuk navbar tetap gelap saat SweetAlert muncul */
        .swal2-container {
            z-index: 10000 !important;
        }

        /* Style untuk field yang invalid (merah) */
        .is-invalid {
            border-color: #dc3545 !important;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .is-invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        /* Style untuk field yang valid (hijau) */
        .is-valid {
            border-color: #28a745 !important;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .is-valid:focus {
            border-color: #28a745 !important;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        /* Style untuk pesan error */
        .invalid-feedback {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #dc3545;
        }

        /* Smooth transition untuk border color */
        .form-control,
        .form-select {
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        /* Style untuk badge "Hanya Lihat" */
        .badge.bg-secondary {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
    </style>
@endsection