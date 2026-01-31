@extends('Layouts.Base')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> <i class="menu-icon tf-icons bx bx-store"></i></span>
        UMKM</h4>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data UMKM</h5>
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
                            <th>Nama Pemilik</th>
                            <th>Alamat Usaha</th>
                            <th>Alamat Pemilik</th>
                            <th>Kategori UMKM</th>
                            <th>Jenis UMKM</th>
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
                    <h5 class="modal-title" id="modalTitle">Tambah UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="upsertDataForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id" name="id" />

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="users_name" class="form-label">Penanggung Jawab</label>
                                <input type="text" id="users_name" class="form-control" readonly
                                    style="background-color: #f8f9fa;" />
                                <input type="hidden" id="users_id" name="users_id" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_umkm" class="form-label">Nama UMKM <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nama_umkm" name="nama_umkm" class="form-control"
                                    placeholder="Masukan Nama UMKM" />
                                <small class="text-danger" id="nama_umkm-error"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_pemilik" class="form-label">Nama Pemilik <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="nama_pemilik" name="nama_pemilik" class="form-control"
                                    placeholder="Masukan Nama Pemilik" />
                                <small class="text-danger" id="nama_pemilik-error"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="no_ktp" class="form-label">No KTP <span class="text-danger">*</span></label>
                                <input type="text" id="no_ktp" name="no_ktp" class="form-control"
                                    placeholder="Masukan No KTP" maxlength="16" />
                                <small class="text-danger" id="no_ktp-error"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="no_kk" class="form-label">No KK <span class="text-danger">*</span></label>
                                <input type="text" id="no_kk" name="no_kk" class="form-control"
                                    placeholder="Masukan No KK" maxlength="16" />
                                <small class="text-danger" id="no_kk-error"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control"
                                    placeholder="Masukan Tempat Lahir" />
                                <small class="text-danger" id="tempat_lahir-error"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                        class="text-danger">*</span></label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" />
                                <small class="text-danger" id="tanggal_lahir-error"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori_umkm_id" class="form-label">Kategori UMKM <span
                                        class="text-danger">*</span></label>
                                <select id="kategori_umkm_id" name="kategori_umkm_id" class="form-select">
                                    <option value="">Pilih Kategori UMKM</option>
                                </select>
                                <small class="text-danger" id="kategori_umkm_id-error"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jenis_umkm" class="form-label">Jenis UMKM <span
                                        class="text-danger">*</span></label>
                                <input type="text" id="jenis_umkm" name="jenis_umkm" class="form-control"
                                    placeholder="Masukan Jenis UMKM" />
                                <small class="text-danger" id="jenis_umkm-error"></small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="alamat_pemilik" class="form-label">Alamat Pemilik <span
                                        class="text-danger">*</span></label>
                                <textarea id="alamat_pemilik" name="alamat_pemilik" class="form-control" placeholder="Masukan Alamat Pemilik"
                                    rows="1"></textarea>
                                <small class="text-danger" id="alamat_pemilik-error"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="alamat_usaha" class="form-label">Alamat Usaha <span
                                        class="text-danger">*</span></label>
                                <textarea id="alamat_usaha" name="alamat_usaha" class="form-control" placeholder="Masukan Alamat Usaha"
                                    rows="2"></textarea>
                                <small class="text-danger" id="alamat_usaha-error"></small>
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

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-red text-white">
                    <h5 class="modal-title text-white">
                        <i class="bx bx-detail me-2"></i>Detail UMKM
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Penanggung Jawab</label>
                            <p class="form-control-static" id="detail_users_name"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Nama UMKM</label>
                            <p class="form-control-static" id="detail_nama_umkm"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Nama Pemilik</label>
                            <p class="form-control-static" id="detail_nama_pemilik"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">No KTP</label>
                            <p class="form-control-static" id="detail_no_ktp"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">No KK</label>
                            <p class="form-control-static" id="detail_no_kk"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Tempat, Tanggal Lahir</label>
                            <p class="form-control-static" id="detail_ttl"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Kategori UMKM</label>
                            <p class="form-control-static" id="detail_kategori_umkm"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Jenis UMKM</label>
                            <p class="form-control-static" id="detail_jenis_umkm"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Alamat Pemilik</label>
                            <p class="form-control-static" id="detail_alamat_pemilik"></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-muted">Alamat Usaha</label>
                            <p class="form-control-static" id="detail_alamat_usaha"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
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

            // Custom method untuk validasi NIK (16 digit)
            $.validator.addMethod("nik", function(value, element) {
                return this.optional(element) || /^\d{16}$/.test(value);
            }, "NIK harus 16 digit angka");

            // Inisialisasi validasi form
            $("#upsertDataForm").validate({
                rules: {
                    nama_umkm: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    nama_pemilik: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    no_ktp: {
                        required: true,
                        nik: true,
                        digits: true,
                        minlength: 16,
                        maxlength: 16
                    },
                    no_kk: {
                        required: true,
                        nik: true,
                        digits: true,
                        minlength: 16,
                        maxlength: 16
                    },
                    tempat_lahir: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    tanggal_lahir: {
                        required: true,
                        date: true
                    },
                    kategori_umkm_id: {
                        required: true
                    },
                    alamat_pemilik: {
                        required: true,
                        minlength: 10,
                        maxlength: 500
                    },
                    alamat_usaha: {
                        required: true,
                        minlength: 10,
                        maxlength: 500
                    }
                },
                messages: {
                    nama_umkm: {
                        required: "Nama UMKM wajib diisi",
                        minlength: "Nama UMKM minimal 3 karakter",
                        maxlength: "Nama UMKM maksimal 255 karakter"
                    },
                    nama_pemilik: {
                        required: "Nama Pemilik wajib diisi",
                        minlength: "Nama Pemilik minimal 3 karakter",
                        maxlength: "Nama Pemilik maksimal 255 karakter"
                    },
                    no_ktp: {
                        required: "No KTP wajib diisi",
                        digits: "No KTP harus berupa angka",
                        minlength: "No KTP harus 16 digit",
                        maxlength: "No KTP harus 16 digit"
                    },
                    no_kk: {
                        required: "No KK wajib diisi",
                        digits: "No KK harus berupa angka",
                        minlength: "No KK harus 16 digit",
                        maxlength: "No KK harus 16 digit"
                    },
                    tempat_lahir: {
                        required: "Tempat Lahir wajib diisi",
                        minlength: "Tempat Lahir minimal 3 karakter",
                        maxlength: "Tempat Lahir maksimal 100 karakter"
                    },
                    tanggal_lahir: {
                        required: "Tanggal Lahir wajib diisi",
                        date: "Format tanggal tidak valid"
                    },
                    kategori_umkm_id: {
                        required: "Kategori UMKM wajib dipilih"
                    },
                    alamat_pemilik: {
                        required: "Alamat Pemilik wajib diisi",
                        minlength: "Alamat Pemilik minimal 10 karakter",
                        maxlength: "Alamat Pemilik maksimal 500 karakter"
                    },
                    alamat_usaha: {
                        required: "Alamat Usaha wajib diisi",
                        minlength: "Alamat Usaha minimal 10 karakter",
                        maxlength: "Alamat Usaha maksimal 500 karakter"
                    }
                }
            });

            // Fungsi untuk mendapatkan data user yang sedang login
            function getCurrentUser() {
                $.ajax({
                    url: '/v1/users/',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                            const user = response.data[0];
                            $('#users_name').val(user.nama ?? '');
                            $('#users_id').val(user.id ?? '');
                        } else {
                            console.error('Data user tidak ditemukan');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching current user:', error);
                        console.error('XHR:', xhr);
                    }
                });
            }

            // Fungsi untuk mengambil data kategori UMKM
            function getKategoriUMKM() {
                $.ajax({
                    url: '/v1/kategori-Umkm',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let options = '<option value="">Pilih Kategori UMKM</option>';
                        if (response.data && response.data.length > 0) {
                            console.log(response)
                            $.each(response.data, function(index, item) {
                                options +=
                                    `<option value="${item.id}">${item.nama_kategori}</option>`;
                            });
                        }
                        $('#kategori_umkm_id').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching kategori UMKM:', error);
                    }
                });
            }

            getCurrentUser();
            getKategoriUMKM();

            function getData() {
                $.ajax({
                    url: '/v1/umkm',
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
                                            <p class="text-muted small mb-0">Belum ada data UMKM yang ditambahkan</p>
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
                                            <p class="text-muted small mb-0">Belum ada data UMKM yang ditambahkan</p>
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
                            tableBody += "<td>" + item.nama_umkm + "</td>";
                            tableBody += "<td>" + item.nama_pemilik + "</td>";
                            tableBody += "<td>" + item.alamat_usaha + "</td>";
                            tableBody += "<td>" + item.alamat_pemilik + "</td>";
                            tableBody += "<td>" + (item.kategori_umkm ? item.kategori_umkm
                                .nama_kategori : '-') + "</td>";
                            tableBody += "<td>" + item.jenis_umkm + "</td>";

                            tableBody += "<td class='text-center'>";
                            tableBody +=
                                "<button type='button' class='btn btn-outline-info btn-sm detail-btn me-1' data-id='" +
                                item.id +
                                "' title='Detail'><i class='bx bx-show'></i></button>";
                            tableBody +=
                                "<button type='button' class='btn btn-outline-primary btn-sm edit-btn me-1' data-id='" +
                                item.id +
                                "' title='Edit'><i class='bx bx-pencil'></i></button>";
                            tableBody +=
                                "<button type='button' class='btn btn-outline-danger btn-sm delete-confirm' data-id='" +
                                item.id +
                                "' title='Hapus'><i class='bx bx-trash'></i></button>";
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
                                        <p class="text-muted small mb-0">Belum ada data UMKM yang ditambahkan</p>
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

            // Event handler untuk tombol detail
            $(document).on('click', '.detail-btn', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: `/v1/umkm/get/${id}`,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.data) {
                            const data = response.data;

                            $('#detail_users_name').text(data.user ? data.user?.nama : '-');
                            $('#detail_nama_umkm').text(data.nama_umkm || '-');
                            $('#detail_nama_pemilik').text(data.nama_pemilik || '-');
                            $('#detail_no_ktp').text(data.no_ktp || '-');
                            $('#detail_no_kk').text(data.no_kk || '-');
                            $('#detail_ttl').text((data.tempat_lahir || '-') + ', ' + (data
                                .tanggal_lahir || '-'));
                            $('#detail_kategori_umkm').text(data.kategori_umkm ? data
                                .kategori_umkm.nama_kategori : '-');
                            $('#detail_jenis_umkm').text(data.jenis_umkm || '-');
                            $('#detail_alamat_pemilik').text(data.alamat_pemilik || '-');
                            $('#detail_alamat_usaha').text(data.alamat_usaha || '-');

                            const modalEl = document.getElementById('detailModal');
                            const modal = new bootstrap.Modal(modalEl);
                            modal.show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching detail data:', error);
                        alert('Gagal mengambil detail data');
                    }
                });
            });

            // Event handler untuk simpan data
            $(document).on('click', '#simpanData', function(e) {
                e.preventDefault();

                // Validasi form menggunakan jQuery Validation
                if (!$("#upsertDataForm").valid()) {
                    return false;
                }

                let id = $('#id').val();
                let formData = new FormData($('#upsertDataForm')[0]);
                let url = id ? `/v1/umkm/update/${id}` : '/v1/umkm/create';
                let method = 'POST';

                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.code === 422) {
                            let errors = response.errors;
                            $.each(errors, function(key, value) {
                                // Tampilkan error dari server jika ada
                                let $element = $('[name="' + key + '"]');
                                $element.addClass('is-invalid');
                                $element.after('<small class="text-danger">' + value[
                                    0] + '</small>');
                            });
                        } else if (response.status === 'success') {
                            const modalEl = document.getElementById('basicModal');
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) {
                                modal.hide();
                            }

                            alertSuccess('success', 'Data berhasil disimpan');
                            realoadBrowser();
                        } else {
                            alertError();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alertError();
                    }
                });
            });

            // Event handler untuk edit
            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: `/v1/umkm/get/${id}`,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        const modalEl = document.getElementById('basicModal');
                        const modal = new bootstrap.Modal(modalEl);

                        $('#modalTitle').text('Edit UMKM');

                        modal.show();

                        $('#id').val(response.data.id);
                        $('#users_id').val(response.data.users_id);
                        $('#users_name').val(response.data.user?.nama ?? '');
                        $('#nama_umkm').val(response.data.nama_umkm);
                        $('#nama_pemilik').val(response.data.nama_pemilik);
                        $('#no_ktp').val(response.data.no_ktp);
                        $('#no_kk').val(response.data.no_kk);
                        $('#tempat_lahir').val(response.data.tempat_lahir);
                        $('#tanggal_lahir').val(response.data.tanggal_lahir);
                        $('#alamat_pemilik').val(response.data.alamat_pemilik);
                        $('#alamat_usaha').val(response.data.alamat_usaha);
                        $('#kategori_umkm_id').val(response.data.kategori_umkm_id);
                        $('#jenis_umkm').val(response.data.jenis_umkm);

                        // Reset validasi setelah populate data
                        $("#upsertDataForm").validate().resetForm();
                        $('.is-invalid').removeClass('is-invalid');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data for edit:', error);
                    }
                });
            });

            // Fungsi untuk delete data
            function deleteDataById(id) {
                if (!id) {
                    console.error('ID tidak valid');
                    return;
                }

                $.ajax({
                    type: 'DELETE',
                    url: `/v1/umkm/delete/${id}`,
                    success: function(response) {
                        console.log(response);

                        if (response.status === 'success') {
                            alertSuccess('Berhasil', 'Data berhasil dihapus');
                            realoadBrowser();
                        } else {
                            alertError('Gagal', 'Data gagal dihapus');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alertError();
                    }
                });
            }

            // Event handler untuk delete
            $(document).on('click', '.delete-confirm', function() {
                const id = $(this).data('id');

                alertConfirm(
                    'Apakah Anda yakin ingin menghapus data?',
                    function() {
                        deleteDataById(id);
                    }
                );
            });

            // Reset modal ketika ditutup
            $('#basicModal').on('hidden.bs.modal', function() {
                $('#upsertDataForm')[0].reset();
                $('#id').val('');
                $('#modalTitle').text('Tambah UMKM');

                // Reset validasi jQuery
                $("#upsertDataForm").validate().resetForm();
                $('.is-invalid').removeClass('is-invalid');
                $('.text-danger').remove();

                getCurrentUser();
            });

            // Reset modal ketika dibuka untuk tambah data
            $('#basicModal').on('show.bs.modal', function(e) {
                if (!$(e.relatedTarget).hasClass('edit-btn')) {
                    $('#modalTitle').text('Tambah UMKM');
                    getCurrentUser();
                }
            });
        })
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

        #detailModal .bg-gradient-red {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }
    </style>
@endsection
