 
          <!-- footer start-->
          <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2023 © Art of Living  </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="/assets/js/scrollbar/simplebar.js"></script>
    <script src="/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="/assets/js/sidebar-menu.js"></script>
    <script src="/assets/js/chart/chartjs/chart.min.js"></script>
    <script src="/assets/js/chart/chartist/chartist.js"></script>
    <script src="/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="/assets/js/prism/prism.min.js"></script>
    <script src="/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="/assets/js/counter/counter-custom.js"></script>
    <script src="/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="/assets/js/owlcarousel/owl-custom.js"></script>
    <script src="/assets/js/dashboard/dashboard_2.js"></script>
    <script src="/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/assets/js/script.js"></script>
  
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if(!empty(session()->get('success'))) { ?>
    <script type="text/javascript">
    Swal.fire({
      icon: 'success',
      title: '{{ session()->get('success') }}',
      showConfirmButton: false,
      timer: 2000,
      
    })
    </script>
    <?php } session()->forget('success'); ?>


    <?php if(!empty(session()->get('failed'))) { ?>
      <script type="text/javascript">
      Swal.fire({
      icon: 'warning',
      title: '{{ session()->get('failed') }}',
      showConfirmButton: false,
      timer: 2000
    })
      </script>
    <?php } session()->forget('failed'); ?>


  
  </body>
</html>




<link rel="stylesheet" type="text/css" href="/assets/css/vendors/dropzone.css">
    <script src="/assets/js/dropzone/dropzone.js"></script>
    <script src="/assets/js/dropzone/dropzone-script.js"></script>
    <script src="assets/js/select2/select2.full.min.js"></script>
    <script src="assets/js/select2/select2-custom.js"></script>