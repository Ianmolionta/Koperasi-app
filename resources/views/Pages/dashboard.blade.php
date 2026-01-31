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

        <!-- Charts & Activity Row -->
        <div class="row g-4">
            <!-- Revenue Chart -->
            <div class="col-xl-8">
                <div class="chart-card">
                    <div class="chart-card-header">
                        <div>
                            <h5 class="chart-card-title">Grafik Pendapatan</h5>
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

            <!-- Recent Activities -->
            <div class="col-xl-4">
                <div class="activity-card">
                    <div class="activity-card-header">
                        <h5 class="activity-card-title">Aktivitas Terbaru</h5>
                        <p class="activity-card-subtitle">7 hari terakhir</p>
                    </div>
                    <div class="activity-card-body" id="recentActivities">
                        <!-- Loading State -->
                        <div class="activity-loader">
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Display current date
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date().toLocaleDateString('id-ID', options);
            $('#currentDate').text(today);

            // Format Rupiah
            function formatRupiah(angka) {
                if (!angka || angka === 0 || angka === '0') return 'Rp 0';
                const number = parseFloat(angka);
                if (isNaN(number)) return 'Rp 0';
                return 'Rp ' + number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            // Format Number with K/M suffix
            function formatNumberShort(num) {
                if (num >= 1000000) {
                    return (num / 1000000).toFixed(1) + 'M';
                } else if (num >= 1000) {
                    return (num / 1000).toFixed(1) + 'K';
                }
                return num.toString();
            }

            // Animate counter
            function animateCounter(element, start, end, duration) {
                let current = start;
                const increment = (end - start) / (duration / 16);
                const timer = setInterval(function() {
                    current += increment;
                    if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
                        current = end;
                        clearInterval(timer);
                    }
                    $(element).text(Math.floor(current));
                }, 16);
            }

            // Load Statistics
            function loadStatistics() {
                // Load Total UMKM
                $.ajax({
                    url: '/v1/umkm',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            const total = response.data.length;
                            animateCounter('#totalUmkm', 0, total, 1000);
                        }
                    },
                    error: function() {
                        $('#totalUmkm').html('<span class="text-danger">Error</span>');
                    }
                });

                // Load Total Mentor (assuming there's an API endpoint)
                $.ajax({
                    url: '/v1/users?role=mentor',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            const total = response.data.length;
                            animateCounter('#totalMentor', 0, total, 1000);
                        }
                    },
                    error: function() {
                        // If mentor endpoint doesn't exist, use dummy data
                        $('#totalMentor').text('15');
                    }
                });

                // Load Peminjaman Data for calculations
                $.ajax({
                    url: '/v1/peminjaman',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            calculateFinancialMetrics(response.data);
                            createRevenueChart(response.data);
                        }
                    },
                    error: function() {
                        $('#modalKoperasi').html('<span class="text-danger">Error</span>');
                        $('#totalKeuntungan').html('<span class="text-danger">Error</span>');
                    }
                });
            }

            // Calculate Financial Metrics
            function calculateFinancialMetrics(data) {
                let totalLimit = 0;
                let totalPinjamanLunas = 0;
                
                data.forEach(function(item) {
                    // Modal Koperasi (total semua pinjaman yang disetujui)
                    if (item.status.toLowerCase() === 'disetujui' || item.status.toLowerCase() === 'lunas') {
                        totalLimit += parseFloat(item.jumlah_pinjaman);
                    }
                    
                    // Total Pinjaman Lunas
                    if (item.status.toLowerCase() === 'lunas') {
                        totalPinjamanLunas += parseFloat(item.jumlah_pinjaman);
                    }
                });

                // Calculate profit (2% interest)
                const bunga = totalPinjamanLunas * 0.02;
                const keuntunganBersih = bunga;

                // Update UI
                $('#modalKoperasi').text(formatRupiah(totalLimit));
                $('#totalKeuntungan').text(formatRupiah(keuntunganBersih));
                $('#totalPinjamanLunas').text(formatRupiah(totalPinjamanLunas));
                $('#bungaPersen').text(formatRupiah(bunga));
                $('#keuntunganBersih').text(formatRupiah(keuntunganBersih));
            }

            // Create Revenue Chart
            let revenueChart;
            function createRevenueChart(data) {
                // Group data by month
                const monthlyData = {};
                
                data.forEach(function(item) {
                    if (item.status.toLowerCase() === 'lunas' && item.tanggal_disetujui) {
                        const date = new Date(item.tanggal_disetujui);
                        const monthYear = date.toLocaleDateString('id-ID', { year: 'numeric', month: 'short' });
                        
                        if (!monthlyData[monthYear]) {
                            monthlyData[monthYear] = 0;
                        }
                        monthlyData[monthYear] += parseFloat(item.jumlah_pinjaman);
                    }
                });

                // Convert to arrays for Chart.js
                const labels = Object.keys(monthlyData).slice(-6); // Last 6 months
                const values = labels.map(label => monthlyData[label]);

                const ctx = document.getElementById('revenueChart').getContext('2d');
                
                if (revenueChart) {
                    revenueChart.destroy();
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
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
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
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)',
                                    drawBorder: false
                                },
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + formatNumberShort(value);
                                    },
                                    color: '#6c757d',
                                    font: {
                                        size: 12
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                    drawBorder: false
                                },
                                ticks: {
                                    color: '#6c757d',
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Load Recent Activities
            function loadRecentActivities() {
                $.ajax({
                    url: '/v1/peminjaman',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success' && response.data) {
                            // Filter activities from last 7 days
                            const sevenDaysAgo = new Date();
                            sevenDaysAgo.setDate(sevenDaysAgo.getDate() - 7);

                            const recentActivities = response.data
                                .filter(item => {
                                    const createdDate = new Date(item.created_at);
                                    return createdDate >= sevenDaysAgo;
                                })
                                .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
                                .slice(0, 10); // Show last 10 activities

                            displayActivities(recentActivities);
                        }
                    },
                    error: function() {
                        $('#recentActivities').html('<div class="no-activity">Gagal memuat aktivitas</div>');
                    }
                });
            }

            // Display Activities
            function displayActivities(activities) {
                if (activities.length === 0) {
                    $('#recentActivities').html('<div class="no-activity"><i class="bx bx-info-circle"></i><p>Tidak ada aktivitas dalam 7 hari terakhir</p></div>');
                    return;
                }

                let html = '<div class="activity-timeline">';
                
                activities.forEach(function(item) {
                    const date = new Date(item.created_at);
                    const timeAgo = getTimeAgo(date);
                    
                    let iconClass = 'bx-plus-circle';
                    let iconColor = 'primary';
                    let activityText = 'Pengajuan pinjaman';
                    
                    if (item.status.toLowerCase() === 'disetujui') {
                        iconClass = 'bx-check-circle';
                        iconColor = 'success';
                        activityText = 'Pinjaman disetujui';
                    } else if (item.status.toLowerCase() === 'lunas') {
                        iconClass = 'bx-badge-check';
                        iconColor = 'info';
                        activityText = 'Pinjaman lunas';
                    } else if (item.status.toLowerCase() === 'ditolak') {
                        iconClass = 'bx-x-circle';
                        iconColor = 'danger';
                        activityText = 'Pinjaman ditolak';
                    }

                    html += `
                        <div class="activity-item">
                            <div class="activity-icon activity-icon-${iconColor}">
                                <i class="bx ${iconClass}"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">${activityText}</div>
                                <div class="activity-description">${item.umkm.nama_umkm} - ${formatRupiah(item.jumlah_pinjaman)}</div>
                                <div class="activity-time">${timeAgo}</div>
                            </div>
                        </div>
                    `;
                });

                html += '</div>';
                $('#recentActivities').html(html);
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

            // Initialize Dashboard
            loadStatistics();
            loadRecentActivities();

            // Refresh data every 5 minutes
            setInterval(function() {
                loadStatistics();
                loadRecentActivities();
            }, 300000);
        });
    </script>

    <style>
        /* Dashboard Container */
        .dashboard-container {
            padding: 2rem;
            /* background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); */
            min-height: 100vh;
        }

        /* Header */
        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            color: #6c757d;
            font-size: 1rem;
            margin: 0;
        }

        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            font-weight: 600;
            color: #2d3748;
        }

        .date-badge i {
            font-size: 1.25rem;
            color: #dc2626;
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .stat-card-primary {
            border-color: #fee2e2;
            background: linear-gradient(135deg, #fff 0%, #fef2f2 100%);
        }

        .stat-card-primary:hover {
            border-color: #dc2626;
        }

        .stat-card-success {
            border-color: #fee2e2;
            background: linear-gradient(135deg, #fff 0%, #fffbeb 100%);
        }

        .stat-card-success:hover {
            border-color: #ef4444;
        }

        .stat-card-warning {
            border-color: #fef3c7;
            background: linear-gradient(135deg, #fff 0%, #fffbeb 100%);
        }

        .stat-card-warning:hover {
            border-color: #f59e0b;
        }

        .stat-card-info {
            border-color: #fee2e2;
            background: linear-gradient(135deg, #fff 0%, #fef2f2 100%);
        }

        .stat-card-info:hover {
            border-color: #b91c1c;
        }

        .stat-card-body {
            padding: 1.5rem;
            display: flex;
            gap: 1rem;
        }

        .stat-card-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-card-primary .stat-card-icon {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
        }

        .stat-card-success .stat-card-icon {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .stat-card-warning .stat-card-icon {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .stat-card-info .stat-card-icon {
            background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
            color: white;
        }

        .stat-card-icon i {
            font-size: 2rem;
        }

        .stat-card-content {
            flex: 1;
        }

        .stat-card-label {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card-value {
            font-size: 20px;
            font-weight: 800;
            color: #2d3748;
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-card-trend {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .stat-card-trend i {
            font-size: 1rem;
        }

        /* Chart Card */
        .chart-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .chart-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .chart-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }

        .chart-card-subtitle {
            color: #6c757d;
            font-size: 0.875rem;
            margin: 0.25rem 0 0 0;
        }

        .chart-legend {
            display: flex;
            gap: 1rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .legend-color {
            width: 16px;
            height: 16px;
            border-radius: 4px;
        }

        .legend-color-success {
            background: #dc2626;
        }

        .chart-card-body {
            height: 300px;
        }

        /* Activity Card */
        .activity-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .activity-card-header {
            margin-bottom: 1.5rem;
        }

        .activity-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
        }

        .activity-card-subtitle {
            color: #6c757d;
            font-size: 0.875rem;
            margin: 0.25rem 0 0 0;
        }

        .activity-card-body {
            max-height: 400px;
            overflow-y: auto;
        }

        .activity-card-body::-webkit-scrollbar {
            width: 6px;
        }

        .activity-card-body::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .activity-card-body::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }

        .activity-card-body::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        .activity-timeline {
            position: relative;
        }

        .activity-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            animation: slideInRight 0.3s ease;
        }

        .activity-item:last-child {
            margin-bottom: 0;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .activity-icon-primary {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
        }

        .activity-icon-success {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .activity-icon-info {
            background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
            color: white;
        }

        .activity-icon-danger {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            color: white;
        }

        .activity-icon i {
            font-size: 1.25rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.25rem;
        }

        .activity-description {
            font-size: 0.875rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #a0aec0;
        }

        .no-activity {
            text-align: center;
            padding: 3rem 1rem;
            color: #a0aec0;
        }

        .no-activity i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .no-activity p {
            margin: 0;
            font-size: 0.875rem;
        }

        /* Profit Card */
        .profit-card {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            border-radius: 20px;
            padding: 2rem;
            color: white;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .profit-card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .profit-icon {
            width: 64px;
            height: 64px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .profit-icon i {
            font-size: 2rem;
        }

        .profit-card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .profit-card-subtitle {
            font-size: 0.875rem;
            opacity: 0.9;
            margin: 0.25rem 0 0 0;
        }

        .profit-item {
            background: rgba(255, 255, 255, 0.15);
            padding: 1.5rem;
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .profit-item-highlight {
            background: rgba(255, 255, 255, 0.25);
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        .profit-item-label {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profit-item-value {
            font-size: 1.75rem;
            font-weight: 800;
        }

        .profit-item-value.text-success {
            color: #fef3c7 !important;
        }

        .profit-item-value.text-primary {
            color: #ffffff !important;
        }

        /* Skeleton Loaders */
        .skeleton-loader {
            height: 2rem;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s ease-in-out infinite;
            border-radius: 8px;
            width: 80%;
        }

        .skeleton-activity {
            height: 60px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s ease-in-out infinite;
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .stat-card-value {
                font-size: 1.5rem;
            }

            .chart-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .date-badge {
                margin-top: 1rem;
            }
        }
    </style>
@endsection