@extends('Layouts.base')
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
                                            <i class="bx bx-money-withdraw"></i>
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
                                    <input 
                                        type="text" 
                                        class="form-control form-control-lg money-input" 
                                        id="jumlahPengembalian" 
                                        name="jumlah_pengembalian"
                                        placeholder="0"
                                    />
                                </div>
                                <small class="text-danger" id="jumlahPengembalian-error"></small>
                                <div class="form-text mt-2">
                                    <i class="bx bx-info-circle me-1"></i>
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
                                    <input 
                                        type="date" 
                                        class="form-control form-control-lg" 
                                        id="tanggalPengembalian" 
                                        name="tanggal_pengembalian"
                                    />
                                </div>
                                <small class="text-danger" id="tanggalPengembalian-error"></small>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label for="keterangan" class="form-label fw-semibold">
                                    <i class="bx bx-message-square-detail text-secondary me-2"></i>
                                    Keterangan (Opsional)
                                </label>
                                <textarea 
                                    class="form-control form-control-lg" 
                                    id="keterangan" 
                                    name="keterangan" 
                                    rows="4"
                                    placeholder="Tambahkan catatan atau keterangan pengembalian..."
                                ></textarea>
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
            // Set today's date as default
            const today = new Date().toISOString().split('T')[0];
            $('#tanggalPengembalian').val(today);

            let peminjamanData = []; // Store all peminjaman data

            // Format Rupiah
            function formatRupiah(angka) {
                if (!angka || angka === 0 || angka === '0') return 'Rp 0';
                const number = parseFloat(angka);
                if (isNaN(number)) return 'Rp 0';
                return 'Rp ' + number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Format Tanggal
            function formatTanggal(tanggal) {
                if (!tanggal || tanggal === '-') return '-';
                const date = new Date(tanggal);
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return date.toLocaleDateString('id-ID', options);
            }

            // Parse Rupiah to Number
            function parseRupiah(rupiah) {
                return parseInt(rupiah.replace(/[^0-9]/g, '')) || 0;
            }

            // Format input as Rupiah
            $('#jumlahPengembalian').on('keyup', function() {
                let value = $(this).val().replace(/[^0-9]/g, '');
                if (value) {
                    $(this).val(formatRupiah(value).replace('Rp ', ''));
                }
            });

            // Load UMKM List with Active Loans
            function loadUMKMList() {
                $.ajax({
                    url: '/v1/peminjaman',
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function() {
                        $('#selectUmkm').prop('disabled', true);
                        $('#selectUmkm').html('<option value="">Memuat data...</option>');
                    },
                    success: function(response) {
                        console.log(response);
                        
                        if (response.status === 'success' && response.data) {
                            peminjamanData = response.data;
                            
                            // Filter only loans with status 'disetujui' and sisa_pinjaman > 0
                            const activeLoan = peminjamanData.filter(item => 
                                item.status.toLowerCase() === 'disetujui' && 
                                parseFloat(item.sisa_pinjaman) > 0
                            );
                            
                            let options = '<option value="">-- Pilih UMKM --</option>';
                            
                            if (activeLoan.length > 0) {
                                activeLoan.forEach(function(item) {
                                    options += `<option value="${item.id}" data-umkm='${JSON.stringify(item)}'>
                                        ${item.umkm.nama_umkm} - Sisa: ${formatRupiah(item.sisa_pinjaman)}
                                    </option>`;
                                });
                                
                                $('#selectUmkm').html(options);
                                $('#selectUmkm').prop('disabled', false);
                            } else {
                                $('#selectUmkm').html('<option value="">Tidak ada pinjaman aktif</option>');
                                
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Informasi',
                                    text: 'Tidak ada pinjaman aktif yang dapat dikembalikan',
                                    confirmButtonColor: '#dc3545'
                                });
                            }
                        } else {
                            $('#selectUmkm').html('<option value="">Gagal memuat data</option>');
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Gagal memuat data peminjaman',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $('#selectUmkm').html('<option value="">Gagal memuat data</option>');
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat memuat data',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            }

            // Handle UMKM Selection Change
            $('#selectUmkm').on('change', function() {
                const selectedId = $(this).val();
                
                if (selectedId) {
                    const selectedOption = $(this).find('option:selected');
                    const umkmData = JSON.parse(selectedOption.attr('data-umkm'));
                    
                    console.log('Selected UMKM:', umkmData);
                    
                    // Set peminjaman ID to hidden input
                    $('#peminjamanId').val(umkmData.id);
                    
                    // Fill data
                    $('#namaUmkm').text(umkmData.umkm.nama_umkm || '-');
                    $('#totalPinjaman').text(formatRupiah(umkmData.jumlah_pinjaman));
                    $('#sisaPinjaman').text(formatRupiah(umkmData.sisa_pinjaman));
                    $('#tanggalBerlaku').text(formatTanggal(umkmData.tanggal_disetujui || umkmData.batas_pengembalian));
                    $('#maxPengembalian').text(formatRupiah(umkmData.sisa_pinjaman));
                    
                    // Store sisa pinjaman for validation
                    $('#pengembalianForm').data('sisa-pinjaman', umkmData.sisa_pinjaman);
                    
                    // Show info container with smooth animation
                    $('#infoContainer').slideDown(400, function() {
                        // After info is shown, show form card with animation
                        setTimeout(function() {
                            $('#formCard').fadeIn(400);
                            
                            // Smooth scroll to form
                            $('html, body').animate({
                                scrollTop: $('#formCard').offset().top - 100
                            }, 600);
                        }, 300);
                    });
                    
                    // Enable submit button
                    $('#btnSubmit').prop('disabled', false);
                } else {
                    // Hide containers with animation
                    $('#formCard').fadeOut(300);
                    $('#infoContainer').slideUp(300);
                    
                    // Clear data
                    $('#peminjamanId').val('');
                    $('#pengembalianForm').removeData('sisa-pinjaman');
                    
                    // Reset form
                    $('#pengembalianForm')[0].reset();
                    $('#tanggalPengembalian').val(today);
                    
                    // Disable submit button
                    $('#btnSubmit').prop('disabled', true);
                }
            });

            // Load UMKM list on page load
            loadUMKMList();

            // Form Validation
            $.validator.setDefaults({
                errorElement: 'small',
                errorClass: 'text-danger',
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Custom validation method for maximum amount
            $.validator.addMethod("maxPengembalian", function(value, element) {
                const sisaPinjaman = $('#pengembalianForm').data('sisa-pinjaman');
                const jumlahPengembalian = parseRupiah(value);
                return jumlahPengembalian <= parseFloat(sisaPinjaman);
            }, "Jumlah pengembalian melebihi sisa pinjaman");

            $("#pengembalianForm").validate({
                rules: {
                    umkm_id: {
                        required: true
                    },
                    jumlah_pengembalian: {
                        required: true,
                        maxPengembalian: true
                    },
                    tanggal_pengembalian: {
                        required: true,
                        date: true
                    }
                },
                messages: {
                    umkm_id: {
                        required: "Silakan pilih UMKM terlebih dahulu"
                    },
                    jumlah_pengembalian: {
                        required: "Jumlah pengembalian wajib diisi"
                    },
                    tanggal_pengembalian: {
                        required: "Tanggal pengembalian wajib diisi",
                        date: "Format tanggal tidak valid"
                    }
                }
            });

            // Form Submit
            $('#pengembalianForm').on('submit', function(e) {
                e.preventDefault();

                // Validate form
                if (!$(this).valid()) {
                    return false;
                }

                // Prepare form data
                const formData = new FormData(this);
                
                // Convert Rupiah to number
                const jumlahPengembalian = parseRupiah($('#jumlahPengembalian').val());
                formData.set('jumlah_pengembalian', jumlahPengembalian);

                // Show confirmation
                Swal.fire({
                    title: 'Konfirmasi',
                    html: `Apakah Anda yakin ingin menyimpan pengembalian sebesar <strong>${formatRupiah(jumlahPengembalian)}</strong>?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bx bx-check me-1"></i> Ya, Simpan',
                    cancelButtonText: '<i class="bx bx-x me-1"></i> Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Menyimpan...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Disable submit button
                        $('#btnSubmit').prop('disabled', true);

                        // Submit via AJAX
                        $.ajax({
                            url: '/v1/pengembalian/create',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                console.log(response);
                                
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: 'Pengembalian berhasil disimpan',
                                        confirmButtonColor: '#dc3545',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Redirect to peminjaman page or previous page
                                        window.location.href = '/peminjaman'; // Adjust this URL
                                    });
                                } else if (response.status === 'error') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message || 'Gagal menyimpan pengembalian',
                                        confirmButtonColor: '#dc3545'
                                    });
                                    $('#btnSubmit').prop('disabled', false);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                
                                let errorMessage = 'Terjadi kesalahan saat menyimpan data';
                                
                                if (xhr.responseJSON) {
                                    if (xhr.responseJSON.message) {
                                        errorMessage = xhr.responseJSON.message;
                                    } else if (xhr.responseJSON.errors) {
                                        // Handle validation errors
                                        const errors = xhr.responseJSON.errors;
                                        errorMessage = Object.values(errors).flat().join('<br>');
                                    }
                                }
                                
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: errorMessage,
                                    confirmButtonColor: '#dc3545'
                                });
                                
                                $('#btnSubmit').prop('disabled', false);
                            }
                        });
                    }
                });
            });
        });
    </script>

    <style>
        /* Global Styles */
        body {
            /* background: linear-gradient(135deg, #fff5f5 0%, #ffe0e0 100%); */
            min-height: 100vh;
        }

        /* Main Card Styling */
        .main-card, .form-card {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .main-card:hover, .form-card:hover {
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

        /* Step Badge */
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

        /* Select UMKM Styling */
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

        /* Form Controls */
        .form-control, .form-select {
            border: 2px solid #ffe0e0;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
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

        .input-group > .form-control {
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

        /* Form Text */
        .form-text {
            display: flex;
            align-items: center;
            padding: 12px;
            background: #fff5f5;
            border-radius: 8px;
            margin-top: 8px;
            border-left: 3px solid #dc3545;
        }

        /* Validation Styles */
        .is-invalid {
            border-color: #dc3545 !important;
            animation: shake 0.3s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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

        .info-card:nth-child(1) { animation-delay: 0.1s; }
        .info-card:nth-child(2) { animation-delay: 0.2s; }
        .info-card:nth-child(3) { animation-delay: 0.3s; }
        .info-card:nth-child(4) { animation-delay: 0.4s; }

        /* Spinner */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-card {
                margin-bottom: 12px;
            }

            .step-badge, .step-badge-red {
                padding: 6px 12px;
                font-size: 12px;
            }

            .info-card-value {
                font-size: 16px;
            }

            .money-input {
                font-size: 18px !important;
            }
        }
    </style>
@endsection