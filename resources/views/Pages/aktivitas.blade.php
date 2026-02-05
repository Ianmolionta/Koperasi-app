@extends('Layouts.base')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><i class="menu-icon tf-icons bx bx-task"></i></span>
        Aktivitas UMKM
    </h4>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data Aktivitas UMKM</h5>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aktivitasModal">
                    <i class="bx bx-plus me-1"></i>Tambah Aktivitas
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="aktivitasTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama UMKM</th>
                            <th>Petugas</th>
                            <th>Periode Catur Wulan</th>
                            <th>Tanggal Aktivitas</th>
                            <th>Ringkasan Aktivitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah/Edit -->
    <div class="modal fade" id="aktivitasModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-gradient-red text-white">
                    <div>
                        <h5 class="modal-title mb-0 text-white" id="modalTitle">Tambah Aktivitas UMKM</h5>
                        <small class="text-white opacity-75">Isi formulir dengan lengkap dan benar</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="aktivitasForm" method="POST">
                        @csrf
                        <input type="hidden" id="aktivitasId" name="id" />

                        <!-- Section: Informasi Umum -->
                        <div class="form-section">
                            <div class="section-header mb-3">
                                <i class="bx bx-info-circle text-danger"></i>
                                <span>Informasi Umum</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="umkm_id" class="form-label fw-semibold">
                                        Nama UMKM <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-store text-danger"></i>
                                        </span>
                                        <select class="form-select" id="umkm_id" name="umkm_id">
                                            <option value="">Pilih UMKM</option>
                                        </select>
                                    </div>
                                    <small class="text-danger" id="umkm_id-error"></small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="users_name" class="form-label fw-semibold">
                                        Petugas <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-user text-danger"></i>
                                        </span>
                                        <input type="text" class="form-control bg-light" id="users_name" readonly>
                                        <input type="hidden" id="users_id" name="users_id">
                                    </div>
                                    <small class="text-muted d-block mt-1">
                                        <i class="bx bx-info-circle"></i> Petugas diisi otomatis sesuai user yang login
                                    </small>
                                    <small class="text-danger" id="users_id-error"></small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="periode_catur_wulan" class="form-label fw-semibold">
                                        Periode Catur Wulan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-calendar text-danger"></i>
                                        </span>
                                        <select class="form-select" id="periode_catur_wulan" name="periode_catur_wulan">
                                            <option value="">Pilih Periode</option>
                                            <option value="Januari - April">Januari - April</option>
                                            <option value="Mei - Agustus">Mei - Agustus</option>
                                            <option value="September - Desember">September - Desember</option>
                                        </select>
                                    </div>
                                    <small class="text-danger" id="periode_catur_wulan-error"></small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_aktivitas" class="form-label fw-semibold">
                                        Tanggal Aktivitas <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-calendar-event text-danger"></i>
                                        </span>
                                        <input type="date" class="form-control" id="tanggal_aktivitas"
                                            name="tanggal_aktivitas">
                                    </div>
                                    <small class="text-danger" id="tanggal_aktivitas-error"></small>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Detail Aktivitas -->
                        <div class="form-section">
                            <div class="section-header mb-3">
                                <i class="bx bx-file-text text-danger"></i>
                                <span>Detail Aktivitas</span>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="aktivitas" class="form-label fw-semibold">
                                        Aktivitas <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="aktivitas" name="aktivitas" class="form-control summernote"></textarea>
                                    <small class="text-danger" id="aktivitas-error"></small>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="permasalahan" class="form-label fw-semibold">
                                        Permasalahan <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="permasalahan" name="permasalahan" class="form-control summernote"></textarea>
                                    <small class="text-danger" id="permasalahan-error"></small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light-red border-0">
                    <button type="button" class="btn btn-outline-secondary btn-modern" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-danger btn-modern" id="saveBtn">
                        <i class="bx bx-save me-1"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Aktivitas (Tema Merah Putih) -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content detail-modal-redwhite">
                <div class="modal-header bg-gradient-red text-white">
                    <h5 class="modal-title text-white">
                        <i class="bx bx-detail me-2"></i>Detail Aktivitas UMKM
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row mb-4">
                        <!-- Info Card -->
                        <div class="col-12">
                            <div class="card shadow-sm border-0 info-card-redwhite">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="text-muted small mb-1">
                                                <i class="bx bx-store text-danger me-1"></i>Nama UMKM
                                            </label>
                                            <div class="fw-bold text-dark" id="detailNamaUmkm">-</div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="text-muted small mb-1">
                                                <i class="bx bx-user text-danger me-1"></i>Petugas
                                            </label>
                                            <div class="fw-bold text-dark" id="detailPetugas">-</div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="text-muted small mb-1">
                                                <i class="bx bx-calendar text-danger me-1"></i>Periode
                                            </label>
                                            <div class="fw-bold text-dark" id="detailPeriode">-</div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="text-muted small mb-1">
                                                <i class="bx bx-calendar-event text-danger me-1"></i>Tanggal
                                            </label>
                                            <div class="fw-bold text-dark" id="detailTanggal">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Aktivitas Card -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100 border-0 card-red-detail">
                                <div class="card-header bg-gradient-red text-white">
                                    <h6 class="mb-0 fw-bold text-white">
                                        <i class="bx bx-file-text me-2"></i>Aktivitas
                                    </h6>
                                </div>
                                <div class="card-body content-area">
                                    <div id="detailAktivitas" class="summernote-content"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Permasalahan Card -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100 border-0 card-red-detail">
                                <div class="card-header bg-gradient-red text-white">
                                    <h6 class="mb-0 fw-bold text-white">
                                        <i class="bx bx-error-circle me-2"></i>Permasalahan
                                    </h6>
                                </div>
                                <div class="card-body content-area">
                                    <div id="detailPermasalahan" class="summernote-content"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light-red">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Summernote CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            let isEditMode = false;
            let currentAktivitasId = null;

            // Data user yang sedang login (dari Laravel Auth)
            const currentUser = {
                id: "{{ auth()->user()->id ?? '' }}", // Tambahkan tanda petik di sini
                nama: "{{ auth()->user()->nama ?? '' }}"
            };

            // Initialize Summernote
            function initSummernote() {
                $('.summernote').summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    placeholder: 'Tuliskan detail di sini...'
                });
            }

            // Initialize DataTable
            const table = $('#aktivitasTable').DataTable({
                processing: true,
                order: [
                    [4, 'desc']
                ], // Sort by tanggal
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

            // Load UMKM options
            function loadUmkmOptions() {
                $.ajax({
                    url: '/v1/umkm',
                    type: 'GET',
                    success: function(response) {
                        if (response.data) {
                            let options = '<option value="">Pilih UMKM</option>';
                            $.each(response.data, function(index, umkm) {
                                options +=
                                    `<option value="${umkm.id}">${umkm.nama_umkm}</option>`;
                            });
                            $('#umkm_id').html(options);
                        }
                    }
                });
            }

            // Set current user as petugas
            function setCurrentUserAsPetugas() {
                if (currentUser.id && currentUser.nama) {
                    $('#users_id').val(currentUser.id);
                    $('#users_name').val(currentUser.nama);
                }
            }

            // Strip HTML tags untuk preview
            function stripHtml(html) {
                let tmp = document.createElement("DIV");
                tmp.innerHTML = html;
                let text = tmp.textContent || tmp.innerText || "";
                return text.length > 100 ? text.substring(0, 100) + '...' : text;
            }

            // Load data aktivitas
            function loadAktivitas() {
                $.ajax({
                    url: '/v1/aktivitas',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        table.clear();

                        if (response.data && response.data.length > 0) {
                            $.each(response.data, function(index, item) {
                                const namaUmkm = item.umkm?.nama_umkm || '-';
                                const namaPetugas = item.user?.nama || '-';
                                const ringkasan = stripHtml(item.aktivitas || '-');

                                const actions = `
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-info btn-detail" data-id="${item.id}" title="Detail">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-edit" data-id="${item.id}" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-delete" data-id="${item.id}" title="Hapus">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                `;

                                table.row.add([
                                    index + 1,
                                    namaUmkm,
                                    namaPetugas,
                                    item.periode_catur_wulan || '-',
                                    formatDate(item.tanggal_aktivitas),
                                    ringkasan,
                                    actions
                                ]);
                            });
                        }

                        table.draw();
                    },
                    error: function(xhr) {
                        console.error('Error loading aktivitas:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data aktivitas',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            }

            // Reset form modal
            function resetForm() {
                $('#aktivitasForm')[0].reset();
                $('#aktivitasId').val('');
                $('#aktivitas').summernote('code', '');
                $('#permasalahan').summernote('code', '');
                isEditMode = false;
                currentAktivitasId = null;
                $('#modalTitle').text('Tambah Aktivitas UMKM');
                $('.text-danger').text('');
                $('.form-control, .form-select').removeClass('is-invalid');

                // Set current user sebagai petugas
                setCurrentUserAsPetugas();
            }

            // Show modal tambah
            $('#aktivitasModal').on('show.bs.modal', function() {
                if (!isEditMode) {
                    resetForm();
                }
                initSummernote();
            });

            // Destroy summernote when modal closes
            $('#aktivitasModal').on('hidden.bs.modal', function() {
                $('.summernote').summernote('destroy');
            });

            // Save data
            $('#saveBtn').click(function() {
                // Clear previous errors
                $('.text-danger').text('');
                $('.form-control, .form-select').removeClass('is-invalid');

                const formData = {
                    umkm_id: $('#umkm_id').val(),
                    users_id: $('#users_id').val(),
                    periode_catur_wulan: $('#periode_catur_wulan').val(),
                    tanggal_aktivitas: $('#tanggal_aktivitas').val(),
                    aktivitas: $('#aktivitas').summernote('code'),
                    permasalahan: $('#permasalahan').summernote('code'),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                const url = isEditMode ? `/v1/aktivitas/update/${currentAktivitasId}` :
                    '/v1/aktivitas/create';

                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#aktivitasModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message || 'Data berhasil disimpan',
                                confirmButtonColor: '#28a745'
                            }).then(() => {
                                loadAktivitas();
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
                    error: function(xhr) {
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $(`#${key}`).addClass('is-invalid');
                                $(`#${key}-error`).text(value[0]);
                            });
                            Swal.close();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: xhr.responseJSON?.message ||
                                    'Terjadi kesalahan saat menyimpan data',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    }
                });
            });

            // Detail button
            $(document).on('click', '.btn-detail', function() {
                const aktivitasId = $(this).data('id');

                $.ajax({
                    url: `/v1/aktivitas/get/${aktivitasId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            const data = response.data;

                            $('#detailNamaUmkm').text(data.umkm?.nama_umkm || '-');
                            $('#detailPetugas').text(data.user?.nama || '-');
                            $('#detailPeriode').text(data.periode_catur_wulan || '-');
                            $('#detailTanggal').text(formatDate(data.tanggal_aktivitas));
                            $('#detailAktivitas').html(data.aktivitas ||
                                '<p class="text-muted">Tidak ada data</p>');
                            $('#detailPermasalahan').html(data.permasalahan ||
                                '<p class="text-muted">Tidak ada data</p>');

                            $('#detailModal').modal('show');
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat detail aktivitas',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            });

            // Edit button
            $(document).on('click', '.btn-edit', function() {
                const aktivitasId = $(this).data('id');
                currentAktivitasId = aktivitasId;
                isEditMode = true;

                $.ajax({
                    url: `/v1/aktivitas/get/${aktivitasId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            const data = response.data;

                            $('#aktivitasId').val(data.id);
                            $('#umkm_id').val(data.umkm_id);
                            $('#users_id').val(data.users_id);

                            // Set nama petugas (bisa dari data yang ada atau tetap user login)
                            if (data.user && data.user.nama) {
                                $('#users_name').val(data.user.nama);
                            }

                            $('#periode_catur_wulan').val(data.periode_catur_wulan);
                            $('#tanggal_aktivitas').val(data.tanggal_aktivitas);

                            $('#modalTitle').text('Edit Aktivitas UMKM');
                            $('#aktivitasModal').modal('show');

                            // Set summernote after modal shown
                            setTimeout(() => {
                                $('#aktivitas').summernote('code', data.aktivitas ||
                                '');
                                $('#permasalahan').summernote('code', data
                                    .permasalahan || '');
                            }, 300);
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Gagal memuat data aktivitas',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            });

            // Delete button
            $(document).on('click', '.btn-delete', function() {
                const aktivitasId = $(this).data('id');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus aktivitas ini?',
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
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: `/v1/aktivitas/delete/${aktivitasId}`,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Terhapus!',
                                        text: response.message ||
                                            'Data berhasil dihapus',
                                        confirmButtonColor: '#28a745'
                                    }).then(() => {
                                        loadAktivitas();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: response.message ||
                                            'Gagal menghapus data',
                                        confirmButtonColor: '#dc3545'
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: xhr.responseJSON?.message ||
                                        'Terjadi kesalahan saat menghapus data',
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
                    day: 'numeric'
                });
            }

            // Initial load
            loadUmkmOptions();
            setCurrentUserAsPetugas();
            loadAktivitas();
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
            border-bottom: 2px solid #ffe0e0;
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
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
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

        /* Readonly styling untuk field petugas */
        .form-control.bg-light[readonly] {
            background-color: #f8f9fa !important;
            cursor: not-allowed;
            color: #6c757d;
        }

        /* Button Groups */
        .btn-group-sm .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        /* Red Theme */
        .bg-gradient-red {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .bg-light-red {
            background: #fff5f5;
            border-top: 1px solid #ffe0e0;
        }

        /* Detail Modal Red White Theme */
        .detail-modal-redwhite {
            border: none;
            box-shadow: 0 0.5rem 2rem rgba(220, 53, 69, 0.2);
        }

        .info-card-redwhite {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
            border: 2px solid #ffcccc;
            border-radius: 15px;
        }

        .card-red-detail {
            border: none;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .card-red-detail:hover {
            box-shadow: 0 0.5rem 1rem rgba(220, 53, 69, 0.15);
            transform: translateY(-3px);
        }

        .card-red-detail .card-header {
            border-bottom: none;
            padding: 1rem 1.25rem;
        }

        .content-area {
            max-height: 400px;
            overflow-y: auto;
            padding: 1.5rem;
        }

        .summernote-content {
            line-height: 1.8;
            color: #495057;
        }

        .summernote-content p {
            margin-bottom: 1rem;
        }

        .summernote-content ul,
        .summernote-content ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .summernote-content table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
        }

        .summernote-content table td,
        .summernote-content table th {
            padding: 0.5rem;
            border: 1px solid #dee2e6;
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

        .btn-danger.btn-modern {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
        }

        .btn-danger.btn-modern:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
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

        /* Summernote Customization */
        .note-editor.note-frame {
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
        }

        .note-editor.note-frame .note-editing-area .note-editable {
            min-height: 200px;
            padding: 1rem;
        }

        /* Custom Scrollbar */
        .content-area::-webkit-scrollbar {
            width: 8px;
        }

        .content-area::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .content-area::-webkit-scrollbar-thumb {
            background: #dc3545;
            border-radius: 10px;
        }

        .content-area::-webkit-scrollbar-thumb:hover {
            background: #c82333;
        }
    </style>
@endsection
