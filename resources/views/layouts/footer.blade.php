<!-- partial:partials/_footer.html -->
<footer class="footer">
    <div class="footer-wrap">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank"> SIRAPAT </a> 2025</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <a href="https://www.bootstrapdash.com/" target="_blank">JTI FATEK UNTAD</a></span>
      </div>
    </div>
  </footer>
          <!-- partial -->
      </div>
      <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
  <!-- container-scroller -->
<!-- base:js -->

<!-- base:js -->
<script src="{{ asset('template/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('template/js/template.js') }}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<!-- End plugin js for this page -->
<script src="{{ asset('template/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('template/vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('template/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
<script src="{{ asset('template/vendors/justgage/raphael-2.1.4.min.js') }}"></script>
<script src="{{ asset('template/vendors/justgage/justgage.js') }}"></script>
<script src="{{ asset('template/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- Custom js for this page-->
<script src="{{ asset('template/js/dashboard.js') }}"></script>
<script src="{{ asset('template/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('template/js/select2.js') }}"></script>
<!-- End custom js for this page-->
 <!-- Iyajra -->
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
{{-- yajra end --}}

{{-- Summernote --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
      $('#summernote').summernote({
          height: 200,
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['table',  ['table']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['fullscreen', 'codeview']]
        ]
      });

  });
</script>

{{-- calender --}}
  <!-- Script FullCalendar, Popper.js, dan Bootstrap Tooltip -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>


</body>
</html>
