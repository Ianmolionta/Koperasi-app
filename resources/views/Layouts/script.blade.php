    <script src="{{ asset('assets') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('assets') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets') }}/assets/js/dashboards-analytics.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js') }}/helper.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>


    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#logoutBtn').on('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Sesi Anda akan segera berakhir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#8B0000', // Warna merah sesuai tema Anda
                    cancelButtonColor: '#7A7178',
                    confirmButtonText: 'Ya, Keluar!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jalankan Ajax Logout
                        $.ajax({
                            url: '/logout', // Sesuaikan dengan route Laravel Anda
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil Logout',
                                    text: 'Sampai jumpa kembali!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.href =
                                    '/login'; // Redirect ke halaman login
                                });
                            },
                            error: function() {
                                Swal.fire('Error', 'Terjadi kesalahan saat logout.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
