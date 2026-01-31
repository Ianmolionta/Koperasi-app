@extends('Layouts.base')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><i class="menu-icon tf-icons bx bx-wallet"></i></span>
        Peminjaman</h4>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data Peminjaman</h5>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <i class="bx bx-plus me-1"></i>Tambah Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama UMKM</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Sisa Pinjaman</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Tanggal Disetujui</th>
                            <th>Batas Pengembalian</th>
                            <th>Status</th>
                            <th>Catatan</th>
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
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" aria-labelledby="basicModalLable">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="upsertDataForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id" name="id" />

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="umkm_id" class="form-label">Nama UMKM <span
                                        class="text-danger">*</span></label>
                                <select id="umkm_id" name="umkm_id" class="form-select">
                                    <option value="">Pilih UMKM</option>
                                </select>
                                <small class="text-danger" id="umkm_id-error"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="jumlah_pinjaman" name="jumlah_pinjaman" class="form-control"
                                    placeholder="Masukan Jumlah Pinjaman" />
                                <small class="text-danger" id="jumlah_pinjaman-error"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="catatan" class="form-label">Catatan <span class="text-danger">*</span></label>
                                <textarea id="catatan" name="catatan" class="form-control" placeholder="Masukan Catatan" rows="2"></textarea>
                                <small class="text-danger" id="catatan-error"></small>
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

    <!-- Modal Detail Peminjaman - RED WHITE THEME -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content detail-modal-redwhite">
                <div class="modal-header bg-gradient-red text-white">
                    <h5 class="modal-title text-white">
                        <i class="bx bx-detail me-2"></i>Detail Peminjaman
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Loading State -->
                    <div id="detailLoading" class="text-center py-5">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Memuat data...</p>
                    </div>

                    <!-- Content -->
                    <div id="detailContent" style="display: none;">
                        <!-- Status Badge Section - Redesigned -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card shadow-sm border-0 status-card-redwhite">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="status-icon-wrapper-redwhite">
                                                    <i class="bx bx-info-circle"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 text-muted small">Status Peminjaman</h6>
                                                    <div id="detailStatusBadge"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-danger btn-lg shadow-sm"
                                                    id="approveBtn" style="display: none;">
                                                    <i class="bx bx-check-circle me-2"></i>Setujui Peminjaman
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Informasi Peminjaman -->
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow-sm h-100 border-0 card-red-detail">
                                    <div class="card-header bg-gradient-red text-white">
                                        <h6 class="mb-0 fw-bold text-white">
                                            <i class="bx bx-money me-2"></i>Informasi Peminjaman
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless mb-0">
                                            <tr>
                                                <td class="text-muted" style="width: 45%;">
                                                    <i class="bx bx-wallet text-danger me-1"></i>Jumlah Pinjaman
                                                </td>
                                                <td class="fw-bold text-danger" id="detailJumlahPinjaman"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-money-withdraw text-danger me-1"></i>Sisa Pinjaman
                                                </td>
                                                <td class="fw-bold text-danger" id="detailSisaPinjaman"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-calendar-plus text-danger me-1"></i>Tanggal Pengajuan
                                                </td>
                                                <td id="detailTanggalPengajuan"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-calendar-check text-danger me-1"></i>Tanggal Disetujui
                                                </td>
                                                <td id="detailTanggalDisetujui"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-calendar-exclamation text-danger me-1"></i>Batas
                                                    Pengembalian
                                                </td>
                                                <td id="detailBatasPengembalian"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-note text-secondary me-1"></i>Catatan
                                                </td>
                                                <td id="detailCatatan"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi UMKM -->
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow-sm h-100 border-0 card-red-detail">
                                    <div class="card-header bg-gradient-red text-white">
                                        <h6 class="mb-0 fw-bold text-white">
                                            <i class="bx bx-store me-2"></i>Informasi UMKM
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless mb-0">
                                            <tr>
                                                <td class="text-muted" style="width: 45%;">
                                                    <i class="bx bx-buildings text-danger me-1"></i>Nama UMKM
                                                </td>
                                                <td class="fw-bold" id="detailNamaUmkm"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-user text-danger me-1"></i>Nama Pemilik
                                                </td>
                                                <td id="detailNamaPemilik"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-id-card text-danger me-1"></i>No. KTP
                                                </td>
                                                <td id="detailNoKtp"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-cake text-danger me-1"></i>Tempat, Tanggal Lahir
                                                </td>
                                                <td id="detailTtl"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-home text-danger me-1"></i>Alamat Pemilik
                                                </td>
                                                <td id="detailAlamatPemilik"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-map text-secondary me-1"></i>Alamat Usaha
                                                </td>
                                                <td id="detailAlamatUsaha"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <i class="bx bx-category text-danger me-1"></i>Jenis UMKM
                                                </td>
                                                <td><span class="badge bg-danger" id="detailJenisUmkm"></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Riwayat Pengembalian -->
                        <div class="card shadow-sm border-0 card-history-redwhite">
                            <div class="card-header bg-gradient-red-light text-dark">
                                <h6 class="mb-0 fw-bold text-danger">
                                    <i class="bx bx-history me-2"></i>Riwayat Pengembalian
                                </h6>
                            </div>
                            <div class="card-body">
                                <div id="pengembalianContent">
                                    <!-- Will be filled dynamically -->
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
    <script>
        $(document).ready(function() {
            // Variable to store current peminjaman ID
            let currentPeminjamanId = null;

            // Konfigurasi jQuery Validation
            $.validator.setDefaults({
                errorElement: 'small',
                errorClass: 'text-danger',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                }
            });

            // Inisialisasi validasi form
            $("#upsertDataForm").validate({
                rules: {
                    umkm_id: {
                        required: true,
                    },
                    jumlah_pinjaman: {
                        required: true,
                        digits: true,
                        minlength: 4,
                        maxlength: 16
                    },
                    tanggal_pengajuan: {
                        required: true,
                        date: true
                    },
                    catatan: {
                        required: true,
                    },
                },
                messages: {
                    umkm_id: {
                        required: "Nama UMKM wajib diisi",
                    },
                    jumlah_pinjaman: {
                        required: "Jumlah Pinjaman wajib diisi",
                        digits: "Jumlah Pinjaman harus berupa angka",
                        minlength: "Jumlah Pinjaman minimal 4 digit",
                        maxlength: "Jumlah Pinjaman maksimal 16 digit"
                    },
                    tanggal_pengajuan: {
                        required: "Tanggal Pengajuan wajib diisi",
                        date: "Format tanggal tidak valid"
                    },
                    catatan: {
                        required: "Catatan wajib diisi",
                    }
                }
            });

            function getUMKM() {
                $.ajax({
                    url: '/v1/umkm',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let options = '<option value="">Pilih UMKM</option>';
                        if (response.data && response.data.length > 0) {
                            console.log(response)
                            $.each(response.data, function(index, item) {
                                options +=
                                    `<option value="${item.id}">${item.nama_umkm}</option>`;
                            });
                        }
                        $('#umkm_id').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching UMKM:', error);
                    }
                });
            }

            getUMKM();

            // Fungsi untuk format rupiah
            function formatRupiah(angka) {
                if (!angka || angka === 0 || angka === '0') return 'Rp 0';

                const number = parseFloat(angka);
                if (isNaN(number)) return 'Rp 0';

                return 'Rp ' + number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Fungsi untuk format tanggal
            function formatTanggal(tanggal) {
                if (!tanggal || tanggal === '-') return '-';

                const date = new Date(tanggal);
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                return date.toLocaleDateString('id-ID', options);
            }

            // Fungsi untuk mendapatkan badge status dengan warna
            function getStatusBadge(status) {
                let badgeClass = '';
                let statusText = status;

                switch (status.toLowerCase()) {
                    case 'lunas':
                        badgeClass = 'badge bg-success';
                        break;
                    case 'ditolak':
                        badgeClass = 'badge bg-danger';
                        break;
                    case 'disetujui':
                        badgeClass = 'badge bg-primary';
                        break;
                    case 'pending':
                        badgeClass = 'badge bg-warning';
                        break;
                    default:
                        badgeClass = 'badge bg-secondary';
                }

                return `<span class="${badgeClass}">${statusText}</span>`;
            }

            function getData() {
                $.ajax({
                    url: '/v1/peminjaman',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        if ($.fn.DataTable.isDataTable('#table')) {
                            $('#table').DataTable().destroy();
                        }

                        let tableBody = "";

                        if (!response.data || response.data.length === 0) {
                            $("#table tbody").html('');

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
                                    zeroRecords: `
                                <div class="text-center py-4">
                                    <div class="mb-3">
                                        <i class="bx bx-data bx-lg text-muted"></i>
                                    </div>
                                    <h6 class="text-muted">Data Tidak Tersedia</h6>
                                    <p class="text-muted small mb-0">Belum ada data peminjaman yang ditambahkan</p>
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
                                    <h6 class="text-muted">Data Tidak Tersedia</h6>
                                    <p class="text-muted small mb-0">Belum ada data peminjaman yang ditambahkan</p>
                                </div>
                            `
                                },
                                pageLength: 10,
                                lengthMenu: [
                                    [5, 10, 25, 50, -1],
                                    [5, 10, 25, 50, "Semua"]
                                ]
                            });

                            return;
                        }

                        $.each(response.data, function(index, item) {
                            tableBody += "<tr>";
                            tableBody += "<td class='text-center'>" + (index + 1) + "</td>";
                            tableBody += "<td>" + item.umkm.nama_umkm + "</td>";
                            tableBody += "<td>" + formatRupiah(item.jumlah_pinjaman) + "</td>";
                            tableBody += "<td>" + formatRupiah(item.sisa_pinjaman) + "</td>";
                            tableBody += "<td>" + item.tanggal_pengajuan + "</td>";
                            tableBody += "<td class='text-center'>" + (item.tanggal_disetujui ??
                                '-') + "</td>";
                            tableBody += "<td class='text-center'>" + (item
                                .batas_pengembalian ?? '-') + "</td>";
                            tableBody += "<td class='text-center'>" + getStatusBadge(item
                                .status) + "</td>";
                            tableBody += "<td>" + item.catatan + "</td>";

                            tableBody += "<td class='text-center'>";
                            tableBody +=
                                "<button type='button' class='btn btn-outline-primary btn-sm periksa-btn' data-id='" +
                                item.id +
                                "' title='Periksa' style='font-size: 11px; text-transform: lowercase;'><i class='bx bx-search-alt me-1'></i>periksa</button>";
                            tableBody += "</td>";

                            tableBody += "</tr>";
                        });

                        $("#table tbody").html(tableBody);

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
                                zeroRecords: `
                            <div class="text-center py-4">
                                <div class="mb-3">
                                    <i class="bx bx-data bx-lg text-muted"></i>
                                </div>
                                <h6 class="text-muted">Data Tidak Ditemukan</h6>
                                <p class="text-muted small mb-0">Tidak ada data yang sesuai dengan pencarian Anda</p>
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
                                <h6 class="text-muted">Data Tidak Tersedia</h6>
                                <p class="text-muted small mb-0">Belum ada data peminjaman yang ditambahkan</p>
                            </div>
                        `
                            },
                            pageLength: 10,
                            lengthMenu: [
                                [5, 10, 25, 50, -1],
                                [5, 10, 25, 50, "Semua"]
                            ]
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("Gagal mengambil data dari server");

                        if ($.fn.DataTable.isDataTable('#table')) {
                            $('#table').DataTable().destroy();
                        }

                        $("#table tbody").html('');

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
                            pageLength: 10,
                            lengthMenu: [
                                [5, 10, 25, 50, -1],
                                [5, 10, 25, 50, "Semua"]
                            ]
                        });
                    }
                });
            }

            getData();

            // Event handler untuk simpan data
            $(document).on('click', '#simpanData', function(e) {
                e.preventDefault();

                // Validasi form menggunakan jQuery Validation
                if (!$("#upsertDataForm").valid()) {
                    return false;
                }

                let id = $('#id').val();
                let formData = new FormData($('#upsertDataForm')[0]);
                let url = id ? `/v1/peminjaman/update/${id}` : '/v1/peminjaman/create';
                let method = 'POST';

                // Show loading alert
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
                    type: method,
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);

                        // Handle validation errors (422)
                        if (response.code === 422) {
                            let errors = response.errors;
                            let errorMessages = [];

                            $.each(errors, function(key, value) {
                                let $element = $('[name="' + key + '"]');
                                $element.addClass('is-invalid');
                                $element.after('<small class="text-danger">' + value[
                                    0] + '</small>');
                                errorMessages.push(value[0]);
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                html: errorMessages.join('<br>'),
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: 'OK'
                            });
                        }
                        // Handle error status from backend
                        else if (response.status === 'error') {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal Menyimpan',
                                text: response.message ||
                                    'Terjadi kesalahan saat menyimpan data',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: 'OK'
                            });
                        }
                        // Handle success
                        else if (response.status === 'success') {
                            const modalEl = document.getElementById('basicModal');
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) {
                                modal.hide();
                            }

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan',
                                confirmButtonColor: '#28a745',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Reload data or page
                                getData();
                            });
                        }
                        // Handle unexpected response
                        else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan yang tidak terduga',
                                confirmButtonColor: '#dc3545',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);

                        let errorMessage = 'Terjadi kesalahan saat menyimpan data';

                        // Try to parse error response
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseJSON.error) {
                                errorMessage = xhr.responseJSON.error;
                            }
                        } else if (xhr.responseText) {
                            try {
                                const parsedResponse = JSON.parse(xhr.responseText);
                                if (parsedResponse.message) {
                                    errorMessage = parsedResponse.message;
                                }
                            } catch (e) {
                                // If parsing fails, use default message
                                console.error('Failed to parse error response:', e);
                            }
                        }

                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: errorMessage,
                            confirmButtonColor: '#dc3545',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Event handler untuk tombol periksa
            $(document).on('click', '.periksa-btn', function() {
                var id = $(this).data('id');
                currentPeminjamanId = id; // Store current ID

                // Show modal
                var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                detailModal.show();

                // Show loading, hide content
                $('#detailLoading').show();
                $('#detailContent').hide();
                $('#approveBtn').hide();

                // Fetch detail data
                $.ajax({
                    url: '/v1/peminjaman/detail/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        if (response.status === 'success' && response.data) {
                            var data = response.data;

                            // Fill Informasi Peminjaman
                            $('#detailJumlahPinjaman').text(formatRupiah(data.jumlah_pinjaman));
                            $('#detailSisaPinjaman').text(formatRupiah(data.sisa_pinjaman));
                            $('#detailTanggalPengajuan').text(formatTanggal(data
                                .tanggal_pengajuan));
                            $('#detailTanggalDisetujui').text(formatTanggal(data
                                .tanggal_disetujui));
                            $('#detailBatasPengembalian').text(formatTanggal(data
                                .batas_pengembalian));
                            $('#detailCatatan').text(data.catatan || '-');

                            // Status Badge & Show Approve Button if Pending
                            var statusBadge = '';
                            switch (data.status.toLowerCase()) {
                                case 'lunas':
                                    statusBadge =
                                        '<span class="badge bg-success fs-5 px-4 py-2">Lunas</span>';
                                    $('#approveBtn').hide();
                                    break;
                                case 'ditolak':
                                    statusBadge =
                                        '<span class="badge bg-danger fs-5 px-4 py-2">Ditolak</span>';
                                    $('#approveBtn').hide();
                                    break;
                                case 'disetujui':
                                    statusBadge =
                                        '<span class="badge bg-danger fs-5 px-4 py-2">Disetujui</span>';
                                    $('#approveBtn').hide();
                                    break;
                                case 'pending':
                                    statusBadge =
                                        '<span class="badge bg-warning fs-5 px-4 py-2">Pending</span>';
                                    $('#approveBtn')
                                .show(); // Show approve button for pending status
                                    break;
                                default:
                                    statusBadge =
                                        '<span class="badge bg-secondary fs-5 px-4 py-2">' +
                                        data.status + '</span>';
                                    $('#approveBtn').hide();
                            }
                            $('#detailStatusBadge').html(statusBadge);

                            // Fill Informasi UMKM
                            if (data.umkm) {
                                $('#detailNamaUmkm').text(data.umkm.nama_umkm || '-');
                                $('#detailNamaPemilik').text(data.umkm.nama_pemilik || '-');
                                $('#detailNoKtp').text(data.umkm.no_ktp || '-');

                                var ttl = (data.umkm.tempat_lahir || '') + ', ' + formatTanggal(
                                    data.umkm.tanggal_lahir);
                                $('#detailTtl').text(ttl);

                                $('#detailAlamatPemilik').text(data.umkm.alamat_pemilik || '-');
                                $('#detailAlamatUsaha').text(data.umkm.alamat_usaha || '-');
                                $('#detailJenisUmkm').text(data.umkm.jenis_umkm || '-');
                            }

                            // Fill Riwayat Pengembalian
                            var pengembalianHtml = '';
                            if (data.pengembalian && data.pengembalian.length > 0) {
                                pengembalianHtml =
                                    '<div class="table-responsive"><table class="table table-striped table-hover table-redwhite">';
                                pengembalianHtml += '<thead class="table-light">';
                                pengembalianHtml += '<tr>';
                                pengembalianHtml += '<th>No</th>';
                                pengembalianHtml += '<th>Jumlah Pengembalian</th>';
                                pengembalianHtml += '<th>Tanggal Pengembalian</th>';
                                pengembalianHtml += '</tr>';
                                pengembalianHtml += '</thead>';
                                pengembalianHtml += '<tbody>';

                                $.each(data.pengembalian, function(index, item) {
                                    pengembalianHtml += '<tr>';
                                    pengembalianHtml += '<td>' + (index + 1) + '</td>';
                                    pengembalianHtml +=
                                        '<td class="fw-bold text-danger">' +
                                        formatRupiah(item.jumlah_pengembalian) +
                                        '</td>';
                                    pengembalianHtml += '<td>' + formatTanggal(item
                                        .tanggal_pengembalian) + '</td>';
                                    pengembalianHtml += '</tr>';
                                });

                                pengembalianHtml += '</tbody>';
                                pengembalianHtml += '</table></div>';
                            } else {
                                pengembalianHtml = `
                                    <div class="text-center py-4">
                                        <i class="bx bx-info-circle bx-lg text-muted"></i>
                                        <p class="text-muted mt-2 mb-0">Belum ada riwayat pengembalian</p>
                                    </div>
                                `;
                            }

                            $('#pengembalianContent').html(pengembalianHtml);

                            // Hide loading, show content
                            $('#detailLoading').hide();
                            $('#detailContent').fadeIn();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Gagal mengambil detail data!',
                            });
                            detailModal.hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching detail:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Terjadi kesalahan saat mengambil detail data',
                        });
                        detailModal.hide();
                    }
                });
            });

            // Event handler untuk tombol approve dengan SweetAlert
            $(document).on('click', '#approveBtn', function() {
                if (!currentPeminjamanId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'ID Peminjaman tidak ditemukan!',
                    });
                    return;
                }

                // SweetAlert Confirmation
                Swal.fire({
                    title: 'Konfirmasi Persetujuan',
                    text: 'Apakah Anda yakin ingin menyetujui peminjaman ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bx bx-check-circle me-1"></i> Ya, Setujui!',
                    cancelButtonText: '<i class="bx bx-x me-1"></i> Batal',
                    reverseButtons: true,
                    customClass: {
                        confirmButton: 'btn btn-success btn-lg px-4',
                        cancelButton: 'btn btn-secondary btn-lg px-4'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Memproses...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Disable approve button
                        $('#approveBtn').prop('disabled', true);

                        $.ajax({
                            url: '/v1/peminjaman/approve/' + currentPeminjamanId,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                console.log(response);

                                if (response.status === 'success') {
                                    // Close detail modal
                                    var detailModal = bootstrap.Modal.getInstance(
                                        document.getElementById('detailModal'));
                                    if (detailModal) {
                                        detailModal.hide();
                                    }

                                    // Show success message
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Peminjaman berhasil disetujui',
                                        confirmButtonColor: '#28a745',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Reload table data
                                        getData();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message ||
                                            'Gagal menyetujui peminjaman',
                                        confirmButtonColor: '#dc3545',
                                    });
                                    $('#approveBtn').prop('disabled', false);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error approving peminjaman:', error);

                                let errorMessage =
                                    'Terjadi kesalahan saat menyetujui peminjaman';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: errorMessage,
                                    confirmButtonColor: '#dc3545',
                                });

                                // Re-enable button
                                $('#approveBtn').prop('disabled', false);
                            }
                        });
                    }
                });
            });
        });
    </script>

    <style>
        .swal2-container {
            z-index: 10000 !important;
        }

        /* Style untuk field yang invalid */
        .is-invalid {
            border-color: #dc3545 !important;
            padding-right: calc(1.5em + 0.75rem);
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        /* Style untuk pesan error */
        small.text-danger {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.875rem;
        }

        /* ===== MODAL DETAIL PEMINJAMAN - RED WHITE THEME ONLY ===== */
        
        /* Modal Content Red White */
        #detailModal .detail-modal-redwhite {
            border: none;
            box-shadow: 0 0.5rem 2rem rgba(220, 53, 69, 0.2);
        }

        /* Modal Header Red */
        #detailModal .bg-gradient-red {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        /* Cards inside modal detail */
        #detailModal .card {
            border: none;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        #detailModal .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(220, 53, 69, 0.15);
            transform: translateY(-3px);
        }

        #detailModal .card-header {
            border-bottom: none;
        }

        /* Red Card Theme */
        #detailModal .card-red-detail .bg-gradient-red {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        /* White Card Theme */
        #detailModal .card-white-detail .card-header {
            background: #ffffff;
        }

        #detailModal .card-white-detail .border-red-bottom {
            border-bottom: 3px solid #dc3545 !important;
        }

        /* History Card Theme */
        #detailModal .card-history-redwhite .bg-gradient-red-light {
            background: linear-gradient(135deg, #ffe5e8 0%, #fff5f5 100%);
            border-bottom: 2px solid #dc3545;
        }

        /* Table inside modal */
        #detailModal .table-borderless td {
            padding: 0.875rem 0.5rem;
            vertical-align: top;
        }

        #detailModal .table-borderless tr {
            border-bottom: 1px solid #ffe0e0;
        }

        #detailModal .table-borderless tr:last-child {
            border-bottom: none;
        }

        #detailModal .badge {
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            padding: 0.5rem 1rem;
        }

        /* Status Card Red White */
        #detailModal .status-card-redwhite {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe0e0 100%);
            border-radius: 15px;
            transition: all 0.3s ease;
            border: 2px solid #ffcccc;
        }

        #detailModal .status-card-redwhite:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1.5rem rgba(220, 53, 69, 0.2);
            border-color: #dc3545;
        }

        #detailModal .status-icon-wrapper-redwhite {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0.25rem 0.5rem rgba(220, 53, 69, 0.15);
            border: 2px solid #dc3545;
        }

        #detailModal .status-icon-wrapper-redwhite i {
            font-size: 2rem;
            color: #dc3545;
        }

        /* Approve Button Red */
        #detailModal #approveBtn {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
            padding: 0.75rem 2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        #detailModal #approveBtn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(220, 53, 69, 0.5);
        }

        #detailModal #approveBtn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Modal Footer Red White */
        #detailModal .bg-light-red {
            border-top: 1px solid #ffe0e0;
            padding: 1.25rem;
            background: #fff5f5;
        }

        /* Table Striped Red White in modal */
        #detailModal .table-redwhite tbody tr:nth-of-type(odd) {
            background-color: rgba(220, 53, 69, 0.05);
        }

        #detailModal .table-redwhite tbody tr:hover {
            background-color: rgba(220, 53, 69, 0.1);
        }

        /* Loading spinner red */
        #detailModal .spinner-border.text-danger {
            width: 3rem;
            height: 3rem;
        }

        /* Responsive for modal */
        @media (max-width: 768px) {
            #detailModal .status-card-redwhite .d-flex {
                flex-direction: column;
                text-align: center;
            }

            #detailModal #approveBtn {
                width: 100%;
                margin-top: 1rem;
            }
        }
    </style>
@endsection