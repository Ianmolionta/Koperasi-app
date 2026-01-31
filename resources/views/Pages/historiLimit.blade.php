@extends('Layouts.base')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><i class="menu-icon tf-icons bx bx-history"></i></span>
        Histori Limit</h4>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Data Peminjaman</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama UMKM</th>
                            <th>Limit Sebelumnya</th>
                            <th>Limit Baru</th>
                            <th>Perubahan</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody> 
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function getData() {
                $.ajax({
                    url: '/v1/histori-limit',
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
                            tableBody += "<td>" + item.limit_sebelumnya + "</td>";
                            tableBody += "<td>" + item.limit_baru + "</td>";
                            tableBody += "<td>" + (item.perubahan ?? '-') + "</td>";
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