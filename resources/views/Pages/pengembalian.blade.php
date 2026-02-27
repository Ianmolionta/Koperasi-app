@extends('Layouts.Base')
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <!-- Header Section -->
                <div class="mb-4">
                    <h3 class="fw-bold text-danger mb-2">
                        <i class="bx bx-money-withdraw me-2"></i>Form Pengembalian Pinjaman
                    </h3>
                    <p class="text-muted">Kelola pengembalian pinjaman UMKM dengan mudah</p>
                </div>

                <!-- Main Card -->
                <div class="card main-card shadow-lg border-0 mb-4">
                    <!-- Step Indicator -->
                    <div class="card-header bg-gradient-red text-white border-0 p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="mb-1 fw-bold text-white">
                                    <i class="bx bx-select-multiple me-2"></i>Pilih UMKM
                                </h5>
                                <small class="opacity-75">Langkah 1: Pilih UMKM yang akan melakukan pengembalian</small>
                            </div>
                            <div class="step-badge">1/2</div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Select UMKM Section -->
                        <div class="select-umkm-section">
                            <label for="selectUmkm" class="form-label fw-semibold mb-3">
                                <i class="bx bx-building-house text-danger me-2"></i>
                                Nama UMKM <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-lg select-umkm" id="selectUmkm" name="umkm_id">
                                <option value="">🔍 Pilih UMKM yang akan melakukan pengembalian...</option>
                            </select>
                            <small class="text-danger" id="selectUmkm-error"></small>
                        </div>

                        <!-- Info Container (Hidden by default) -->
                        <div id="infoContainer" style="display: none;">
                            <div class="separator my-4">
                                <div class="separator-line"></div>
                                <div class="separator-text">Informasi Peminjaman</div>
                                <div class="separator-line"></div>
                            </div>

                            <!-- Info Cards Grid -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="info-card info-card-red">
                                        <div class="info-card-icon">
                                            <i class="bx bx-store"></i>
                                        </div>
                                        <div class="info-card-content">
                                            <small class="info-card-label">Nama UMKM</small>
                                            <h6 class="info-card-value" id="namaUmkm">-</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-card info-card-white">
                                        <div class="info-card-icon">
                                            <i class="bx bx-wallet"></i>
                                        </div>
                                        <div class="info-card-content">
                                            <small class="info-card-label">Total Pinjaman</small>
                                            <h6 class="info-card-value" id="totalPinjaman">-</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-card info-card-white">
                                        <div class="info-card-icon">
                                            <i class="bx bx-money"></i>
                                        </div>
                                        <div class="info-card-content">
                                            <small class="info-card-label">Sisa Pinjaman</small>
                                            <h6 class="info-card-value" id="sisaPinjaman">-</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-card info-card-red">
                                        <div class="info-card-icon">
                                            <i class="bx bx-calendar-check"></i>
                                        </div>
                                        <div class="info-card-content">
                                            <small class="info-card-label">Tanggal Berlaku</small>
                                            <h6 class="info-card-value" id="tanggalBerlaku">-</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ===== JADWAL CICILAN SECTION ===== -->
                            <div class="separator my-4">
                                <div class="separator-line"></div>
                                <div class="separator-text">Jadwal Cicilan &amp; Bunga</div>
                                <div class="separator-line"></div>
                            </div>

                            <div class="jadwal-cicilan-card">
                                <!-- Summary Row -->
                                <div class="row g-3 mb-4" id="jadwal-summary">
                                    <div class="col-6 col-md-3">
                                        <div class="jadwal-summary-box">
                                            <div class="jadwal-summary-icon bg-red-soft">
                                                <i class="bx bx-wallet"></i>
                                            </div>
                                            <div class="jadwal-summary-label">Pokok Pinjaman</div>
                                            <div class="jadwal-summary-value" id="js-pokok">Rp 0</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="jadwal-summary-box">
                                            <div class="jadwal-summary-icon bg-warning-soft">
                                                <i class="bx bx-trending-up"></i>
                                            </div>
                                            <div class="jadwal-summary-label">Total Bunga (2%)</div>
                                            <div class="jadwal-summary-value text-warning" id="js-bunga">Rp 0</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="jadwal-summary-box">
                                            <div class="jadwal-summary-icon bg-red-soft">
                                                <i class="bx bx-money"></i>
                                            </div>
                                            <div class="jadwal-summary-label">Total Pengembalian</div>
                                            <div class="jadwal-summary-value text-danger" id="js-total">Rp 0</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="jadwal-summary-box jadwal-summary-box-highlight">
                                            <div class="jadwal-summary-icon bg-red-solid">
                                                <i class="bx bx-calendar"></i>
                                            </div>
                                            <div class="jadwal-summary-label">Cicilan / Bulan</div>
                                            <div class="jadwal-summary-value text-danger" id="js-perbulan">Rp 0</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabel Jadwal Per Bulan -->
                                <div class="table-responsive jadwal-table-wrap">
                                    <table class="table table-hover jadwal-table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Bulan</th>
                                                <th class="text-end">Pokok Cicilan</th>
                                                <th class="text-end">Bunga (0,5%/bln)</th>
                                                <th class="text-end">Total Cicilan</th>
                                                <th class="text-end">Saldo Tersisa</th>
                                            </tr>
                                        </thead>
                                        <tbody id="jadwal-tbody">
                                            <!-- diisi oleh JS -->
                                        </tbody>
                                        <tfoot>
                                            <tr class="jadwal-tfoot-row">
                                                <td class="fw-bold">Jumlah</td>
                                                <td class="text-end fw-bold" id="jadwal-foot-pokok">Rp 0</td>
                                                <td class="text-end fw-bold text-warning" id="jadwal-foot-bunga">Rp 0</td>
                                                <td class="text-end fw-bold text-danger" id="jadwal-foot-total">Rp 0</td>
                                                <td class="text-end text-muted">—</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- ===== END JADWAL CICILAN ===== -->
                        </div>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="card form-card shadow-lg border-0" id="formCard" style="display: none;">
                    <div class="card-header bg-gradient-white-red text-dark border-0 p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="mb-1 fw-bold text-danger">
                                    <i class="bx bx-edit-alt me-2"></i>Form Pengembalian
                                </h5>
                                <small class="text-muted">Langkah 2: Masukkan detail pengembalian pinjaman</small>
                            </div>
                            <div class="step-badge-red">2/2</div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form id="pengembalianForm">
                            @csrf
                            <input type="hidden" id="peminjamanId" name="peminjaman_id" />
                            <!-- Jumlah Pengembalian -->
                            <div class="mb-4">
                                <label for="jumlahPengembalian" class="form-label fw-semibold">
                                    <i class="bx bx-money text-danger me-2"></i>
                                    Jumlah Pengembalian <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light">
                                        <i class="bx bx-dollar text-danger"></i>
                                    </span>
                                    <input type="text" class="form-control form-control-lg money-input"
                                        id="jumlahPengembalian" name="jumlah_pengembalian" placeholder="0" />
                                </div>
                                <small class="text-danger" id="jumlahPengembalian-error"></small>
                                <div class="form-text mt-2">
                                    <i class="bx bx-info-circle me-1"></i>
                                    Cicilan bulanan (pokok + bunga): <strong id="infoPerbulan"
                                        class="text-danger">-</strong>
                                    &nbsp;|&nbsp;
                                    Maksimal pengembalian: <strong id="maxPengembalian" class="text-danger">-</strong>
                                </div>
                            </div>

                            <!-- Tanggal Pengembalian -->
                            <div class="mb-4">
                                <label for="tanggalPengembalian" class="form-label fw-semibold">
                                    <i class="bx bx-calendar text-danger me-2"></i>
                                    Tanggal Pengembalian <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light">
                                        <i class="bx bx-calendar-event text-danger"></i>
                                    </span>
                                    <input type="date" class="form-control form-control-lg" id="tanggalPengembalian"
                                        name="tanggal_pengembalian" />
                                </div>
                                <small class="text-danger" id="tanggalPengembalian-error"></small>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label for="keterangan" class="form-label fw-semibold">
                                    <i class="bx bx-message-square-detail text-secondary me-2"></i>
                                    Keterangan (Opsional)
                                </label>
                                <textarea class="form-control form-control-lg" id="keterangan" name="keterangan" rows="4"
                                    placeholder="Tambahkan catatan atau keterangan pengembalian..."></textarea>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-3 mt-4">
                                <button type="submit" class="btn btn-danger btn-lg shadow-sm btn-submit" id="btnSubmit">
                                    <i class="bx bx-check-circle me-2"></i>
                                    Simpan Pengembalian
                                </button>
                                <a href="/peminjaman" class="btn btn-outline-secondary btn-lg">
                                    <i class="bx bx-arrow-back me-2"></i>
                                    Kembali ke Halaman Peminjaman
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // ===================================================
            // 1. CONFIG & HELPER FUNCTIONS
            // ===================================================
            const today = new Date().toISOString().split('T')[0];
            $('#tanggalPengembalian').val(today);

            let peminjamanData = [];
            let validator; // Variabel global untuk instance validator

            // Konstanta Bunga
            const TOTAL_MONTHS = 4;
            const TOTAL_INTEREST = 0.02; // 2%
            const RATE_PER_MONTH = TOTAL_INTEREST / TOTAL_MONTHS;

            // Helper: Format Rupiah (Visual)
            function formatRupiah(angka) {
                if (!angka || angka === 0 || angka === '0') return 'Rp 0';
                const number = parseFloat(angka);
                if (isNaN(number)) return 'Rp 0';
                return 'Rp ' + number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Helper: Parse Rupiah ke Integer (Logic)
            function parseRupiah(rupiah) {
                if (typeof rupiah !== 'string') return rupiah;
                return parseInt(rupiah.replace(/[^0-9]/g, '')) || 0;
            }

            // Helper: Format Tanggal Ind
            function formatTanggal(tanggal) {
                if (!tanggal || tanggal === '-') return '-';
                return new Date(tanggal).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }

            // Event: Auto format rupiah saat mengetik
            $('#jumlahPengembalian').on('keyup input', function() {
                let value = $(this).val().replace(/[^0-9]/g, '');
                if (value) {
                    $(this).val(formatRupiah(value).replace('Rp ', ''));
                }
            });

            // ===================================================
            // 2. LOGIC CICILAN & UMKM
            // ===================================================
            function renderJadwalCicilan(pokok) {
                pokok = parseFloat(pokok) || 0;
                if (pokok <= 0) return;

                const pokokPerBulan = pokok / TOTAL_MONTHS;
                const bungaPerBulan = pokok * RATE_PER_MONTH;
                const cicilanPerBulan = pokokPerBulan + bungaPerBulan;
                const totalBunga = pokok * TOTAL_INTEREST;
                const totalPengembalian = pokok + totalBunga;

                // Update Summary Text
                $('#js-pokok').text(formatRupiah(pokok));
                $('#js-bunga').text(formatRupiah(totalBunga));
                $('#js-total').text(formatRupiah(totalPengembalian));
                $('#js-perbulan').text(formatRupiah(cicilanPerBulan));
                $('#infoPerbulan').text(formatRupiah(cicilanPerBulan));

                // Render Table
                let tbody = '';
                let saldo = pokok;

                for (let i = 1; i <= TOTAL_MONTHS; i++) {
                    saldo -= pokokPerBulan;
                    tbody += `
                    <tr>
                        <td class="text-center fw-semibold">Bulan ke-${i}</td>
                        <td class="text-end">${formatRupiah(pokokPerBulan)}</td>
                        <td class="text-end text-warning fw-bold">${formatRupiah(bungaPerBulan)}</td>
                        <td class="text-end text-danger fw-bold">${formatRupiah(cicilanPerBulan)}</td>
                        <td class="text-end text-muted">${formatRupiah(Math.max(saldo, 0))}</td>
                    </tr>`;
                }

                $('#jadwal-tbody').html(tbody);
                $('#jadwal-foot-pokok').text(formatRupiah(pokok));
                $('#jadwal-foot-bunga').text(formatRupiah(totalBunga));
                $('#jadwal-foot-total').text(formatRupiah(totalPengembalian));
            }

            function loadUMKMList() {
                $.ajax({
                    url: '/v1/peminjaman',
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#selectUmkm').html('<option value="">Memuat data...</option>').prop(
                            'disabled', true);
                    },
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            peminjamanData = response.data;
                            const activeLoan = peminjamanData.filter(item =>
                                item.status.toLowerCase() === 'disetujui' && parseFloat(item
                                    .sisa_pinjaman) > 0
                            );

                            let options = '<option value="">-- Pilih UMKM --</option>';
                            if (activeLoan.length > 0) {
                                activeLoan.forEach(item => {
                                    options +=
                                        `<option value="${item.id}" data-umkm='${JSON.stringify(item)}'>${item.umkm.nama_umkm} - Sisa: ${formatRupiah(item.sisa_pinjaman)}</option>`;
                                });
                                $('#selectUmkm').html(options).prop('disabled', false);
                            } else {
                                $('#selectUmkm').html(
                                    '<option value="">Tidak ada pinjaman aktif</option>');
                            }
                        }
                    },
                    error: function() {
                        $('#selectUmkm').html('<option value="">Gagal memuat data</option>');
                    }
                });
            }

            $('#selectUmkm').on('change', function() {
                const selectedId = $(this).val();
                // Reset form & validasi saat ganti UMKM
                $('#pengembalianForm')[0].reset();
                $('#tanggalPengembalian').val(today);
                if (validator) validator.resetForm();
                $('.is-invalid').removeClass('is-invalid');

                if (selectedId) {
                    const selectedOption = $(this).find('option:selected');
                    const umkmData = JSON.parse(selectedOption.attr('data-umkm'));

                    $('#peminjamanId').val(umkmData.id);
                    $('#namaUmkm').text(umkmData.umkm.nama_umkm || '-');
                    $('#totalPinjaman').text(formatRupiah(umkmData.jumlah_pinjaman));
                    $('#sisaPinjaman').text(formatRupiah(umkmData.sisa_pinjaman));
                    $('#tanggalBerlaku').text(formatTanggal(umkmData.tanggal_disetujui));
                    $('#maxPengembalian').text(formatRupiah(umkmData.sisa_pinjaman));

                    // Simpan sisa pinjaman di data attribute form untuk validasi
                    $('#pengembalianForm').data('sisa-pinjaman', umkmData.sisa_pinjaman);

                    renderJadwalCicilan(umkmData.jumlah_pinjaman);

                    $('#infoContainer').slideDown(400);
                    $('#formCard').fadeIn(400);
                    $('#btnSubmit').prop('disabled', false);
                } else {
                    $('#formCard, #infoContainer').hide();
                    $('#btnSubmit').prop('disabled', true);
                }
            });

            loadUMKMList();

            // ===================================================
            // 3. PROFESSIONAL VALIDATION CONFIGURATION
            // ===================================================

            // Custom Method: Cek Sisa Pinjaman
            $.validator.addMethod("checkMaxSaldo", function(value, element) {
                const sisa = parseFloat($('#pengembalianForm').data('sisa-pinjaman')) || 0;
                const input = parseRupiah(value);
                return input > 0 && input <= sisa;
            }, function() {
                // Dinamis message berdasarkan sisa
                const sisa = $('#pengembalianForm').data('sisa-pinjaman');
                return "Maksimal pengembalian adalah " + formatRupiah(sisa);
            });

            validator = $("#pengembalianForm").validate({
                // Trigger validasi real-time
                onkeyup: function(element) {
                    $(element).valid();
                },
                onfocusout: function(element) {
                    $(element).valid();
                },

                // CSS Class Bootstrap 5
                errorClass: "is-invalid text-danger small",
                validClass: "is-valid",
                errorElement: "div", // Gunakan div agar block ke bawah

                // Penempatan Error (Handling Input Group)
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback'); // Bootstrap class error text
                    if (element.closest('.input-group').length) {
                        // Jika input ada di dalam input-group (ada Rp), taruh error setelah group
                        element.closest('.input-group').after(error);
                    } else {
                        error.insertAfter(element);
                    }
                },

                // Rules
                rules: {
                    jumlah_pengembalian: {
                        required: true,
                        checkMaxSaldo: true
                    },
                    tanggal_pengembalian: {
                        required: true,
                        date: true
                    }
                },

                // Messages
                messages: {
                    jumlah_pengembalian: {
                        required: "Nominal pengembalian wajib diisi"
                    },
                    tanggal_pengembalian: {
                        required: "Tanggal wajib diisi",
                        date: "Format tanggal salah"
                    }
                },

                // Styling field saat error/valid
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            });

            // ===================================================
            // 4. SUBMIT HANDLER
            // ===================================================
            $('#pengembalianForm').on('submit', function(e) {
                e.preventDefault();

                // 1. Cek Validasi Frontend (Tanpa Alert)
                if (!$(this).valid()) {
                    return false; // Error akan muncul otomatis di bawah field
                }

                const form = this;
                const formData = new FormData(form);
                const jumlahRaw = parseRupiah($('#jumlahPengembalian').val());
                formData.set('jumlah_pengembalian', jumlahRaw);

                // Konfirmasi User (Ini BUKAN alert validasi, tapi konfirmasi aksi)
                Swal.fire({
                    title: 'Konfirmasi Simpan',
                    html: `Simpan pengembalian sebesar <strong>${formatRupiah(jumlahRaw)}</strong>?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Simpan'
                }).then((result) => {
                    if (result.isConfirmed) {

                        // Loading State
                        Swal.fire({
                            title: 'Memproses...',
                            didOpen: () => Swal.showLoading()
                        });
                        $('#btnSubmit').prop('disabled', true);

                        $.ajax({
                            url: '/v1/pengembalian/create',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire('Berhasil!', 'Data tersimpan.', 'success')
                                        .then(() => window.location.href =
                                            '/peminjaman');
                                } else {
                                    Swal.fire('Gagal', response.message, 'error');
                                    $('#btnSubmit').prop('disabled', false);
                                }
                            },
                            error: function(xhr) {
                                $('#btnSubmit').prop('disabled', false);
                                Swal.close(); // Tutup loading

                                // === HANDLE ERROR BACKEND SECARA ELEGAN ===
                                if (xhr.status ===
                                    422) { // Error Validasi dari Laravel/Backend
                                    const errors = xhr.responseJSON.errors;
                                    const formattedErrors = {};

                                    // Mapping error backend ke field frontend
                                    $.each(errors, function(key, value) {
                                        // value[0] mengambil pesan error pertama dari array
                                        formattedErrors[key] = value[0];
                                    });

                                    // Tampilkan error di bawah input field menggunakan Validator
                                    validator.showErrors(formattedErrors);

                                    // Fokus ke field pertama yang error
                                    validator.focusInvalid();
                                } else {
                                    // Error sistem (500, 404, dll) baru pakai Alert umum
                                    Swal.fire('Error', 'Terjadi kesalahan sistem',
                                        'error');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

    <style>
        /* Global */
        body {
            min-height: 100vh;
        }

        /* Main / Form Card */
        .main-card,
        .form-card {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .main-card:hover,
        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(220, 53, 69, 0.2) !important;
        }

        /* Gradient Headers */
        .bg-gradient-red {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

        .bg-gradient-white-red {
            background: linear-gradient(135deg, #ffffff 0%, #ffe5e8 100%);
            border-bottom: 3px solid #dc3545;
        }

        /* Step Badges */
        .step-badge {
            background: rgba(255, 255, 255, 0.3);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 14px;
            backdrop-filter: blur(10px);
        }

        .step-badge-red {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 14px;
            border: 2px solid #dc3545;
        }

        /* Select UMKM */
        .select-umkm {
            border: 2px solid #ffe0e0;
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .select-umkm:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
            transform: translateY(-2px);
        }

        .select-umkm:hover {
            border-color: #dc3545;
        }

        /* Separator */
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
        }

        .separator-line {
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, transparent, #ffcccc, transparent);
        }

        .separator-text {
            padding: 0 20px;
            color: #dc3545;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Info Cards */
        .info-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.15);
        }

        .info-card-red {
            border-color: #ffcccc;
            background: linear-gradient(135deg, #fff 0%, #fff5f5 100%);
        }

        .info-card-red:hover {
            border-color: #dc3545;
        }

        .info-card-white {
            border-color: #f0f0f0;
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
        }

        .info-card-white:hover {
            border-color: #dc3545;
        }

        .info-card-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-card-red .info-card-icon {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .info-card-white .info-card-icon {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            color: #dc3545;
            border: 2px solid #dc3545;
        }

        .info-card-icon i {
            font-size: 26px;
        }

        .info-card-content {
            flex: 1;
        }

        .info-card-label {
            display: block;
            color: #6c757d;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .info-card-value {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #2d3748;
        }

        /* ===== JADWAL CICILAN – SUMMARY BOXES ===== */
        .jadwal-cicilan-card {
            background: #fff;
            border: 1px solid #ffe0e0;
            border-radius: 16px;
            padding: 24px;
        }

        .jadwal-summary-box {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
            border: 1px solid #ffcccc;
            border-radius: 12px;
            padding: 18px 12px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .jadwal-summary-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(220, 53, 69, 0.15);
            border-color: #dc3545;
        }

        /* highlight box – Cicilan / Bulan */
        .jadwal-summary-box-highlight {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
            border-color: #c82333 !important;
        }

        .jadwal-summary-box-highlight .jadwal-summary-label {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .jadwal-summary-box-highlight .jadwal-summary-value {
            color: #fff !important;
        }

        .jadwal-summary-box-highlight .jadwal-summary-icon {
            background: rgba(255, 255, 255, 0.2) !important;
            color: #fff !important;
        }

        .jadwal-summary-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 1.2rem;
        }

        .bg-red-soft {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .bg-warning-soft {
            background: rgba(255, 193, 7, 0.15);
            color: #d39e00;
        }

        .bg-red-solid {
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
        }

        .jadwal-summary-label {
            font-size: 0.7rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .jadwal-summary-value {
            font-size: 1.05rem;
            font-weight: 700;
            color: #dc3545;
        }

        /* ===== JADWAL CICILAN – TABLE ===== */
        .jadwal-table-wrap {
            margin-top: 4px;
        }

        .jadwal-table {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ffe0e0;
        }

        .jadwal-table thead {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: #fff;
        }

        .jadwal-table thead th {
            padding: 12px 14px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            border: none;
        }

        .jadwal-table tbody td {
            padding: 11px 14px;
            font-size: 0.9rem;
            border-bottom: 1px solid #fff0f0;
        }

        .jadwal-table tbody tr:hover {
            background-color: rgba(220, 53, 69, 0.05);
        }

        .jadwal-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* tfoot */
        .jadwal-tfoot-row td {
            background: linear-gradient(135deg, #fff0f0 0%, #ffe0e0 100%);
            border-top: 2px solid #dc3545 !important;
            padding: 12px 14px;
            font-size: 0.9rem;
        }

        .jadwal-tfoot-row td:first-child {
            border-radius: 0 0 0 10px;
        }

        .jadwal-tfoot-row td:last-child {
            border-radius: 0 0 10px 0;
        }

        /* ===== FORM CONTROLS ===== */
        .form-control,
        .form-select {
            border: 2px solid #ffe0e0;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
        }

        .form-control-lg {
            padding: 14px 18px;
            font-size: 16px;
        }

        .input-group-text {
            border: 2px solid #ffe0e0;
            border-right: none;
            border-radius: 12px 0 0 12px;
            background-color: #fff5f5;
        }

        .input-group>.form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .money-input {
            font-size: 20px !important;
            font-weight: 700;
            color: #dc3545;
        }

        /* Buttons */
        .btn-lg {
            padding: 16px 24px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-submit {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.5s ease;
        }

        .btn-submit:hover::before {
            left: 100%;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.4);
        }

        .btn-outline-secondary {
            border: 2px solid #e0e6ed;
            color: #6c757d;
            background: white;
        }

        .btn-outline-secondary:hover {
            background: #f8f9fa;
            border-color: #cbd5e0;
            color: #2d3748;
        }

        /* Form Text (info box below input) */
        .form-text {
            display: flex;
            align-items: center;
            padding: 12px;
            background: #fff5f5;
            border-radius: 8px;
            margin-top: 8px;
            border-left: 3px solid #dc3545;
        }

        /* Validation */
        .is-invalid {
            border-color: #dc3545 !important;
            animation: shake 0.3s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        small.text-danger {
            display: block;
            margin-top: 8px;
            font-weight: 500;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #infoContainer {
            animation: fadeIn 0.5s ease;
        }

        #formCard {
            animation: slideInUp 0.5s ease;
        }

        .info-card {
            animation: fadeIn 0.6s ease;
        }

        .info-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .info-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .info-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .info-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-card {
                margin-bottom: 12px;
            }

            .step-badge,
            .step-badge-red {
                padding: 6px 12px;
                font-size: 12px;
            }

            .info-card-value {
                font-size: 16px;
            }

            .money-input {
                font-size: 18px !important;
            }

            .jadwal-summary-value {
                font-size: 0.9rem;
            }

            .jadwal-table thead th,
            .jadwal-table tbody td,
            .jadwal-tfoot-row td {
                font-size: 0.78rem;
                padding: 9px 8px;
            }
        }
    </style>
@endsection
