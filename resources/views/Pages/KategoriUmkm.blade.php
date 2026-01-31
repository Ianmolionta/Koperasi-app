@extends('Layouts.Base')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> <i class="menu-icon tf-icons bx bx-purchase-tag"></i></span>
        Kategori UMKM</h4>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data Kategori UMKM</h5>
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
    <div class="col-lg-4 col-md-6">
        <div class="mt-3">
            <!-- Button trigger modal -->

            <!-- Modal -->
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
                                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                                        <input type="text" id="nama_kategori" name="nama_kategori" class="form-control"
                                            placeholder="Masukan Nama Kategori" />
                                        <small class="text-danger" id="nama_kategori-error"></small>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary" id="simpanData">Save changes</button>
                        </div>
                    </div>
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

            // Inisialisasi validasi form
            $("#upsertDataForm").validate({
                rules: {
                    nama_kategori: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    }
                },
                messages: {
                    nama_kategori: {
                        required: "Nama Kategori wajib diisi",
                        minlength: "Nama Kategori minimal 3 karakter",
                        maxlength: "Nama Kategori maksimal 255 karakter"
                    }
                }
            });

            function getData() {
                $.ajax({
                    url: '/v1/kategori-Umkm',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        // Destroy existing DataTable if it exists
                        if ($.fn.DataTable.isDataTable('#table')) {
                            $('#table').DataTable().destroy();
                        }

                        let tableBody = "";

                        // Cek apakah data kosong atau tidak ada
                        if (!response.data || response.data.length === 0) {
                            $("#table tbody").html('');

                            // Initialize DataTable untuk data kosong
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
                                            <p class="text-muted small mb-0">Belum ada data kategori yang ditambahkan</p>
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
                                            <p class="text-muted small mb-0">Belum ada data kategori yang ditambahkan</p>
                                        </div>
                                    `
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
                                lengthMenu: [
                                    [5, 10, 25, 50, -1],
                                    [5, 10, 25, 50, "Semua"]
                                ]
                            });

                            return;
                        }

                        // Jika ada data, generate rows
                        $.each(response.data, function(index, item) {
                            tableBody += "<tr>";
                            tableBody += "<td class='text-center'>" + (index + 1) + "</td>";
                            tableBody += "<td>" + item.nama_kategori + "</td>";

                            tableBody += "<td class='text-center'>";
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

                        // Initialize DataTable with improved settings
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
                                        <p class="text-muted small mb-0">Belum ada data kategori yang ditambahkan</p>
                                    </div>
                                `
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
                            lengthMenu: [
                                [5, 10, 25, 50, -1],
                                [5, 10, 25, 50, "Semua"]
                            ]
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("Gagal mengambil data dari server");

                        // Destroy existing DataTable if it exists
                        if ($.fn.DataTable.isDataTable('#table')) {
                            $('#table').DataTable().destroy();
                        }

                        $("#table tbody").html('');

                        // Initialize DataTable dengan pesan error
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
                let url = id ? `/v1/kategori-Umkm/update/${id}` : '/v1/kategori-Umkm/create';
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
                            // Tutup modal sebelum menampilkan alert
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
                    url: `/v1/kategori-Umkm/get/${id}`,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        const modalEl = document.getElementById('basicModal');
                        const modal = new bootstrap.Modal(modalEl);

                        // Ubah judul modal
                        $('#exampleModalLabel1').text('Edit Kategori UMKM');

                        modal.show();

                        // Populate form fields with existing data
                        $('#id').val(response.data.id);
                        $('#nama_kategori').val(response.data.nama_kategori);

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
                    url: `/v1/kategori-Umkm/delete/${id}`,
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
                $('#exampleModalLabel1').text('Tambah Kategori UMKM');

                // Reset validasi jQuery
                $("#upsertDataForm").validate().resetForm();
                $('.is-invalid').removeClass('is-invalid');
                $('.text-danger').remove();
            });

            // Reset modal ketika dibuka untuk tambah data
            $('#basicModal').on('show.bs.modal', function(e) {
                // Cek apakah ini bukan dari tombol edit
                if (!$(e.relatedTarget).hasClass('edit-btn')) {
                    $('#exampleModalLabel1').text('Tambah Kategori UMKM');
                }
            });
        })
    </script>

    <style>
        /* Fix untuk navbar tetap gelap saat SweetAlert muncul */
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
    </style>
@endsection
