<!-- Bootstrap core JavaScript-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->

<script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>
<!-- CDN untuk Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
          @if (session('error'))
          <script type="text/javascript">
            Swal.fire({
                title: 'Gagal',
                text: '{{ session('error') }}',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            </script>
            @endif

            @if (session('success'))
            <script type="text/javascript">
              Swal.fire({
                  title: 'Berhasil',
                  text: '{{ session('success') }}',
                  icon: 'primary',
                  confirmButtonText: 'OK'
              });
              </script>
            @endif
  <!-- JS Libraies -->
