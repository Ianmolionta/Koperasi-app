@extends('Layouts.Base')
@section('content')
    <div class="dashboard-container">
        <!-- Header Section -->
        <div class="dashboard-header mb-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="dashboard-title">Dashboard Analytics</h1>
                    <p class="dashboard-subtitle">Monitor performa koperasi dan aktivitas UMKM secara real-time</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="date-badge">
                        <i class="bx bx-calendar"></i>
                        <span id="currentDate"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Row -->
        <div class="row g-4 mb-4" id="statsCards">
            <!-- Total UMKM Card -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card stat-card-primary">
                    <div class="stat-card-body">
                        <div class="stat-card-icon">
                            <i class="bx bx-store-alt"></i>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-label">Total UMKM</div>
                            <div class="stat-card-value" id="totalUmkm">
                                <div class="skeleton-loader"></div>
                            </div>
                            <div class="stat-card-trend">
                                <i class="bx bx-trending-up"></i>
                                <span>Terdaftar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Mentor Card -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card stat-card-success">
                    <div class="stat-card-body">
                        <div class="stat-card-icon">
                            <i class="bx bx-user-circle"></i>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-label">Total Mentor</div>
                            <div class="stat-card-value" id="totalMentor">
                                <div class="skeleton-loader"></div>
                            </div>
                            <div class="stat-card-trend">
                                <i class="bx bx-group"></i>
                                <span>Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Koperasi Card -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card stat-card-warning">
                    <div class="stat-card-body">
                        <div class="stat-card-icon">
                            <i class="bx bx-wallet"></i>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-label">Modal Koperasi</div>
                            <div class="stat-card-value" id="modalKoperasi">
                                <div class="skeleton-loader"></div>
                            </div>
                            <div class="stat-card-trend">
                                <i class="bx bx-chart"></i>
                                <span>Total Limit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Keuntungan Card -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card stat-card-info">
                    <div class="stat-card-body">
                        <div class="stat-card-icon">
                            <i class="bx bx-trending-up"></i>
                        </div>
                        <div class="stat-card-content">
                            <div class="stat-card-label">Total Keuntungan</div>
                            <div class="stat-card-value" id="totalKeuntungan">
                                <div class="skeleton-loader"></div>
                            </div>
                            <div class="stat-card-trend">
                                <i class="bx bx-dollar-circle"></i>
                                <span>Dari Bunga 2%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- UMKM Type Analysis Section -->
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="umkm-analysis-card">
                    <div class="umkm-analysis-header">
                        <div class="umkm-analysis-icon">
                            <i class="bx bx-bar-chart-alt-2"></i>
                        </div>
                        <div>
                            <h5 class="umkm-analysis-title">Analisis Per Jenis UMKM</h5>
                            <p class="umkm-analysis-subtitle">Breakdown pinjaman, pengembalian, dan pendapatan bunga berdasarkan jenis usaha</p>
                        </div>
                    </div>
                    <div class="umkm-analysis-body" id="umkmAnalysis">
                        <!-- Loading State -->
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="skeleton-loader" style="height: 150px;"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="skeleton-loader" style="height: 150px;"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="skeleton-loader" style="height: 150px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts & Activity Row -->
        <div class="row g-4">
            <!-- Revenue Chart -->
            <div class="col-xl-8">
                <div class="chart-card">
                    <div class="chart-card-header">
                        <div>
                            <h5 class="chart-card-title">Grafik Peminjaman</h5>
                            <p class="chart-card-subtitle">Berdasarkan pinjaman yang telah lunas</p>
                        </div>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <span class="legend-color legend-color-success"></span>
                                <span>Lunas</span>
                            </div>
                        </div>
                    </div>
                    <div class="chart-card-body">
                        <canvas id="revenueChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- UMKM List for Activity -->
            <div class="col-xl-4">
                <div class="activity-card">
                    <div class="activity-card-header">
                        <h5 class="activity-card-title">Aktivitas UMKM</h5>
                        <p class="activity-card-subtitle">Klik nama UMKM untuk melihat riwayat aktivitas</p>
                    </div>
                    <div class="activity-search-wrap">
                        <div class="activity-search-box">
                            <i class="bx bx-search"></i>
                            <input type="text" id="umkmSearchInput" placeholder="Cari nama UMKM..." autocomplete="off">
                        </div>
                    </div>
                    <div class="activity-card-body" id="umkmList">
                        <!-- Loading State -->
                        <div class="activity-loader">
                            <div class="skeleton-activity"></div>
                            <div class="skeleton-activity"></div>
                            <div class="skeleton-activity"></div>
                            <div class="skeleton-activity"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profit Details Card -->
        <div class="row g-4 mt-2">
            <div class="col-12">
                <div class="profit-card">
                    <div class="profit-card-header">
                        <div class="profit-icon">
                            <i class="bx bx-line-chart"></i>
                        </div>
                        <div>
                            <h5 class="profit-card-title text-white">Detail Keuntungan Bersih</h5>
                            <p class="profit-card-subtitle">Perhitungan bunga 2% dari total pinjaman yang lunas</p>
                        </div>
                    </div>
                    <div class="profit-card-body">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="profit-item">
                                    <div class="profit-item-label">Total Pinjaman Lunas</div>
                                    <div class="profit-item-value" id="totalPinjamanLunas">
                                        <div class="skeleton-loader"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="profit-item">
                                    <div class="profit-item-label">Bunga 2%</div>
                                    <div class="profit-item-value text-success" id="bungaPersen">
                                        <div class="skeleton-loader"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="profit-item profit-item-highlight">
                                    <div class="profit-item-label">Keuntungan Bersih</div>
                                    <div class="profit-item-value text-primary" id="keuntunganBersih">
                                        <div class="skeleton-loader"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== MODAL AKTIVITAS UMKM ===================== -->
    <div class="modal fade" id="umkmActivityModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content modal-activity-content">
                <div class="modal-activity-header">
                    <div class="modal-umkm-info">
                        <div class="modal-umkm-avatar" id="modalUmkmAvatar">U</div>
                        <div>
                            <div class="modal-umkm-name" id="modalUmkmName">-</div>
                            <div class="modal-umkm-meta" id="modalUmkmMeta">-</div>
                        </div>
                    </div>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <!-- Summary Stats in Modal -->
                <div class="modal-stats-row" id="modalStats">
                    <div class="modal-stat-item">
                        <div class="modal-stat-label">Total Pengajuan</div>
                        <div class="modal-stat-value" id="modalTotalPinjaman">-</div>
                    </div>
                    <div class="modal-stat-item">
                        <div class="modal-stat-label">Sudah Lunas</div>
                        <div class="modal-stat-value text-success" id="modalTotalLunas">-</div>
                    </div>
                    <div class="modal-stat-item">
                        <div class="modal-stat-label">Sedang Berjalan</div>
                        <div class="modal-stat-value text-warning" id="modalTotalAktif">-</div>
                    </div>
                    <div class="modal-stat-item">
                        <div class="modal-stat-label">Pendapatan Bunga</div>
                        <div class="modal-stat-value text-info" id="modalPendapatanBunga">-</div>
                    </div>
                </div>

                <div class="modal-body modal-activity-body" id="modalActivityList">
                    <!-- Activity list will be injected here -->
                </div>
            </div>
        </div>
    </div>
    <!-- ===================== END MODAL ===================== -->

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Display current date
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date().toLocaleDateString('id-ID', options);
            $('#currentDate').text(today);

            // ---- Global store ----
            let allPeminjamanData = [];
            let allUmkmData = [];

            // Format Rupiah
            function formatRupiah(angka) {
                if (!angka || angka === 0 || angka === '0') return 'Rp 0';
                const number = parseFloat(angka);
                if (isNaN(number)) return 'Rp 0';
                return 'Rp ' + number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Format Number with K/M suffix
            function formatNumberShort(num) {
                if (num >= 1000000) return (num / 1000000).toFixed(1) + 'M';
                if (num >= 1000) return (num / 1000).toFixed(1) + 'K';
                return num.toString();
            }

            // Get Time Ago
            function getTimeAgo(date) {
                const now = new Date();
                const diffMs = now - date;
                const diffMins = Math.floor(diffMs / 60000);
                const diffHours = Math.floor(diffMs / 3600000);
                const diffDays = Math.floor(diffMs / 86400000);
                if (diffMins < 1) return 'Baru saja';
                if (diffMins < 60) return diffMins + ' menit yang lalu';
                if (diffHours < 24) return diffHours + ' jam yang lalu';
                if (diffDays < 7) return diffDays + ' hari yang lalu';
                return date.toLocaleDateString('id-ID');
            }

            // Status badge helper
            function statusBadge(status) {
                const s = status.toLowerCase();
                const map = {
                    'disetujui' : { cls: 'badge-status-approved', label: 'Disetujui' },
                    'lunas'     : { cls: 'badge-status-lunas',    label: 'Lunas' },
                    'ditolak'   : { cls: 'badge-status-rejected', label: 'Ditolak' },
                    'pending'   : { cls: 'badge-status-pending',  label: 'Pengajuan' },
                    'menunggu'  : { cls: 'badge-status-pending',  label: 'Menunggu' },
                };
                const obj = map[s] || { cls: 'badge-status-pending', label: status };
                return `<span class="badge-status ${obj.cls}">${obj.label}</span>`;
            }

            // ===================== LOAD STATISTICS =====================
            function loadStatistics() {
                // Load Total UMKM
                $.ajax({
                    url: '/v1/umkm',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            allUmkmData = response.data;
                            $('#totalUmkm').text(response.data.length || 0);
                            renderUmkmList(allUmkmData);
                        } else {
                            $('#totalUmkm').text('0');
                            renderUmkmList([]);
                        }
                    },
                    error: function() {
                        $('#totalUmkm').text('0');
                        renderUmkmList([]);
                    }
                });

                // Load Total Mentor
                $.ajax({
                    url: '/v1/users?role=mentor',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            $('#totalMentor').text(response.data.length || 0);
                        } else {
                            $('#totalMentor').text('0');
                        }
                    },
                    error: function() { $('#totalMentor').text('0'); }
                });

                // Load Peminjaman Data
                $.ajax({
                    url: '/v1/peminjaman',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data && response.data.length > 0) {
                            allPeminjamanData = response.data;
                            calculateFinancialMetrics(response.data);
                            createRevenueChart(response.data);
                            analyzeByUmkmType(response.data);
                        } else {
                            allPeminjamanData = [];
                            $('#modalKoperasi').text(formatRupiah(0));
                            $('#totalKeuntungan').text(formatRupiah(0));
                            $('#totalPinjamanLunas').text(formatRupiah(0));
                            $('#bungaPersen').text(formatRupiah(0));
                            $('#keuntunganBersih').text(formatRupiah(0));
                            $('#umkmAnalysis').html(`<div class="empty-state"><i class="bx bx-data"></i><p>Belum ada data peminjaman</p></div>`);
                            createRevenueChart([]);
                        }
                    },
                    error: function() {
                        allPeminjamanData = [];
                        $('#modalKoperasi').text(formatRupiah(0));
                        $('#totalKeuntungan').text(formatRupiah(0));
                        $('#totalPinjamanLunas').text(formatRupiah(0));
                        $('#bungaPersen').text(formatRupiah(0));
                        $('#keuntunganBersih').text(formatRupiah(0));
                        $('#umkmAnalysis').html(`<div class="empty-state"><i class="bx bx-error-circle"></i><p>Gagal memuat data analisis</p></div>`);
                        createRevenueChart([]);
                    }
                });
            }

            // ===================== RENDER UMKM LIST =====================
            function renderUmkmList(data) {
                if (!data || data.length === 0) {
                    $('#umkmList').html(`
                        <div class="no-activity">
                            <i class="bx bx-store"></i>
                            <p>Belum ada data UMKM</p>
                        </div>
                    `);
                    return;
                }

                let html = '<ul class="umkm-list">';
                data.forEach(function(umkm) {
                    const initial = (umkm.nama_umkm || 'U').charAt(0).toUpperCase();
                    const colorClass = getAvatarColor(umkm.id || umkm.nama_umkm);
                    html += `
                        <li class="umkm-list-item" data-id="${umkm.id}" data-nama="${umkm.nama_umkm}" data-jenis="${umkm.jenis_umkm || '-'}" data-pemilik="${umkm.nama_pemilik || '-'}">
                            <div class="umkm-list-avatar ${colorClass}">${initial}</div>
                            <div class="umkm-list-info">
                                <div class="umkm-list-name">${umkm.nama_umkm}</div>
                                <div class="umkm-list-type">${umkm.jenis_umkm || 'Jenis tidak diketahui'}</div>
                            </div>
                            <div class="umkm-list-arrow">
                                <i class="bx bx-chevron-right"></i>
                            </div>
                        </li>
                    `;
                });
                html += '</ul>';
                $('#umkmList').html(html);
            }

            // Helper: assign avatar color class based on id/name hash
            function getAvatarColor(seed) {
                const colors = ['avatar-red', 'avatar-orange', 'avatar-green', 'avatar-blue', 'avatar-purple', 'avatar-pink'];
                let hash = 0;
                const str = String(seed);
                for (let i = 0; i < str.length; i++) hash = str.charCodeAt(i) + ((hash << 5) - hash);
                return colors[Math.abs(hash) % colors.length];
            }

            // ===================== SEARCH UMKM LIST =====================
            $('#umkmSearchInput').on('input', function() {
                const keyword = $(this).val().toLowerCase().trim();
                if (!keyword) {
                    renderUmkmList(allUmkmData);
                    return;
                }
                const filtered = allUmkmData.filter(u =>
                    (u.nama_umkm || '').toLowerCase().includes(keyword) ||
                    (u.jenis_umkm || '').toLowerCase().includes(keyword)
                );
                renderUmkmList(filtered);
            });

            // ===================== CLICK UMKM -> SHOW MODAL =====================
            $(document).on('click', '.umkm-list-item', function() {
                const umkmId   = $(this).data('id');
                const nama     = $(this).data('nama');
                const jenis    = $(this).data('jenis');
                const pemilik  = $(this).data('pemilik');
                const initial  = nama.charAt(0).toUpperCase();
                const colorClass = getAvatarColor(umkmId || nama);

                // Set modal header
                $('#modalUmkmAvatar').text(initial).removeClass().addClass('modal-umkm-avatar ' + colorClass);
                $('#modalUmkmName').text(nama);
                $('#modalUmkmMeta').text((jenis !== '-' ? jenis : '') + (pemilik !== '-' ? ' · ' + pemilik : ''));

                // Filter peminjaman milik UMKM ini
                const peminjamanUmkm = allPeminjamanData.filter(p =>
                    p.umkm && (String(p.umkm.id) === String(umkmId) || p.umkm.nama_umkm === nama)
                );

                // Hitung summary stats — semua status dihitung
                let totalNominal = 0, totalLunas = 0, totalAktif = 0, totalPengajuan = 0;
                peminjamanUmkm.forEach(function(p) {
                    const jml = parseFloat(p.jumlah_pinjaman) || 0;
                    const st  = p.status.toLowerCase();

                    // Setiap record = 1 pengajuan
                    totalPengajuan++;

                    // Total nominal semua yang pernah disetujui (termasuk lunas)
                    if (st === 'disetujui' || st === 'lunas') totalNominal += jml;
                    // Sudah lunas
                    if (st === 'lunas')    totalLunas += jml;
                    // Sedang berjalan (disetujui belum lunas)
                    if (st === 'disetujui') totalAktif += jml;
                });
                const bunga = totalLunas * 0.02;

                $('#modalTotalPinjaman').text(totalPengajuan + ' Pengajuan');
                $('#modalTotalLunas').text(formatRupiah(totalLunas));
                $('#modalTotalAktif').text(formatRupiah(totalAktif));
                $('#modalPendapatanBunga').text(formatRupiah(bunga));

                // Render activity list
                renderModalActivities(peminjamanUmkm);

                // Show modal
                var modal = new bootstrap.Modal(document.getElementById('umkmActivityModal'));
                modal.show();
            });

            // ===================== RENDER MODAL ACTIVITIES =====================
            function renderModalActivities(list) {
                if (!list || list.length === 0) {
                    $('#modalActivityList').html(`
                        <div class="no-activity" style="padding: 3rem 1rem;">
                            <i class="bx bx-file-blank" style="font-size:3rem; opacity:0.4;"></i>
                            <p style="margin-top:.5rem; color:#a0aec0;">Belum ada riwayat peminjaman</p>
                        </div>
                    `);
                    return;
                }

                /**
                 * Setiap record peminjaman menghasilkan BEBERAPA event aktivitas:
                 *  1. Pengajuan pinjaman  → selalu ada (created_at)
                 *  2. Disetujui           → jika ada tanggal_disetujui
                 *  3. Ditolak             → jika status === 'ditolak' & ada tanggal_disetujui
                 *  4. Pelunasan / Lunas   → jika ada tanggal_lunas
                 *
                 * Dengan cara ini tidak ada event yang hilang.
                 */

                const events = [];

                list.forEach(function(item) {
                    const st = item.status.toLowerCase();
                    const nominal = formatRupiah(item.jumlah_pinjaman);
                    const refId = item.id ? `#${item.id}` : '';

                    // ── Event 1: Pengajuan ──
                    if (item.created_at) {
                        events.push({
                            date      : new Date(item.created_at),
                            icon      : 'bx-file-plus',
                            colorClass: 'tl-icon-primary',
                            title     : `Pengajuan Pinjaman ${nominal}`,
                            badge     : statusBadge('pending'),
                            meta      : refId,
                            note      : item.keterangan || null,
                        });
                    }

                    // ── Event 2: Disetujui ──
                    if ((st === 'disetujui' || st === 'lunas') && item.tanggal_disetujui) {
                        events.push({
                            date      : new Date(item.tanggal_disetujui),
                            icon      : 'bx-check-shield',
                            colorClass: 'tl-icon-success',
                            title     : `Pinjaman Disetujui ${nominal}`,
                            badge     : statusBadge('disetujui'),
                            meta      : refId,
                            note      : null,
                        });
                    }

                    // ── Event 3: Ditolak ──
                    if (st === 'ditolak') {
                        const dtTolak = item.tanggal_disetujui || item.updated_at || null;
                        events.push({
                            date      : dtTolak ? new Date(dtTolak) : new Date(item.created_at),
                            icon      : 'bx-x-circle',
                            colorClass: 'tl-icon-danger',
                            title     : `Pinjaman Ditolak ${nominal}`,
                            badge     : statusBadge('ditolak'),
                            meta      : refId,
                            note      : item.catatan_penolakan || item.keterangan || null,
                        });
                    }

                    // ── Event 4: Pelunasan ──
                    if (st === 'lunas') {
                        const dtLunas = item.tanggal_lunas || item.updated_at || null;
                        events.push({
                            date      : dtLunas ? new Date(dtLunas) : new Date(item.created_at),
                            icon      : 'bx-badge-check',
                            colorClass: 'tl-icon-lunas',
                            title     : `Pinjaman Lunas ${nominal}`,
                            badge     : statusBadge('lunas'),
                            meta      : refId,
                            note      : null,
                        });
                    }
                });

                if (events.length === 0) {
                    $('#modalActivityList').html(`
                        <div class="no-activity" style="padding: 3rem 1rem;">
                            <i class="bx bx-file-blank" style="font-size:3rem; opacity:0.4;"></i>
                            <p style="margin-top:.5rem; color:#a0aec0;">Belum ada riwayat aktivitas</p>
                        </div>
                    `);
                    return;
                }

                // Sort terbaru di atas
                events.sort((a, b) => b.date - a.date);

                let html = '<div class="modal-timeline">';
                events.forEach(function(ev, idx) {
                    const timeAgo = getTimeAgo(ev.date);
                    const dateStr = ev.date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
                    const isLast  = idx === events.length - 1;

                    html += `
                        <div class="modal-timeline-item">
                            <div class="tl-connector">
                                <div class="tl-icon ${ev.colorClass}">
                                    <i class="bx ${ev.icon}"></i>
                                </div>
                                ${!isLast ? '<div class="tl-line"></div>' : ''}
                            </div>
                            <div class="tl-content">
                                <div class="tl-top">
                                    <div class="tl-title">${ev.title}</div>
                                    ${ev.badge}
                                </div>
                                <div class="tl-meta">
                                    <span><i class="bx bx-calendar-alt"></i> ${dateStr}</span>
                                    <span><i class="bx bx-time"></i> ${timeAgo}</span>
                                    ${ev.meta ? `<span class="tl-ref">${ev.meta}</span>` : ''}
                                </div>
                                ${ev.note ? `<div class="tl-note">${ev.note}</div>` : ''}
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                $('#modalActivityList').html(html);
            }

            // ===================== ANALYZE BY UMKM TYPE =====================
            function analyzeByUmkmType(data) {
                const umkmTypeData = {};
                data.forEach(function(item) {
                    if (item.umkm && item.umkm.jenis_umkm) {
                        const jenisUmkm = item.umkm.jenis_umkm;
                        if (!umkmTypeData[jenisUmkm]) {
                            umkmTypeData[jenisUmkm] = { totalPinjaman: 0, totalDikembalikan: 0, pendapatanBunga: 0, jumlahPeminjam: 0 };
                        }
                        if (item.status.toLowerCase() === 'disetujui' || item.status.toLowerCase() === 'lunas') {
                            umkmTypeData[jenisUmkm].totalPinjaman += parseFloat(item.jumlah_pinjaman);
                            umkmTypeData[jenisUmkm].jumlahPeminjam++;
                        }
                        if (item.status.toLowerCase() === 'lunas') {
                            umkmTypeData[jenisUmkm].totalDikembalikan += parseFloat(item.jumlah_pinjaman);
                            umkmTypeData[jenisUmkm].pendapatanBunga += parseFloat(item.jumlah_pinjaman) * 0.02;
                        }
                    }
                });
                displayUmkmAnalysis(umkmTypeData);
            }

            function displayUmkmAnalysis(umkmTypeData) {
                if (Object.keys(umkmTypeData).length === 0) {
                    $('#umkmAnalysis').html(`<div class="empty-state"><i class="bx bx-data"></i><p>Belum ada data peminjaman</p></div>`);
                    return;
                }
                const colors = [
                    { gradient: 'linear-gradient(135deg, #dc2626 0%, #991b1b 100%)', light: '#fee2e2' },
                    { gradient: 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)', light: '#fef3c7' },
                    { gradient: 'linear-gradient(135deg, #059669 0%, #047857 100%)', light: '#d1fae5' },
                    { gradient: 'linear-gradient(135deg, #3b82f6 0%, #2563eb 100%)', light: '#dbeafe' },
                    { gradient: 'linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%)', light: '#ede9fe' },
                    { gradient: 'linear-gradient(135deg, #ec4899 0%, #db2777 100%)', light: '#fce7f3' }
                ];
                let html = '<div class="row g-3">';
                let colorIndex = 0;
                Object.keys(umkmTypeData).forEach(function(jenisUmkm) {
                    const data = umkmTypeData[jenisUmkm];
                    const color = colors[colorIndex % colors.length];
                    colorIndex++;
                    html += `
                        <div class="col-lg-4 col-md-6">
                            <div class="umkm-type-card" style="border-color: ${color.light}">
                                <div class="umkm-type-header">
                                    <div class="umkm-type-icon" style="background: ${color.gradient}">
                                        <i class="bx bx-briefcase"></i>
                                    </div>
                                    <div class="umkm-type-title">${jenisUmkm}</div>
                                    <div class="umkm-type-count">${data.jumlahPeminjam} Peminjam</div>
                                </div>
                                <div class="umkm-type-body">
                                    <div class="umkm-metric">
                                        <div class="umkm-metric-label"><i class="bx bx-money"></i> Total Pinjaman</div>
                                        <div class="umkm-metric-value">${formatRupiah(data.totalPinjaman)}</div>
                                    </div>
                                    <div class="umkm-metric">
                                        <div class="umkm-metric-label"><i class="bx bx-check-circle"></i> Sudah Dikembalikan</div>
                                        <div class="umkm-metric-value text-success">${formatRupiah(data.totalDikembalikan)}</div>
                                        <div class="umkm-metric-percentage">${data.totalPinjaman > 0 ? ((data.totalDikembalikan / data.totalPinjaman) * 100).toFixed(1) : 0}% dari total</div>
                                    </div>
                                    <div class="umkm-metric umkm-metric-highlight" style="background: ${color.light}">
                                        <div class="umkm-metric-label"><i class="bx bx-trending-up"></i> Pendapatan Bunga (2%)</div>
                                        <div class="umkm-metric-value" style="color: ${color.gradient.match(/#[a-f0-9]{6}/i)[0]}">${formatRupiah(data.pendapatanBunga)}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                $('#umkmAnalysis').html(html);
            }

            // ===================== CALCULATE FINANCIAL METRICS =====================
            function calculateFinancialMetrics(data) {
                let totalLimit = 0, totalPinjamanLunas = 0;
                data.forEach(function(item) {
                    if (item.status.toLowerCase() === 'disetujui' || item.status.toLowerCase() === 'lunas')
                        totalLimit += parseFloat(item.jumlah_pinjaman) || 0;
                    if (item.status.toLowerCase() === 'lunas')
                        totalPinjamanLunas += parseFloat(item.jumlah_pinjaman) || 0;
                });
                const bunga = totalPinjamanLunas * 0.02;
                $('#modalKoperasi').text(formatRupiah(totalLimit));
                $('#totalKeuntungan').text(formatRupiah(bunga));
                $('#totalPinjamanLunas').text(formatRupiah(totalPinjamanLunas));
                $('#bungaPersen').text(formatRupiah(bunga));
                $('#keuntunganBersih').text(formatRupiah(bunga));
            }

            // ===================== REVENUE CHART =====================
            let revenueChart;
            function createRevenueChart(data) {
                const ctx = document.getElementById('revenueChart').getContext('2d');
                if (revenueChart) revenueChart.destroy();

                let labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
                let values = [0, 0, 0, 0, 0, 0];

                if (data && data.length > 0) {
                    const monthlyData = {};
                    data.forEach(function(item) {
                        if (item.status.toLowerCase() === 'lunas' && item.tanggal_disetujui) {
                            const date = new Date(item.tanggal_disetujui);
                            const monthYear = date.toLocaleDateString('id-ID', { year: 'numeric', month: 'short' });
                            monthlyData[monthYear] = (monthlyData[monthYear] || 0) + (parseFloat(item.jumlah_pinjaman) || 0);
                        }
                    });
                    const keys = Object.keys(monthlyData).slice(-6);
                    if (keys.length > 0) {
                        labels = keys;
                        values = keys.map(k => monthlyData[k]);
                    }
                }

                revenueChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Pendapatan',
                            data: values,
                            borderColor: '#dc2626',
                            backgroundColor: 'rgba(220, 38, 38, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 6,
                            pointHoverRadius: 8,
                            pointBackgroundColor: '#dc2626',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                        }]
                    },
                    options: getChartOptions()
                });
            }

            function getChartOptions() {
                return {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            padding: 12,
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#dc2626',
                            borderWidth: 1,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                            ticks: {
                                callback: function(value) { return 'Rp ' + formatNumberShort(value); },
                                color: '#6c757d',
                                font: { size: 12 }
                            }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#6c757d', font: { size: 12 } }
                        }
                    }
                };
            }

            // ===================== INIT =====================
            loadStatistics();

            // Refresh every 5 minutes
            setInterval(function() {
                loadStatistics();
            }, 300000);
        });
    </script>

    <style>
        /* ===================== BASE ===================== */
        .dashboard-container { padding: 2rem; min-height: 100vh; }

        .dashboard-title {
            font-size: 2.5rem; font-weight: 800;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text; margin-bottom: 0.5rem;
        }
        .dashboard-subtitle { color: #6c757d; font-size: 1rem; margin: 0; }
        .date-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: white; padding: .75rem 1.5rem; border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0,0,0,.08); font-weight: 600; color: #2d3748;
        }
        .date-badge i { font-size: 1.25rem; color: #dc2626; }

        /* ===================== STAT CARDS ===================== */
        .stat-card {
            background: white; border-radius: 20px; overflow: hidden;
            transition: all .3s ease; border: 2px solid transparent; height: 100%;
        }
        .stat-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,.15); }
        .stat-card-primary  { border-color: #fee2e2; background: linear-gradient(135deg, #fff 0%, #fef2f2 100%); }
        .stat-card-primary:hover { border-color: #dc2626; }
        .stat-card-success  { border-color: #fee2e2; background: linear-gradient(135deg, #fff 0%, #fffbeb 100%); }
        .stat-card-success:hover { border-color: #ef4444; }
        .stat-card-warning  { border-color: #fef3c7; background: linear-gradient(135deg, #fff 0%, #fffbeb 100%); }
        .stat-card-warning:hover { border-color: #f59e0b; }
        .stat-card-info     { border-color: #fee2e2; background: linear-gradient(135deg, #fff 0%, #fef2f2 100%); }
        .stat-card-info:hover { border-color: #b91c1c; }
        .stat-card-body { padding: 1.5rem; display: flex; gap: 1rem; }
        .stat-card-icon {
            width: 64px; height: 64px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .stat-card-primary .stat-card-icon { background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); color: white; }
        .stat-card-success  .stat-card-icon { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; }
        .stat-card-warning  .stat-card-icon { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; }
        .stat-card-info     .stat-card-icon { background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%); color: white; }
        .stat-card-icon i { font-size: 2rem; }
        .stat-card-content { flex: 1; }
        .stat-card-label { font-size: .875rem; color: #6c757d; margin-bottom: .5rem; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }
        .stat-card-value { font-size: 20px; font-weight: 800; color: #2d3748; margin-bottom: .5rem; line-height: 1; }
        .stat-card-trend { display: flex; align-items: center; gap: .25rem; font-size: .875rem; color: #6c757d; }
        .stat-card-trend i { font-size: 1rem; }

        /* ===================== UMKM ANALYSIS ===================== */
        .umkm-analysis-card { background: white; border-radius: 12px; padding: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        .umkm-analysis-header { display: flex; align-items: center; gap: .75rem; margin-bottom: 1rem; padding-bottom: .75rem; border-bottom: 1px solid #f3f4f6; }
        .umkm-analysis-icon { width: 40px; height: 40px; background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; }
        .umkm-analysis-icon i { font-size: 1.25rem; }
        .umkm-analysis-title { font-size: 1rem; font-weight: 700; color: #2d3748; margin: 0; }
        .umkm-analysis-subtitle { font-size: .7rem; color: #6c757d; margin: .125rem 0 0 0; }
        .empty-state { text-align: center; padding: 3rem 2rem; color: #a0aec0; }
        .empty-state i { font-size: 4rem; margin-bottom: 1rem; opacity: .5; }
        .empty-state p { margin: 0; font-size: 1rem; font-weight: 500; }
        .umkm-type-card { background: white; border-radius: 10px; border: 1px solid #f3f4f6; overflow: hidden; transition: all .3s ease; height: 100%; }
        .umkm-type-card:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(0,0,0,.08); }
        .umkm-type-header { padding: .75rem; text-align: center; border-bottom: 1px solid #f3f4f6; }
        .umkm-type-icon { width: 36px; height: 36px; margin: 0 auto .5rem; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; }
        .umkm-type-icon i { font-size: 1.1rem; }
        .umkm-type-title { font-size: .875rem; font-weight: 700; color: #2d3748; margin-bottom: .125rem; }
        .umkm-type-count { font-size: .7rem; color: #6c757d; font-weight: 600; }
        .umkm-type-body { padding: .75rem; }
        .umkm-metric { padding: .5rem; border-radius: 6px; margin-bottom: .5rem; background: #f9fafb; transition: all .2s ease; }
        .umkm-metric:hover { background: #f3f4f6; }
        .umkm-metric:last-child { margin-bottom: 0; }
        .umkm-metric-highlight { border: 1px solid; }
        .umkm-metric-label { display: flex; align-items: center; gap: .3rem; font-size: .65rem; color: #6c757d; margin-bottom: .3rem; text-transform: uppercase; letter-spacing: .2px; font-weight: 600; }
        .umkm-metric-label i { font-size: .75rem; }
        .umkm-metric-value { font-size: .875rem; font-weight: 700; color: #2d3748; }
        .umkm-metric-percentage { font-size: .65rem; color: #6c757d; margin-top: .15rem; }

        /* ===================== CHART CARD ===================== */
        .chart-card { background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 4px 12px rgba(0,0,0,.08); height: 100%; }
        .chart-card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .chart-card-title { font-size: 1.5rem; font-weight: 700; color: #2d3748; margin: 0; }
        .chart-card-subtitle { color: #6c757d; font-size: .875rem; margin: .25rem 0 0 0; }
        .chart-legend { display: flex; gap: 1rem; }
        .legend-item { display: flex; align-items: center; gap: .5rem; font-size: .875rem; color: #6c757d; }
        .legend-color { width: 16px; height: 16px; border-radius: 4px; }
        .legend-color-success { background: #dc2626; }
        .chart-card-body { height: 300px; }

        /* ===================== ACTIVITY CARD (UMKM List) ===================== */
        .activity-card {
            background: white; border-radius: 20px; padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,.08); height: 100%;
            display: flex; flex-direction: column;
        }
        .activity-card-header { margin-bottom: .75rem; }
        .activity-card-title { font-size: 1.25rem; font-weight: 700; color: #2d3748; margin: 0; }
        .activity-card-subtitle { color: #6c757d; font-size: .8rem; margin: .2rem 0 0 0; }

        /* Search */
        .activity-search-wrap { margin-bottom: .75rem; }
        .activity-search-box {
            display: flex; align-items: center; gap: .5rem;
            background: #f9fafb; border: 1.5px solid #f3f4f6; border-radius: 10px;
            padding: .5rem .75rem; transition: border-color .2s;
        }
        .activity-search-box:focus-within { border-color: #dc2626; background: #fff; }
        .activity-search-box i { color: #a0aec0; font-size: 1rem; flex-shrink: 0; }
        .activity-search-box input {
            border: none; outline: none; background: transparent;
            font-size: .875rem; color: #2d3748; width: 100%;
        }
        .activity-search-box input::placeholder { color: #a0aec0; }

        .activity-card-body { flex: 1; overflow-y: auto; min-height: 0; }
        .activity-card-body::-webkit-scrollbar { width: 5px; }
        .activity-card-body::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .activity-card-body::-webkit-scrollbar-thumb { background: #cbd5e0; border-radius: 10px; }
        .activity-card-body::-webkit-scrollbar-thumb:hover { background: #a0aec0; }

        /* UMKM List */
        .umkm-list { list-style: none; margin: 0; padding: 0; }
        .umkm-list-item {
            display: flex; align-items: center; gap: .75rem;
            padding: .65rem .75rem; border-radius: 12px; cursor: pointer;
            transition: all .2s ease; border: 1.5px solid transparent;
            margin-bottom: .4rem;
        }
        .umkm-list-item:hover {
            background: #fef2f2; border-color: #fecaca;
            transform: translateX(3px);
        }
        .umkm-list-item:last-child { margin-bottom: 0; }

        /* Avatars */
        .umkm-list-avatar, .modal-umkm-avatar {
            width: 40px; height: 40px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1rem; color: white; flex-shrink: 0;
        }
        .avatar-red    { background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); }
        .avatar-orange { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
        .avatar-green  { background: linear-gradient(135deg, #059669 0%, #047857 100%); }
        .avatar-blue   { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
        .avatar-purple { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
        .avatar-pink   { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }

        .umkm-list-info { flex: 1; min-width: 0; }
        .umkm-list-name { font-weight: 600; font-size: .875rem; color: #2d3748; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .umkm-list-type { font-size: .72rem; color: #a0aec0; margin-top: .1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .umkm-list-arrow { color: #cbd5e0; font-size: 1.25rem; flex-shrink: 0; transition: color .2s; }
        .umkm-list-item:hover .umkm-list-arrow { color: #dc2626; }

        .no-activity { text-align: center; padding: 3rem 1rem; color: #a0aec0; }
        .no-activity i { font-size: 3rem; margin-bottom: 1rem; opacity: .5; }
        .no-activity p { margin: 0; font-size: .875rem; }

        /* ===================== PROFIT CARD ===================== */
        .profit-card { background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); border-radius: 20px; padding: 2rem; color: white; box-shadow: 0 4px 12px rgba(220,38,38,.3); }
        .profit-card-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; }
        .profit-icon { width: 64px; height: 64px; background: rgba(255,255,255,.2); border-radius: 16px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(10px); }
        .profit-icon i { font-size: 2rem; }
        .profit-card-title { font-size: 1.5rem; font-weight: 700; margin: 0; }
        .profit-card-subtitle { font-size: .875rem; opacity: .9; margin: .25rem 0 0 0; }
        .profit-item { background: rgba(255,255,255,.15); padding: 1.5rem; border-radius: 16px; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,.2); }
        .profit-item-highlight { background: rgba(255,255,255,.25); border: 2px solid rgba(255,255,255,.4); }
        .profit-item-label { font-size: .875rem; opacity: .9; margin-bottom: .75rem; text-transform: uppercase; letter-spacing: .5px; }
        .profit-item-value { font-size: 1.75rem; font-weight: 800; }
        .profit-item-value.text-success { color: #fef3c7 !important; }
        .profit-item-value.text-primary  { color: #ffffff !important; }

        /* ===================== SKELETON ===================== */
        .skeleton-loader {
            height: 2rem; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%; animation: loading 1.5s ease-in-out infinite; border-radius: 8px; width: 80%;
        }
        .skeleton-activity {
            height: 56px; background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%; animation: loading 1.5s ease-in-out infinite; border-radius: 12px; margin-bottom: .75rem;
        }
        @keyframes loading {
            0%   { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* ===================== MODAL ===================== */
        .modal-activity-content {
            border: none; border-radius: 24px; overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,.18);
        }
        .modal-activity-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.5rem 1.75rem;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
        }
        .modal-umkm-info { display: flex; align-items: center; gap: 1rem; }
        .modal-umkm-avatar {
            width: 52px; height: 52px; border-radius: 14px;
            font-size: 1.4rem; font-weight: 800; border: 2.5px solid rgba(255,255,255,.4);
        }
        .modal-umkm-name { font-size: 1.1rem; font-weight: 700; color: #fff; }
        .modal-umkm-meta { font-size: .8rem; color: rgba(255,255,255,.75); margin-top: .15rem; }
        .modal-close-btn {
            background: rgba(255,255,255,.2); border: none; color: white;
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; cursor: pointer; transition: background .2s; flex-shrink: 0;
        }
        .modal-close-btn:hover { background: rgba(255,255,255,.35); }

        /* Modal stats row */
        .modal-stats-row {
            display: flex; gap: 0; border-bottom: 1px solid #f3f4f6;
            background: #fafafa;
        }
        .modal-stat-item {
            flex: 1; padding: .85rem 1rem; text-align: center;
            border-right: 1px solid #f3f4f6;
        }
        .modal-stat-item:last-child { border-right: none; }
        .modal-stat-label { font-size: .65rem; color: #a0aec0; text-transform: uppercase; letter-spacing: .3px; font-weight: 600; margin-bottom: .25rem; }
        .modal-stat-value { font-size: .875rem; font-weight: 800; color: #2d3748; }
        .modal-stat-value.text-success { color: #059669 !important; }
        .modal-stat-value.text-warning { color: #d97706 !important; }
        .modal-stat-value.text-info    { color: #2563eb !important; }

        .modal-activity-body { padding: 1.25rem 1.75rem; max-height: 420px; overflow-y: auto; }
        .modal-activity-body::-webkit-scrollbar { width: 5px; }
        .modal-activity-body::-webkit-scrollbar-track { background: #f3f4f6; border-radius: 10px; }
        .modal-activity-body::-webkit-scrollbar-thumb { background: #cbd5e0; border-radius: 10px; }

        /* Timeline */
        .modal-timeline { padding: .25rem 0; }
        .modal-timeline-item {
            display: flex; gap: 1rem; margin-bottom: 1.25rem;
            animation: fadeSlideIn .3s ease forwards;
        }
        .modal-timeline-item:last-child { margin-bottom: 0; }
        .modal-timeline-item:last-child .tl-line { display: none; }

        .tl-connector { display: flex; flex-direction: column; align-items: center; flex-shrink: 0; }
        .tl-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: white; flex-shrink: 0;
        }
        .tl-icon-primary  { background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%); }
        .tl-icon-success  { background: linear-gradient(135deg, #059669 0%, #047857 100%); }
        .tl-icon-info     { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); }
        .tl-icon-danger   { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        .tl-icon-lunas    { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); }
        .tl-ref { font-size: .7rem; background: #f3f4f6; padding: .1rem .45rem; border-radius: 6px; color: #6c757d; font-weight: 600; }
        .tl-line { flex: 1; width: 2px; background: #f3f4f6; margin: 4px 0 0; min-height: 12px; }

        .tl-content { flex: 1; padding-bottom: .25rem; }
        .tl-top { display: flex; align-items: center; gap: .5rem; flex-wrap: wrap; margin-bottom: .35rem; }
        .tl-title { font-weight: 700; font-size: .925rem; color: #2d3748; }
        .tl-meta { display: flex; gap: 1rem; font-size: .75rem; color: #a0aec0; flex-wrap: wrap; }
        .tl-meta i { margin-right: .2rem; }
        .tl-note { margin-top: .4rem; font-size: .8rem; color: #6c757d; background: #f9fafb; padding: .4rem .65rem; border-radius: 8px; border-left: 3px solid #e2e8f0; }

        /* Status badges */
        .badge-status {
            display: inline-flex; align-items: center; padding: .2rem .6rem;
            border-radius: 20px; font-size: .7rem; font-weight: 700; letter-spacing: .2px;
        }
        .badge-status-approved { background: #d1fae5; color: #065f46; }
        .badge-status-lunas    { background: #dbeafe; color: #1e40af; }
        .badge-status-rejected { background: #fee2e2; color: #991b1b; }
        .badge-status-pending  { background: #fef3c7; color: #92400e; }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 768px) {
            .dashboard-container { padding: 1rem; }
            .dashboard-title { font-size: 2rem; }
            .stat-card-value { font-size: 1.5rem; }
            .chart-card-header { flex-direction: column; align-items: flex-start; }
            .date-badge { margin-top: 1rem; }
            .umkm-analysis-header { flex-direction: column; text-align: center; }
            .modal-stats-row { flex-wrap: wrap; }
            .modal-stat-item { flex: 0 0 50%; border-bottom: 1px solid #f3f4f6; }
        }
    </style>
@endsection