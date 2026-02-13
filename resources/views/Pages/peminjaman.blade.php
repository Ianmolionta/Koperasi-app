@extends('Layouts.Base')
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
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════
                             Modal Form Tambah/Edit
                             ═══════════════════════════════════════════ -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" aria-labelledby="basicModalLable">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="modal-title mb-0" id="modalTitle">Tambah Peminjaman</h5>
                            <small class="">Isi formulir dengan lengkap dan benar</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4">
                    <form method="POST" id="upsertDataForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id" name="id" />

                        <!-- Section: Pilih UMKM -->
                        <div class="form-section">
                            <div class="section-header mb-3">
                                <i class="bx bx-store text-danger"></i>
                                <span>Informasi UMKM</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="umkm_id" class="form-label fw-semibold">
                                        Nama UMKM <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-buildings text-danger"></i>
                                        </span>
                                        <select id="umkm_id" name="umkm_id" class="form-select">
                                            <option value="">Pilih UMKM</option>
                                        </select>
                                    </div>
                                    <small class="text-danger" id="umkm_id-error"></small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kategori & Limit UMKM</label>

                                    <div id="umkmCategoryInfo" class="category-info-card d-none">
                                        <div class="category-header">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bx bx-tag text-danger"></i>
                                                <span class="badge category-badge" id="categoryBadge">-</span>
                                            </div>
                                            <div class="limit-display">
                                                <div class="limit-label">Limit Berjalan</div>
                                                <div class="limit-value" id="limitText">Rp 0</div>
                                            </div>
                                        </div>
                                        <div class="limit-breakdown-enhanced">
                                            <div class="breakdown-item">
                                                <i class="bx bx-purchase-tag-alt"></i>
                                                <span class="breakdown-label">Master</span>
                                                <strong id="limitDasar">Rp 0</strong>
                                            </div>
                                            <span class="breakdown-operator breakdown-plus d-none">→</span>
                                            <div class="breakdown-item breakdown-bonus d-none" id="breakdownHistori">
                                                <i class="bx bx-trending-up"></i>
                                                <span class="breakdown-label">Sekarang</span>
                                                <strong id="limitHistori">Rp 0</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="umkmCategoryPlaceholder" class="category-placeholder-card">
                                        <i class="bx bx-info-circle"></i>
                                        <span>Pilih UMKM untuk melihat informasi</span>
                                    </div>

                                    <div id="alertPinjamanAktif" class="alert alert-warning alert-sm mt-2 d-none"
                                        role="alert">
                                        <i class="bx bx-error-circle me-1"></i>
                                        <strong>Perhatian:</strong> UMKM ini masih memiliki pinjaman aktif yang belum
                                        dilunasi. Pengajuan baru tidak dapat dilakukan.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Jumlah Pinjaman -->
                        <div class="form-section">
                            <div class="section-header mb-3">
                                <i class="bx bx-money text-danger"></i>
                                <span>Detail Pinjaman</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jumlah_pinjaman" class="form-label fw-semibold">
                                        Jumlah Pinjaman <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="bx bx-wallet text-danger"></i>
                                        </span>
                                        <select id="jumlah_pinjaman" name="jumlah_pinjaman" class="form-select" disabled>
                                            <option value="">Pilih UMKM terlebih dahulu</option>
                                        </select>
                                    </div>
                                    <small class="text-danger" id="jumlah_pinjaman-error"></small>
                                    <small class="form-hint" id="jumlahPinjamanHint" style="display:none;">
                                        <i class="bx bx-info-circle"></i>
                                        Pilihan dalam kelipatan Rp 5.000.000
                                    </small>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Penggunaan Limit</label>
                                    <div id="loanPercentageBox" class="loan-progress-card d-none">
                                        <div class="progress-header">
                                            <span class="progress-label">Progress</span>
                                            <span class="progress-percentage" id="loanPercentageText">0%</span>
                                        </div>
                                        <div class="progress modern-progress">
                                            <div class="progress-bar" id="loanProgressBar" role="progressbar"
                                                style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <div class="progress-footer">
                                            <span class="progress-min">Rp 0</span>
                                            <span class="progress-max" id="limitProgressMax">Rp 0</span>
                                        </div>
                                    </div>

                                    <div id="estimasiBox" class="estimasi-card d-none mt-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="estimasi-label"><i class="bx bx-calculator me-1"></i>Estimasi
                                                Sisa Pinjaman</span>
                                        </div>
                                        <div class="estimasi-row mt-1">
                                            <span class="text-muted small">Pokok</span>
                                            <span class="fw-semibold" id="estimasiPokok">Rp 0</span>
                                        </div>
                                        <div class="estimasi-row">
                                            <span class="text-muted small">Bunga (2%)</span>
                                            <span class="fw-semibold text-warning" id="estimasiBunga">Rp 0</span>
                                        </div>
                                        <div class="estimasi-row estimasi-total">
                                            <span class="text-danger small fw-bold">Total (Sisa Pinjaman)</span>
                                            <span class="fw-bold text-danger" id="estimasiTotal">Rp 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Catatan -->
                        <div class="form-section">
                            <div class="section-header mb-3">
                                <i class="bx bx-note text-danger"></i>
                                <span>Catatan Peminjaman</span>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="catatan" class="form-label fw-semibold">
                                        Catatan <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="catatan" name="catatan" class="form-control modern-textarea"
                                        placeholder="Masukkan catatan atau keterangan tambahan..." rows="3"></textarea>
                                    <small class="text-danger" id="catatan-error"></small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-outline-secondary btn-modern" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-danger btn-modern" id="simpanData">
                        <i class="bx bx-save me-1"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════
                             Modal Detail Peminjaman
                             ═══════════════════════════════════════════ -->
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
                        <!-- Status Badge Section -->
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
                                            <div class="d-flex gap-2">
                                                <button type="button" class="btn btn-outline-danger btn-lg shadow-sm"
                                                    id="downloadInvoiceBtn" style="display: none;">
                                                    <i class="bx bx-download me-2"></i>Download Invoice
                                                </button>
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
                                                    <small class="text-muted">(+bunga)</small>
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

                        <!-- Jadwal Cicilan -->
                        <div id="cicilan-card" class="card shadow-sm border-0 card-history-redwhite d-none mb-4">
                            <div class="card-header bg-gradient-red text-white">
                                <h6 class="mb-0 fw-bold text-white">
                                    <i class="bx bx-calculator me-2"></i>Jadwal Cicilan &amp; Bunga
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3" id="cicilan-summary">
                                    <div class="col-6 col-md-3">
                                        <div class="cicilan-summary-box">
                                            <div class="cicilan-summary-label"><i class="bx bx-wallet me-1"></i>Pokok
                                                Pinjaman</div>
                                            <div class="cicilan-summary-value" id="cs-pokok">Rp 0</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="cicilan-summary-box">
                                            <div class="cicilan-summary-label"><i class="bx bx-trending-up me-1"></i>Total
                                                Bunga (2%)</div>
                                            <div class="cicilan-summary-value text-warning" id="cs-bunga">Rp 0</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="cicilan-summary-box">
                                            <div class="cicilan-summary-label"><i class="bx bx-money me-1"></i>Total
                                                Pengembalian</div>
                                            <div class="cicilan-summary-value text-danger" id="cs-total">Rp 0</div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="cicilan-summary-box">
                                            <div class="cicilan-summary-label"><i class="bx bx-calendar me-1"></i>Cicilan
                                                / Bulan</div>
                                            <div class="cicilan-summary-value text-danger" id="cs-perbulan">Rp 0</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-redwhite mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center">Bulan</th>
                                                <th class="text-end">Pokok Cicilan</th>
                                                <th class="text-end">Bunga (0.5%/bln)</th>
                                                <th class="text-end">Total Cicilan</th>
                                                <th class="text-end">Saldo Tersisa</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cicilan-tbody"></tbody>
                                        <tfoot>
                                            <tr class="cicilan-tfoot-row">
                                                <td class="fw-bold">Jumlah</td>
                                                <td class="text-end fw-bold" id="cicilan-foot-pokok">Rp 0</td>
                                                <td class="text-end fw-bold text-warning" id="cicilan-foot-bunga">Rp 0
                                                </td>
                                                <td class="text-end fw-bold text-danger" id="cicilan-foot-total">Rp 0</td>
                                                <td class="text-end text-muted">—</td>
                                            </tr>
                                        </tfoot>
                                    </table>
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
                                <div id="pengembalianContent"></div>
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

    <!-- ═══════════════════════════════════════════
        Modal Preview Invoice  ← BARU
        ═══════════════════════════════════════════ -->
    <div class="modal fade" id="invoicePreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered invoice-preview-dialog">
            <div class="modal-content invoice-preview-modal-content">

                <!-- Header -->
                <div class="modal-header invoice-preview-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="invoice-preview-icon-wrap">
                            <i class="bx bx-file"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0 text-white">Preview Invoice</h5>
                            <small class="text-white opacity-75" id="invoicePreviewSubtitle">INV-000000</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body: area preview -->
                <div class="modal-body invoice-preview-body">

                    <!-- Loading overlay -->
                    <div id="invoicePreviewLoading" class="invoice-preview-loading">
                        <div class="spinner-border text-danger" role="status" style="width:2.5rem; height:2.5rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="text-muted mt-2 mb-0">Menghasilkan preview…</p>
                    </div>

                    <!-- Rendered image -->
                    <div id="invoicePreviewImageWrap" class="invoice-preview-image-wrap d-none">
                        <img id="invoicePreviewImage" src="" alt="Preview Invoice" class="invoice-preview-img">
                    </div>
                </div>

                <!-- Footer: download button -->
                <div class="modal-footer invoice-preview-footer">
                    <button type="button" class="btn btn-secondary btn-invoice-action" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i>Tutup
                    </button>
                    <button type="button" class="btn btn-danger btn-invoice-download" id="downloadInvoicePdfBtn">
                        <i class="bx bx-download me-2"></i>Download PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════
        Invoice Template — tersembunyi, diisi JS
        ═══════════════════════════════════════════ -->
    <div id="invoiceTemplate" class="invoice-template-hidden">

        <!-- TOP BAR -->
        <div class="inv-top-bar">
            <span class="inv-top-title">SURAT INVOICE PEMINJAMAN</span>
            <span class="inv-top-number" id="inv-number">INV-000000</span>
        </div>

        <!-- SUB HEADER -->
        <div class="inv-sub-header">
            <div class="inv-sub-col">
                <div class="inv-sub-label">Nomor Invoice</div>
                <div class="inv-sub-value inv-sub-value--red" id="inv-number2">INV-000000</div>
            </div>
            <div class="inv-sub-col">
                <div class="inv-sub-label">Tanggal Invoice</div>
                <div class="inv-sub-value" id="inv-date">-</div>
            </div>
        </div>

        <!-- SECTION: Informasi UMKM -->
        <div class="inv-section">
            <div class="inv-section-header">Informasi UMKM</div>
            <table class="inv-table">
                <tr class="inv-row--alt">
                    <td class="inv-td-label">Nama UMKM</td>
                    <td class="inv-td-value" id="inv-nama-umkm">-</td>
                </tr>
                <tr>
                    <td class="inv-td-label">Nama Pemilik</td>
                    <td class="inv-td-value" id="inv-nama-pemilik">-</td>
                </tr>
                <tr class="inv-row--alt">
                    <td class="inv-td-label">No. KTP</td>
                    <td class="inv-td-value" id="inv-no-ktp">-</td>
                </tr>
                <tr>
                    <td class="inv-td-label">Alamat Usaha</td>
                    <td class="inv-td-value" id="inv-alamat-usaha">-</td>
                </tr>
            </table>
        </div>

        <!-- SECTION: Detail Pinjaman -->
        <div class="inv-section">
            <div class="inv-section-header">Detail Pinjaman</div>
            <table class="inv-table">
                <tr class="inv-row--alt">
                    <td class="inv-td-label">Jumlah Pinjaman (Pokok)</td>
                    <td class="inv-td-value inv-td-value--right" id="inv-pokok">Rp 0</td>
                </tr>
                <tr>
                    <td class="inv-td-label">Bunga (2%)</td>
                    <td class="inv-td-value inv-td-value--right inv-td-value--gold" id="inv-bunga">Rp 0</td>
                </tr>
            </table>
        </div>

        <!-- TOTAL BOX -->
        <div class="inv-total-box">
            <div class="inv-total-left">
                <div class="inv-total-label">Sisa Pinjaman (Pokok + Bunga)</div>
                <div class="inv-total-value" id="inv-total">Rp 0</div>
            </div>
            <div class="inv-total-breakdown" id="inv-total-breakdown">Pokok Rp 0 + Bunga Rp 0</div>
        </div>

        <!-- Ganti Section Jadwal Cicilan dengan Riwayat Pengembalian -->
        <div class="inv-section">
            <div class="inv-section-header">Riwayat Pengembalian</div>
            <table class="inv-table inv-table--pengembalian">
                <thead>
                    <tr class="inv-thead-row">
                        <th class="inv-th inv-th--center">No</th>
                        <th class="inv-th inv-th--right">Jumlah Pengembalian</th>
                        <th class="inv-th inv-th--center">Tanggal Pengembalian</th>
                    </tr>
                </thead>
                <tbody id="inv-pengembalian-tbody"></tbody>
                <tfoot id="inv-pengembalian-tfoot" style="display: none;">
                    <tr class="inv-tfoot-row">
                        <td class="inv-td-foot inv-td-foot--center">Total</td>
                        <td class="inv-td-foot inv-td-foot--right" id="inv-foot-total-pengembalian">Rp 0</td>
                        <td class="inv-td-foot inv-td-foot--center">—</td>
                    </tr>
                </tfoot>
            </table>
            <div id="inv-no-pengembalian" class="inv-empty-state" style="display: none;">
                <i class="bx bx-info-circle"></i>
                <span>Belum ada riwayat pengembalian</span>
            </div>
        </div>

        <!-- CATATAN -->
        <div class="inv-catatan">
            <div class="inv-catatan-title">Catatan Penting</div>
            <div class="inv-catatan-body">
                • Sisa pinjaman di atas sudah termasuk bunga 2% dari pokok pinjaman.<br>
                • Cicilan dilakukan selama 4 bulan dengan bunga 0.5% per bulan dari pokok.<br>
                • Pengembalian harus dilakukan sebelum batas waktu yang telah ditentukan.
            </div>
        </div>

        <!-- BOTTOM BAR -->
        <div class="inv-bottom-bar">
            <span id="inv-footer-text">Dokumen ini dihasilkan oleh Sistem Peminjaman UMKM</span>
        </div>
    </div>
@endsection

@section('script')
    <!-- CDN: html2canvas + jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
        $(document).ready(function() {
            let currentPeminjamanId = null;

            // =============================================
            // KONSTANTA
            // =============================================
            const STEP_AMOUNT = 5000000;
            const INTEREST_RATE = 0.02;
            const TOTAL_MONTHS = 4;
            const RATE_PER_MONTH = INTEREST_RATE / TOTAL_MONTHS;

            const ACTIVE_STATUSES = ['pending', 'disetujui', 'berjalan'];

            const CATEGORY_BADGE_CLASS = {
                'mikro': 'badge bg-warning text-dark',
                'kecil': 'badge bg-info text-dark',
                'menengah': 'badge bg-success'
            };

            // =============================================
            // STORES
            // =============================================
            let umkmDataStore = [];
            let peminjamanStore = [];
            let currentLimitData = null;

            /** Simpan canvas terakhir supaya download tidak perlu render ulang */
            let lastInvoiceCanvas = null;

            // =============================================
            // jQuery Validation - Konfigurasi Global
            // =============================================
            $.validator.setDefaults({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                errorPlacement: function(error, element) {
                    // Hapus error lama jika ada
                    element.closest('.mb-3').find('.invalid-feedback').remove();
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                success: function(label, element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                    label.remove();
                }
            });

            // Inisialisasi validasi form
            const formValidator = $("#upsertDataForm").validate({
                rules: {
                    umkm_id: {
                        required: true
                    },
                    jumlah_pinjaman: {
                        required: true
                    },
                    catatan: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    umkm_id: {
                        required: "Silakan pilih UMKM terlebih dahulu"
                    },
                    jumlah_pinjaman: {
                        required: "Silakan pilih jumlah pinjaman"
                    },
                    catatan: {
                        required: "Catatan wajib diisi",
                        minlength: "Catatan minimal 10 karakter"
                    }
                }
            });

            // =============================================
            // UTILITY
            // =============================================
            function formatRupiah(angka) {
                if (!angka || angka === 0 || angka === '0') return 'Rp 0';
                const number = parseFloat(angka);
                if (isNaN(number)) return 'Rp 0';
                return 'Rp ' + number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function formatTanggal(tanggal) {
                if (!tanggal || tanggal === '-') return '-';
                const date = new Date(tanggal);
                return date.toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }

            function getStatusBadge(status) {
                let badgeClass = '';
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
                return `<span class="${badgeClass}">${status}</span>`;
            }

            function getBadgeClassByCategory(category) {
                return CATEGORY_BADGE_CLASS[(category || '').toLowerCase().trim()] || 'badge bg-secondary';
            }

            /**
             * Fungsi untuk membersihkan semua pesan error manual
             */
            function clearManualErrors() {
                // Remove validation classes
                $('.is-invalid').removeClass('is-invalid');
                $('.is-valid').removeClass('is-valid');
                
                // Remove error messages
                $('.invalid-feedback').remove();
                $('.text-danger').remove();
                
                // Remove any inline error text
                $('small.text-danger').remove();
                
                // Clear any error styling on inputs
                $('.form-control, .form-select').css('border-color', '');
            }

            /**
             * Fungsi untuk menampilkan error pada field tertentu
             */
            function showFieldError(fieldName, message) {
                const $field = $('[name="' + fieldName + '"]');
                $field.addClass('is-invalid');
                
                // Hapus error lama jika ada
                $field.closest('.mb-3').find('.invalid-feedback').remove();
                
                // Tambah error baru
                $field.after('<div class="invalid-feedback d-block">' + message + '</div>');
            }

            // =============================================
            // CEK PINJAMAN AKTIF
            // =============================================
            function hasPinjamanAktif(umkmId) {
                return peminjamanStore.some(function(p) {
                    return String(p.umkm_id) === String(umkmId) &&
                        ACTIVE_STATUSES.includes((p.status || '').toLowerCase());
                });
            }

            // =============================================
            // GENERATE DROPDOWN
            // =============================================
            function generateLoanOptions(limit) {
                let options = '<option value="">-- Pilih Jumlah Pinjaman --</option>';
                if (limit <= 0) return options;
                for (let amount = STEP_AMOUNT; amount <= limit; amount += STEP_AMOUNT) {
                    options += `<option value="${amount}">${formatRupiah(amount)}</option>`;
                }
                return options;
            }

            // =============================================
            // RENDER UI LIMIT
            // =============================================
            function renderLimitUI(umkm, detailData, aktifFlag) {
                const category = (umkm && umkm.jenis_umkm) || '';
                const masterLimit = parseFloat(detailData.limit_master) || 0;
                const limitAktif = parseFloat(detailData.limit_saat_ini) || 0;
                const selisih = limitAktif - masterLimit;

                $('#alertPinjamanAktif').toggleClass('d-none', !aktifFlag);

                if (limitAktif <= 0) {
                    $('#umkmCategoryInfo').addClass('d-none');
                    $('#umkmCategoryPlaceholder').removeClass('d-none').html(
                        '<i class="bx bx-error-circle"></i><span class="text-danger">Limit UMKM tidak ditemukan</span>'
                    );
                    $('#jumlah_pinjaman').html('<option value="">Limit tidak ditemukan</option>').prop(
                        'disabled', true);
                    $('#jumlahPinjamanHint').hide();
                    $('#loanPercentageBox').addClass('d-none');
                    $('#estimasiBox').addClass('d-none');
                    return;
                }

                $('#categoryBadge')
                    .text(category.charAt(0).toUpperCase() + category.slice(1))
                    .attr('class', 'badge category-badge ' + getBadgeClassByCategory(category).split(' ').slice(1)
                        .join(' '));

                $('#limitText').text(formatRupiah(limitAktif));
                $('#limitDasar').text(formatRupiah(masterLimit));

                if (selisih !== 0) {
                    $('#limitHistori').text(formatRupiah(limitAktif));
                    $('#breakdownHistori')
                        .removeClass('breakdown-bonus breakdown-penalty d-none')
                        .addClass(selisih > 0 ? 'breakdown-bonus' : 'breakdown-penalty');
                    $('#breakdownHistori i')
                        .removeClass('bx-trending-up bx-trending-down')
                        .addClass(selisih > 0 ? 'bx-trending-up' : 'bx-trending-down');
                    $('.breakdown-plus').removeClass('d-none');
                } else {
                    $('#breakdownHistori').addClass('d-none');
                    $('.breakdown-plus').addClass('d-none');
                }

                $('#umkmCategoryInfo').removeClass('d-none');
                $('#umkmCategoryPlaceholder').addClass('d-none');

                if (aktifFlag) {
                    $('#jumlah_pinjaman')
                        .html('<option value="">Pinjaman aktif ada — tidak dapat mengajukan baru</option>')
                        .prop('disabled', true);
                    $('#jumlahPinjamanHint').hide();
                    $('#loanPercentageBox').addClass('d-none');
                    $('#estimasiBox').addClass('d-none');
                } else {
                    $('#jumlah_pinjaman').html(generateLoanOptions(limitAktif)).prop('disabled', false);
                    $('#jumlahPinjamanHint').show();
                    $('#loanPercentageBox').removeClass('d-none');
                    $('#limitProgressMax').text(formatRupiah(limitAktif));
                    updateLoanProgress(0, limitAktif);
                    $('#estimasiBox').addClass('d-none');
                }
            }

            // =============================================
            // PROGRESS BAR
            // =============================================
            function updateLoanProgress(selectedAmount, limit) {
                const percentage = limit > 0 ? (selectedAmount / limit) * 100 : 0;
                $('#loanProgressBar').css('width', percentage + '%').attr('aria-valuenow', percentage);
                $('#loanPercentageText').text(percentage.toFixed(0) + '%');
                $('#loanProgressBar').removeClass('bg-danger bg-warning bg-success');
                if (percentage >= 80) $('#loanProgressBar').addClass('bg-danger');
                else if (percentage >= 50) $('#loanProgressBar').addClass('bg-warning');
                else $('#loanProgressBar').addClass('bg-success');
            }

            // =============================================
            // ESTIMASI
            // =============================================
            function updateEstimasi(jumlahPinjaman) {
                if (jumlahPinjaman <= 0) {
                    $('#estimasiBox').addClass('d-none');
                    return;
                }
                const bunga = jumlahPinjaman * INTEREST_RATE;
                $('#estimasiPokok').text(formatRupiah(jumlahPinjaman));
                $('#estimasiBunga').text(formatRupiah(bunga));
                $('#estimasiTotal').text(formatRupiah(jumlahPinjaman + bunga));
                $('#estimasiBox').removeClass('d-none');
            }

            // =============================================
            // LOAD DATA INITIAL
            // =============================================
            function getUMKM() {
                $.ajax({
                    url: '/v1/umkm',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        umkmDataStore = response.data || [];
                        let options = '<option value="">Pilih UMKM</option>';
                        $.each(umkmDataStore, function(i, item) {
                            options += `<option value="${item.id}">${item.nama_umkm}</option>`;
                        });
                        $('#umkm_id').html(options);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching UMKM:', error);
                    }
                });
            }
            getUMKM();

            function fetchPeminjamanData(callback) {
                $.ajax({
                    url: '/v1/peminjaman',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        peminjamanStore = response.data || [];
                        if (callback) callback();
                    },
                    error: function() {
                        peminjamanStore = [];
                        if (callback) callback();
                    }
                });
            }
            fetchPeminjamanData(function() {
                getData();
            });

            // =============================================
            // CHANGE: UMKM dipilih
            // =============================================
            $('#umkm_id').on('change', function() {
                // Clear error saat user mulai mengisi
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).closest('.mb-3').find('.invalid-feedback').remove();
                
                const selectedId = $(this).val();
                if (!selectedId) {
                    currentLimitData = null;
                    $('#umkmCategoryInfo').addClass('d-none');
                    $('#umkmCategoryPlaceholder').removeClass('d-none').html(
                        '<i class="bx bx-info-circle"></i><span>Pilih UMKM untuk melihat informasi</span>'
                    );
                    $('#alertPinjamanAktif').addClass('d-none');
                    $('#jumlah_pinjaman').html('<option value="">Pilih UMKM terlebih dahulu</option>').prop(
                        'disabled', true);
                    $('#jumlahPinjamanHint').hide();
                    $('#loanPercentageBox').addClass('d-none');
                    $('#estimasiBox').addClass('d-none');
                    return;
                }

                $('#jumlah_pinjaman').html('<option>Mengecek status...</option>').prop('disabled', true);
                $('#alertPinjamanAktif').addClass('d-none');
                $('#umkmCategoryInfo').addClass('d-none');
                $('#umkmCategoryPlaceholder').removeClass('d-none').html(
                    '<i class="bx bx-info-circle"></i><span>Memuat data limit...</span>'
                );

                $.when(
                    $.ajax({
                        url: '/v1/peminjaman',
                        type: 'GET',
                        dataType: 'json'
                    }),
                    $.ajax({
                        url: '/v1/peminjaman/detailUmkm/' + selectedId,
                        type: 'GET',
                        dataType: 'json'
                    })
                ).done(function(peminjamanRes, detailRes) {
                    peminjamanStore = (peminjamanRes[0] && peminjamanRes[0].data) || [];
                    currentLimitData = (detailRes[0] && detailRes[0].data) || null;

                    if (!currentLimitData) {
                        $('#umkmCategoryInfo').addClass('d-none');
                        $('#umkmCategoryPlaceholder').removeClass('d-none').html(
                            '<i class="bx bx-error-circle"></i><span class="text-danger">Gagal mengambil data limit</span>'
                        );
                        $('#jumlah_pinjaman').html('<option value="">Error</option>').prop(
                            'disabled', true);
                        return;
                    }

                    const selectedUmkm = umkmDataStore.find(function(item) {
                        return String(item.id) === String(selectedId);
                    });
                    renderLimitUI(selectedUmkm || {}, currentLimitData, hasPinjamanAktif(
                        selectedId));

                }).fail(function() {
                    console.error("Gagal mengambil data dari server");
                    $('#umkmCategoryPlaceholder').removeClass('d-none').html(
                        '<i class="bx bx-error-circle"></i><span class="text-danger">Error koneksi</span>'
                    );
                    $('#jumlah_pinjaman').html('<option>Error memuat data</option>').prop(
                        'disabled', true);
                });
            });

            // =============================================
            // CHANGE: Pilihan pinjaman
            // =============================================
            $('#jumlah_pinjaman').on('change', function() {
                // Clear error saat user mulai mengisi
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).closest('.mb-3').find('.invalid-feedback').remove();
                
                const selectedAmount = parseFloat($(this).val()) || 0;
                const limitAktif = currentLimitData ? (parseFloat(currentLimitData.limit_saat_ini) || 0) : 0;
                updateLoanProgress(selectedAmount, limitAktif);
                updateEstimasi(selectedAmount);
            });

            // =============================================
            // CHANGE: Catatan
            // =============================================
            $('#catatan').on('input', function() {
                // Clear error saat user mulai mengisi
                $(this).removeClass('is-invalid').addClass('is-valid');
                $(this).closest('.mb-3').find('.invalid-feedback').remove();
            });

            // =============================================
            // RESET FORM
            // =============================================
            $('#basicModal').on('show.bs.modal', function() {
                // Reset form
                $('#upsertDataForm')[0].reset();
                $('#id').val('');
                $('#modalTitle').text('Tambah Peminjaman');
                
                // Reset validasi
                if (formValidator) {
                    formValidator.resetForm();
                }
                
                // Clear semua error
                clearManualErrors();
                
                // Reset tampilan
                currentLimitData = null;
                $('#umkmCategoryInfo').addClass('d-none');
                $('#umkmCategoryPlaceholder').removeClass('d-none').html(
                    '<i class="bx bx-info-circle"></i><span>Pilih UMKM untuk melihat informasi</span>'
                );
                $('#alertPinjamanAktif').addClass('d-none');
                $('#jumlah_pinjaman').html('<option value="">Pilih UMKM terlebih dahulu</option>').prop(
                    'disabled', true);
                $('#jumlahPinjamanHint').hide();
                $('#loanPercentageBox').addClass('d-none');
                $('#estimasiBox').addClass('d-none');
            });

            // Event saat modal ditutup (hidden.bs.modal)
            $('#basicModal').on('hidden.bs.modal', function() {
                // Reset form
                $('#upsertDataForm')[0].reset();
                
                // Reset validasi
                if (formValidator) {
                    formValidator.resetForm();
                }
                
                // Clear semua error dan validasi visual
                clearManualErrors();
                
                // Remove all validation classes
                $('#upsertDataForm').find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
                
                // Reset tampilan ke default
                currentLimitData = null;
                $('#umkmCategoryInfo').addClass('d-none');
                $('#umkmCategoryPlaceholder').removeClass('d-none').html(
                    '<i class="bx bx-info-circle"></i><span>Pilih UMKM untuk melihat informasi</span>'
                );
                $('#alertPinjamanAktif').addClass('d-none');
                $('#jumlah_pinjaman').html('<option value="">Pilih UMKM terlebih dahulu</option>').prop(
                    'disabled', true);
                $('#jumlahPinjamanHint').hide();
                $('#loanPercentageBox').addClass('d-none');
                $('#estimasiBox').addClass('d-none');
                
                // Reset select options ke default
                $('#umkm_id').val('').trigger('change.select2'); // jika pakai select2
            });

            // Handler untuk tombol close/cancel (opsional - double safety)
            $('#basicModal').on('click', '[data-bs-dismiss="modal"]', function() {
                // Trigger manual reset
                clearManualErrors();
                if (formValidator) {
                    formValidator.resetForm();
                }
            });

            // =============================================
            // getData — Render tabel utama
            // =============================================
            function getData() {
                $.ajax({
                    url: '/v1/peminjaman',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if ($.fn.DataTable.isDataTable('#table')) $('#table').DataTable().destroy();
                        let tableBody = "";
                        if (!response.data || response.data.length === 0) {
                            $("#table tbody").html('');
                            $('#table').DataTable(getDataTableConfig(true));
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
                                "' title='Periksa' style='font-size:11px;text-transform:lowercase;'>" +
                                "<i class='bx bx-search-alt me-1'></i>periksa</button>";
                            tableBody += "</td></tr>";
                        });
                        $("#table tbody").html(tableBody);
                        $('#table').DataTable(getDataTableConfig(false));
                    },
                    error: function() {
                        console.log("Gagal mengambil data dari server");
                        if ($.fn.DataTable.isDataTable('#table')) $('#table').DataTable().destroy();
                        $("#table tbody").html('');
                        $('#table').DataTable(getDataTableConfig('error'));
                    }
                });
            }

            function getDataTableConfig(state) {
                let emptyMsg = '';
                if (state === true) {
                    emptyMsg =
                        `<div class="text-center py-4"><div class="mb-3"><i class="bx bx-data bx-lg text-muted"></i></div><h6 class="text-muted">Data Tidak Tersedia</h6><p class="text-muted small mb-0">Belum ada data peminjaman yang ditambahkan</p></div>`;
                } else if (state === 'error') {
                    emptyMsg =
                        `<div class="text-center py-4"><div class="mb-3"><i class="bx bx-error-circle bx-lg text-danger"></i></div><h6 class="text-danger">Gagal Memuat Data</h6><p class="text-muted small mb-0">Terjadi kesalahan saat mengambil data dari server</p></div>`;
                }
                return {
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
                        zeroRecords: `<div class="text-center py-4"><div class="mb-3"><i class="bx bx-data bx-lg text-muted"></i></div><h6 class="text-muted">Data Tidak Ditemukan</h6><p class="text-muted small mb-0">Tidak ada data yang sesuai dengan pencarian Anda</p></div>`,
                        info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                        infoEmpty: "Tidak ada data yang tersedia",
                        infoFiltered: "(difilter dari _MAX_ total data)",
                        paginate: {
                            first: "Pertama",
                            last: "Terakhir",
                            next: "Selanjutnya",
                            previous: "Sebelumnya"
                        },
                        emptyTable: emptyMsg ||
                            `<div class="text-center py-4"><div class="mb-3"><i class="bx bx-data bx-lg text-muted"></i></div><h6 class="text-muted">Data Tidak Tersedia</h6><p class="text-muted small mb-0">Belum ada data peminjaman yang ditambahkan</p></div>`
                    },
                    pageLength: 10,
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "Semua"]
                    ]
                };
            }

            // =============================================
            // Simpan Data
            // =============================================
            $(document).on('click', '#simpanData', function(e) {
                e.preventDefault();
                
                // Clear semua error manual sebelum validasi
                clearManualErrors();
                
                // Validasi form
                if (!$("#upsertDataForm").valid()) {
                    return false;
                }

                let id = $('#id').val();
                let formData = new FormData($('#upsertDataForm')[0]);
                let url = id ? `/v1/peminjaman/update/${id}` : '/v1/peminjaman/create';

                // Disable tombol untuk mencegah double submit
                const $btn = $(this);
                const originalText = $btn.html();
                $btn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i> Menyimpan...');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Reset tombol
                        $btn.prop('disabled', false).html(originalText);
                        
                        if (response.code === 422 && response.errors) {
                            // Handle validation errors dari server
                            $.each(response.errors, function(key, value) {
                                showFieldError(key, Array.isArray(value) ? value[0] : value);
                            });
                        } else if (response.status === 'error') {
                            // Tampilkan pesan error di field catatan (sebagai fallback)
                            showFieldError('catatan', response.message || 'Terjadi kesalahan saat menyimpan data');
                        } else if (response.status === 'success') {
                            // Sukses - tutup modal dan reload data
                            const modal = bootstrap.Modal.getInstance(document.getElementById('basicModal'));
                            if (modal) {
                                modal.hide();
                                
                                // Reset setelah modal tertutup
                                $('#basicModal').one('hidden.bs.modal', function() {
                                    // Extra cleanup setelah modal benar-benar tertutup
                                    $('#upsertDataForm')[0].reset();
                                    if (formValidator) {
                                        formValidator.resetForm();
                                    }
                                    clearManualErrors();
                                });
                            }
                            
                            // Refresh data
                            fetchPeminjamanData();
                            getData();
                            
                            // Tampilkan notifikasi sukses (optional - bisa menggunakan toast)
                            console.log('✓ ' + (response.message || 'Data berhasil disimpan'));
                        }
                    },
                    error: function(xhr) {
                        // Reset tombol
                        $btn.prop('disabled', false).html(originalText);
                        
                        let errorMsg = 'Terjadi kesalahan saat menyimpan data';
                        
                        if (xhr.responseJSON) {
                            if (xhr.responseJSON.errors) {
                                // Handle validation errors
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    showFieldError(key, Array.isArray(value) ? value[0] : value);
                                });
                                return;
                            } else if (xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            } else if (xhr.responseJSON.error) {
                                errorMsg = xhr.responseJSON.error;
                            }
                        }
                        
                        // Tampilkan error di field catatan sebagai fallback
                        showFieldError('catatan', errorMsg);
                    }
                });
            });

            // =============================================
            // Detail (Periksa)
            // =============================================
            $(document).on('click', '.periksa-btn', function() {
                var id = $(this).data('id');
                currentPeminjamanId = id;
                lastInvoiceCanvas = null; // reset canvas lama

                var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                detailModal.show();

                $('#downloadInvoiceBtn').hide();
                $('#detailLoading').show();
                $('#detailContent').hide();
                $('#approveBtn').hide();

                $.ajax({
                    url: '/v1/peminjaman/detail/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            var data = response.data;

                            $('#detailJumlahPinjaman').text(formatRupiah(data.jumlah_pinjaman));
                            $('#detailSisaPinjaman').text(formatRupiah(data.sisa_pinjaman));
                            $('#detailTanggalPengajuan').text(formatTanggal(data
                                .tanggal_pengajuan));
                            $('#detailTanggalDisetujui').text(formatTanggal(data
                                .tanggal_disetujui));
                            $('#detailBatasPengembalian').text(formatTanggal(data
                                .batas_pengembalian));
                            $('#detailCatatan').text(data.catatan || '-');

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
                                    $('#approveBtn').show();
                                    break;
                                default:
                                    statusBadge =
                                        '<span class="badge bg-secondary fs-5 px-4 py-2">' +
                                        data.status + '</span>';
                                    $('#approveBtn').hide();
                            }
                            $('#detailStatusBadge').html(statusBadge);

                            // Download Invoice muncul di semua status
                            $('#downloadInvoiceBtn').show();

                            // Isi template invoice (hidden) dari data yang sama
                            populateInvoiceTemplate(data);

                            if (data.umkm) {
                                $('#detailNamaUmkm').text(data.umkm.nama_umkm || '-');
                                $('#detailNamaPemilik').text(data.umkm.nama_pemilik || '-');
                                $('#detailNoKtp').text(data.umkm.no_ktp || '-');
                                $('#detailTtl').text((data.umkm.tempat_lahir || '') + ', ' +
                                    formatTanggal(data.umkm.tanggal_lahir));
                                $('#detailAlamatPemilik').text(data.umkm.alamat_pemilik || '-');
                                $('#detailAlamatUsaha').text(data.umkm.alamat_usaha || '-');
                                $('#detailJenisUmkm').text(data.umkm.jenis_umkm || '-');
                            }

                            var statusLower = data.status.toLowerCase();
                            if (statusLower === 'disetujui' || statusLower === 'lunas') {
                                renderCicilanCard(data.jumlah_pinjaman);
                            } else {
                                $('#cicilan-card').addClass('d-none');
                            }

                            // Riwayat pengembalian
                            var pengembalianHtml = '';
                            if (data.pengembalian && data.pengembalian.length > 0) {
                                pengembalianHtml =
                                    '<div class="table-responsive"><table class="table table-striped table-hover table-redwhite">';
                                pengembalianHtml +=
                                    '<thead class="table-light"><tr><th>No</th><th>Jumlah Pengembalian</th><th>Tanggal Pengembalian</th></tr></thead><tbody>';
                                $.each(data.pengembalian, function(index, item) {
                                    pengembalianHtml += '<tr><td>' + (index + 1) +
                                        '</td>';
                                    pengembalianHtml +=
                                        '<td class="fw-bold text-danger">' +
                                        formatRupiah(item.jumlah_pengembalian) +
                                        '</td>';
                                    pengembalianHtml += '<td>' + formatTanggal(item
                                        .tanggal_pengembalian) + '</td></tr>';
                                });
                                pengembalianHtml += '</tbody></table></div>';
                            } else {
                                pengembalianHtml =
                                    `<div class="text-center py-4"><i class="bx bx-info-circle bx-lg text-muted"></i><p class="text-muted mt-2 mb-0">Belum ada riwayat pengembalian</p></div>`;
                            }
                            $('#pengembalianContent').html(pengembalianHtml);

                            $('#detailLoading').hide();
                            $('#detailContent').fadeIn();
                        } else {
                            console.error('Gagal mengambil detail data');
                            detailModal.hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching detail:', error);
                        detailModal.hide();
                    }
                });
            });

            // =============================================
            // Render Jadwal Cicilan (detail modal)
            // =============================================
            function renderCicilanCard(pokok) {
                pokok = parseFloat(pokok) || 0;
                if (pokok <= 0) {
                    $('#cicilan-card').addClass('d-none');
                    return;
                }

                var totalBunga = pokok * INTEREST_RATE;
                var totalPengembalian = pokok + totalBunga;
                var pokokPerBulan = pokok / TOTAL_MONTHS;
                var bungaPerBulan = pokok * RATE_PER_MONTH;
                var cicilanPerBulan = pokokPerBulan + bungaPerBulan;

                $('#cs-pokok').text(formatRupiah(pokok));
                $('#cs-bunga').text(formatRupiah(totalBunga));
                $('#cs-total').text(formatRupiah(totalPengembalian));
                $('#cs-perbulan').text(formatRupiah(cicilanPerBulan));

                var tbody = '',
                    saldo = pokok;
                for (var i = 1; i <= TOTAL_MONTHS; i++) {
                    saldo -= pokokPerBulan;
                    tbody += '<tr>';
                    tbody += '<td class="text-center fw-bold">Bulan ke-' + i + '</td>';
                    tbody += '<td class="text-end">' + formatRupiah(pokokPerBulan) + '</td>';
                    tbody += '<td class="text-end text-warning fw-bold">' + formatRupiah(bungaPerBulan) + '</td>';
                    tbody += '<td class="text-end text-danger fw-bold">' + formatRupiah(cicilanPerBulan) + '</td>';
                    tbody += '<td class="text-end text-muted">' + formatRupiah(Math.max(saldo, 0)) + '</td>';
                    tbody += '</tr>';
                }
                $('#cicilan-tbody').html(tbody);
                $('#cicilan-foot-pokok').text(formatRupiah(pokok));
                $('#cicilan-foot-bunga').text(formatRupiah(totalBunga));
                $('#cicilan-foot-total').text(formatRupiah(totalPengembalian));
                $('#cicilan-card').removeClass('d-none');
            }

            // =============================================
            // Approve Peminjaman
            // =============================================
            $(document).on('click', '#approveBtn', function() {
                if (!currentPeminjamanId) {
                    console.error('ID Peminjaman tidak ditemukan');
                    return;
                }
                
                if (!confirm('Apakah Anda yakin ingin menyetujui peminjaman ini?')) {
                    return;
                }
                
                const $btn = $(this);
                const originalText = $btn.html();
                $btn.prop('disabled', true).html('<i class="bx bx-loader-alt bx-spin me-1"></i> Memproses...');
                
                $.ajax({
                    url: '/v1/peminjaman/approve/' + currentPeminjamanId,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $btn.prop('disabled', false).html(originalText);
                        
                        if (response.status === 'success') {
                            var detailModal = bootstrap.Modal.getInstance(
                                document.getElementById('detailModal'));
                            if (detailModal) detailModal.hide();
                            
                            fetchPeminjamanData();
                            getData();
                            
                            console.log('✓ Peminjaman berhasil disetujui');
                        } else {
                            console.error('Gagal menyetujui peminjaman:', response.message);
                        }
                    },
                    error: function(xhr) {
                        $btn.prop('disabled', false).html(originalText);
                        
                        let msg = 'Terjadi kesalahan saat menyetujui peminjaman';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        console.error('Error:', msg);
                    }
                });
            });

            // =============================================
            // INVOICE — populate hidden template
            // =============================================
            function populateInvoiceTemplate(data) {
                const pokok = parseFloat(data.jumlah_pinjaman) || 0;
                const bunga = pokok * INTEREST_RATE;
                const sisaTotal = pokok + bunga;
                const invNumber = 'INV-' + String(data.id).padStart(6, '0');
                const invDate = formatTanggal(data.tanggal_pengajuan);

                $('#inv-number').text(invNumber);
                $('#inv-number2').text(invNumber);
                $('#inv-date').text(invDate);
                $('#invoicePreviewSubtitle').text(invNumber);

                $('#inv-nama-umkm').text(data.umkm?.nama_umkm || '-');
                $('#inv-nama-pemilik').text(data.umkm?.nama_pemilik || '-');
                $('#inv-no-ktp').text(data.umkm?.no_ktp || '-');
                $('#inv-alamat-usaha').text(data.umkm?.alamat_usaha || '-');

                $('#inv-pokok').text(formatRupiah(pokok));
                $('#inv-bunga').text(formatRupiah(bunga));
                $('#inv-total').text(formatRupiah(sisaTotal));
                $('#inv-total-breakdown').text('Pokok ' + formatRupiah(pokok) + ' + Bunga ' + formatRupiah(bunga));

                // RIWAYAT PENGEMBALIAN
                let pengembalianTbody = '';
                let totalPengembalian = 0;

                if (data.pengembalian && data.pengembalian.length > 0) {
                    $('#inv-no-pengembalian').hide();
                    $('#inv-pengembalian-tfoot').show();

                    data.pengembalian.forEach((item, index) => {
                        const jumlah = parseFloat(item.jumlah_pengembalian) || 0;
                        totalPengembalian += jumlah;
                        const bg = (index % 2 === 1) ? '#fff5f5' : '#fff';

                        pengembalianTbody += `<tr style="background:${bg};">
                <td style="padding:8px;text-align:center;font-weight:600;color:#343a40;">${index + 1}</td>
                <td style="padding:8px;text-align:right;color:#c82333;font-weight:700;">${formatRupiah(jumlah)}</td>
                <td style="padding:8px;text-align:center;color:#343a40;">${formatTanggal(item.tanggal_pengembalian)}</td>
            </tr>`;
                    });

                    $('#inv-foot-total-pengembalian').text(formatRupiah(totalPengembalian));
                } else {
                    $('#inv-pengembalian-tfoot').hide();
                    $('#inv-no-pengembalian').show();
                    pengembalianTbody = '';
                }

                $('#inv-pengembalian-tbody').html(pengembalianTbody);

                $('#inv-footer-text').text('Dokumen ini dihasilkan oleh Sistem Peminjaman UMKM  |  ' + invDate);
            }

            // =============================================
            // INVOICE — klik "Download Invoice" → buka preview modal
            // =============================================
            $(document).on('click', '#downloadInvoiceBtn', async function() {
                // Buka modal preview
                var previewModal = new bootstrap.Modal(document.getElementById('invoicePreviewModal'));
                $('#invoicePreviewLoading').show();
                $('#invoicePreviewImageWrap').addClass('d-none');
                previewModal.show();

                try {
                    // Render hidden template → canvas
                    const element = document.getElementById('invoiceTemplate');
                    lastInvoiceCanvas = await html2canvas(element, {
                        scale: 2,
                        useCORS: true,
                        allowTaint: true,
                        backgroundColor: '#ffffff'
                    });

                    // Taruh sebagai <img> di preview
                    $('#invoicePreviewImage').attr('src', lastInvoiceCanvas.toDataURL('image/png'));
                    $('#invoicePreviewImageWrap').removeClass('d-none');
                } catch (err) {
                    console.error('Preview render error:', err);
                    $('#invoicePreviewImageWrap').removeClass('d-none');
                    $('#invoicePreviewImage').attr('src', '');
                } finally {
                    $('#invoicePreviewLoading').hide();
                }
            });

            // =============================================
            // INVOICE — klik "Download PDF" di preview modal
            //   → pakai canvas yang sudah ada, tidak render ulang
            // =============================================
            $(document).on('click', '#downloadInvoicePdfBtn', function() {
                if (!lastInvoiceCanvas) return; // safety

                const {
                    jsPDF
                } = window.jspdf;
                const pdf = new jsPDF('p', 'mm', 'a4');
                const pdfW = pdf.internal.pageSize.getWidth();
                const pdfH = pdf.internal.pageSize.getHeight();
                const ratio = lastInvoiceCanvas.width / lastInvoiceCanvas.height;

                let drawW = pdfW;
                let drawH = drawW / ratio;
                if (drawH > pdfH) {
                    drawH = pdfH;
                    drawW = drawH * ratio;
                }

                const offsetX = (pdfW - drawW) / 2;
                const imgData = lastInvoiceCanvas.toDataURL('image/png');

                pdf.addImage(imgData, 'PNG', offsetX, 0, drawW, drawH);
                pdf.save(`Invoice_Peminjaman_${currentPeminjamanId}.pdf`);
            });
        });
    </script>

    <style>
        /* ============================================= */
        /* SWAL z-index */
        /* ============================================= */
        .swal2-container {
            z-index: 10000 !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
            padding-right: calc(1.5em + 0.75rem);
        }

        small.text-danger {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.875rem;
        }

        /* ============================================= */
        /* FORM SECTIONS */
        /* ============================================= */
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

        .modern-textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-hint {
            display: block;
            margin-top: 0.375rem;
            font-size: 0.8rem;
            color: #6c757d;
        }

        .form-hint i {
            font-size: 0.85rem;
            margin-right: 0.25rem;
        }

        /* ============================================= */
        /* CATEGORY INFO CARD */
        /* ============================================= */
        .category-info-card {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
            border: 1.5px solid #ffcccc;
            border-radius: 12px;
            padding: 1rem;
            min-height: 115px;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }

        .category-info-card:hover {
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.15);
            transform: translateY(-2px);
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .category-header i {
            font-size: 1.1rem;
        }

        .category-badge {
            font-size: 0.75rem;
            padding: 0.35em 0.8em;
            border-radius: 6px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .limit-display {
            text-align: right;
        }

        .limit-label {
            font-size: 0.7rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 0.25rem;
        }

        .limit-value {
            font-size: 1.1rem;
            font-weight: 700;
            color: #dc3545;
            line-height: 1;
        }

        .limit-breakdown-enhanced {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            font-size: 0.75rem;
        }

        .breakdown-item {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.6rem;
            background: white;
            border-radius: 6px;
            border: 1px solid #f0f0f0;
            white-space: nowrap;
        }

        .breakdown-item i {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .breakdown-label {
            color: #6c757d;
            font-size: 0.7rem;
        }

        .breakdown-item strong {
            color: #495057;
            font-weight: 600;
            margin-left: 0.25rem;
        }

        .breakdown-bonus {
            border-color: #d4edda;
            background: #f1f9f3;
        }

        .breakdown-bonus i,
        .breakdown-bonus strong {
            color: #28a745;
        }

        .breakdown-penalty {
            border-color: #f8d7da;
            background: #fff5f5;
        }

        .breakdown-penalty i,
        .breakdown-penalty strong {
            color: #dc3545;
        }

        .breakdown-operator {
            font-size: 1rem;
            font-weight: 700;
            color: #adb5bd;
            padding: 0 0.25rem;
        }

        .category-placeholder-card {
            background: #fdfdfd;
            border: 1.5px dashed #dee2e6;
            border-radius: 12px;
            padding: 1rem;
            min-height: 115px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: #6c757d;
            font-size: 0.85rem;
            text-align: center;
        }

        .category-placeholder-card i {
            font-size: 1.25rem;
            color: #adb5bd;
        }

        .alert-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }

        /* ============================================= */
        /* LOAN PROGRESS CARD */
        /* ============================================= */
        .loan-progress-card {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
            border: 1.5px solid #ffcccc;
            border-radius: 12px;
            padding: 1rem;
            min-height: 115px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0.5rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.375rem;
        }

        .progress-label {
            font-size: 0.75rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            font-weight: 600;
        }

        .progress-percentage {
            font-size: 1rem;
            font-weight: 700;
            color: #dc3545;
        }

        .modern-progress {
            height: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.7);
            overflow: hidden;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .modern-progress .progress-bar {
            transition: width 0.4s ease, background-color 0.4s ease;
            border-radius: 10px;
        }

        .progress-footer {
            display: flex;
            justify-content: space-between;
            font-size: 0.7rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        /* ============================================= */
        /* ESTIMASI CARD */
        /* ============================================= */
        .estimasi-card {
            background: linear-gradient(135deg, #fffbf0 0%, #fff3dc 100%);
            border: 1.5px solid #ffe0b2;
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }

        .estimasi-label {
            font-size: 0.78rem;
            font-weight: 600;
            color: #856404;
        }

        .estimasi-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.2rem 0;
            border-bottom: 1px solid rgba(255, 193, 7, 0.2);
        }

        .estimasi-row:last-child {
            border-bottom: none;
        }

        .estimasi-total {
            margin-top: 0.25rem;
            padding-top: 0.35rem;
            border-top: 2px solid #ffc107 !important;
            border-bottom: none !important;
        }

        /* ============================================= */
        /* MODAL FOOTER BUTTONS */
        /* ============================================= */
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

        /* ============================================= */
        /* RESPONSIVE — form */
        /* ============================================= */
        @media (max-width: 768px) {
            .category-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .limit-display {
                text-align: left;
                width: 100%;
            }

            .limit-breakdown-enhanced {
                flex-direction: column;
                align-items: stretch;
            }

            .breakdown-item {
                justify-content: space-between;
            }
        }

        /* ============================================= */
        /* DETAIL MODAL — RED WHITE THEME */
        /* ============================================= */
        #detailModal .detail-modal-redwhite {
            border: none;
            box-shadow: 0 0.5rem 2rem rgba(220, 53, 69, 0.2);
        }

        #detailModal .bg-gradient-red {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }

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

        #detailModal .card-history-redwhite .bg-gradient-red-light {
            background: linear-gradient(135deg, #ffe5e8 0%, #fff5f5 100%);
            border-bottom: 2px solid #dc3545;
        }

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

        #detailModal .bg-light-red {
            border-top: 1px solid #ffe0e0;
            padding: 1.25rem;
            background: #fff5f5;
        }

        #detailModal .table-redwhite tbody tr:nth-of-type(odd) {
            background-color: rgba(220, 53, 69, 0.05);
        }

        #detailModal .table-redwhite tbody tr:hover {
            background-color: rgba(220, 53, 69, 0.1);
        }

        #detailModal .spinner-border.text-danger {
            width: 3rem;
            height: 3rem;
        }

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

        /* ============================================= */
        /* JADWAL CICILAN */
        /* ============================================= */
        .cicilan-summary-box {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
            border: 1px solid #ffcccc;
            border-radius: 10px;
            padding: 12px 14px;
            text-align: center;
            height: 100%;
        }

        .cicilan-summary-label {
            font-size: 0.72rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 6px;
        }

        .cicilan-summary-label i {
            color: #dc3545;
        }

        .cicilan-summary-value {
            font-size: 1rem;
            font-weight: 700;
            color: #dc3545;
        }

        #cicilan-card tfoot .cicilan-tfoot-row td {
            background: linear-gradient(135deg, #fff0f0 0%, #ffe0e0 100%);
            border-top: 2px solid #dc3545 !important;
            padding: 0.7rem 0.5rem;
        }

        #cicilan-card tfoot .cicilan-tfoot-row td:first-child {
            border-radius: 0 0 0 8px;
        }

        #cicilan-card tfoot .cicilan-tfoot-row td:last-child {
            border-radius: 0 0 8px 0;
        }

        /* ============================================= */
        /* INVOICE TEMPLATE — tersembunyi di luar viewport */
        /* ============================================= */
        .invoice-template-hidden {
            position: absolute;
            left: -9999px;
            top: 0;
            width: 794px;
            background: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* top bar */
        .inv-top-bar {
            background: linear-gradient(135deg, #dc3545, #c82333);
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .inv-top-title {
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .inv-top-number {
            color: #fff;
            font-size: 13px;
            font-weight: 500;
        }

        /* sub header */
        .inv-sub-header {
            margin: 18px 28px 0;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 12px 18px;
            display: flex;
            gap: 80px;
        }

        .inv-sub-label {
            font-size: 10px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 3px;
        }

        .inv-sub-value {
            font-size: 13px;
            font-weight: 600;
            color: #343a40;
        }

        .inv-sub-value--red {
            color: #dc3545;
        }

        /* section */
        .inv-section {
            margin: 18px 28px 0;
        }

        .inv-section-header {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border-radius: 6px;
            padding: 8px 16px;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
        }

        /* tables inside invoice */
        .inv-table {
            width: 100%;
            border-collapse: collapse;
        }

        .inv-row--alt {
            background: #fff5f5;
        }

        .inv-td-label {
            padding: 10px 16px;
            width: 160px;
            font-size: 11px;
            color: #6c757d;
        }

        .inv-td-value {
            padding: 10px 16px;
            font-size: 11px;
            font-weight: 600;
            color: #343a40;
        }

        .inv-td-value--right {
            text-align: right;
        }

        .inv-td-value--gold {
            color: #856404;
        }

        /* total box */
        .inv-total-box {
            margin: 14px 28px 0;
            background: linear-gradient(135deg, #dc3545, #c82333);
            border-radius: 10px;
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .inv-total-label {
            color: #ffcccc;
            font-size: 10px;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .inv-total-value {
            color: #fff;
            font-size: 26px;
            font-weight: 700;
        }

        .inv-total-breakdown {
            color: #ffcccc;
            font-size: 10px;
            text-align: right;
        }

        /* cicilan table */
        .inv-table--cicilan {
            font-size: 11px;
        }

        .inv-thead-row {
            background: #f0f0f0;
        }

        .inv-th {
            padding: 8px;
            color: #dc3545;
            font-weight: 600;
        }

        .inv-th--center {
            text-align: center;
            width: 14%;
        }

        .inv-th--right {
            text-align: right;
        }

        .inv-tfoot-row {
            background: #ffe8e8;
            border-top: 2px solid #dc3545;
        }

        .inv-td-foot {
            padding: 9px;
            font-weight: 700;
            color: #c82333;
        }

        .inv-td-foot--center {
            text-align: center;
        }

        .inv-td-foot--right {
            text-align: right;
        }

        .inv-td-foot--gold {
            color: #856404;
        }

        .inv-td-foot--muted {
            color: #6c757d;
            font-weight: 400;
        }

        /* catatan */
        .inv-catatan {
            margin: 16px 28px 0;
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 14px 18px;
        }

        .inv-catatan-title {
            font-size: 11px;
            font-weight: 700;
            color: #856404;
            margin-bottom: 6px;
        }

        .inv-catatan-body {
            font-size: 10px;
            color: #856404;
            line-height: 1.7;
        }

        /* bottom bar */
        .inv-bottom-bar {
            margin-top: 24px;
            background: linear-gradient(135deg, #dc3545, #c82333);
            padding: 10px;
            text-align: center;
        }

        .inv-bottom-bar span {
            color: #fff;
            font-size: 10px;
        }

        /* ============================================= */
        /* INVOICE PREVIEW MODAL */
        /* ============================================= */
        .invoice-preview-dialog {
            max-width: 860px;
        }

        .invoice-preview-modal-content {
            border: none;
            border-radius: 14px;
            /* overflow: hidden; */
            box-shadow: 0 1rem 3rem rgba(220, 53, 69, 0.25);
        }

        /* header */
        .invoice-preview-header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .invoice-preview-icon-wrap {
            width: 42px;
            height: 42px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .invoice-preview-icon-wrap i {
            font-size: 1.4rem;
            color: #fff;
        }

        /* body / preview area */
        .invoice-preview-body {
            background: #f0f2f5;
            padding: 1.5rem;
            max-height: 72vh;
            overflow-y: auto;
            position: relative;
            min-height: 200px;
        }

        .invoice-preview-loading {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #f0f2f5;
            z-index: 2;
        }

        .invoice-preview-image-wrap {
            text-align: center;
        }

        .invoice-preview-img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.12);
            display: inline-block;
        }

        /* footer */
        .invoice-preview-footer {
            background: #fff;
            border-top: 1px solid #ffe0e0;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }

        .btn-invoice-action {
            padding: 0.6rem 1.4rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.88rem;
            transition: all 0.2s ease;
        }

        .btn-invoice-action:hover {
            opacity: 0.85;
        }

        .btn-invoice-download {
            padding: 0.6rem 1.6rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.92rem;
            border: none;
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: #fff;
            box-shadow: 0 3px 10px rgba(220, 53, 69, 0.35);
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
        }

        .btn-invoice-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 16px rgba(220, 53, 69, 0.45);
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            color: #fff;
        }

        .btn-invoice-download i {
            font-size: 1.05rem;
        }

        /* Riwayat Pengembalian Table */
        .inv-table--pengembalian {
            font-size: 11px;
        }

        /* Empty State di Invoice */
        .inv-empty-state {
            padding: 24px;
            text-align: center;
            color: #6c757d;
            background: #f8f9fa;
            border-radius: 6px;
            margin-top: 8px;
        }

        .inv-empty-state i {
            font-size: 28px;
            display: block;
            margin-bottom: 8px;
            color: #adb5bd;
        }

        .inv-empty-state span {
            font-size: 11px;
            color: #6c757d;
        }
    </style>
@endsection
