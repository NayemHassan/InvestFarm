<!-- Bootstrap JS -->
<script src="{{asset('backend')}}/assets/js/bootstrap.bundle.min.js"></script>

<!-- Plugins -->
<script src="{{asset('backend')}}/assets/js/jquery.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{asset('backend')}}/assets/plugins/chartjs/js/Chart.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{asset('backend')}}/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="{{asset('backend')}}/assets/plugins/jquery-knob/excanvas.js"></script>
<script src="{{asset('backend')}}/assets/plugins/jquery-knob/jquery.knob.js"></script>

<script>
    $(function() {
        $(".knob").knob();
    });
</script>

<!-- Toastr & SweetAlert2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>

<!-- Buttons extension -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<!-- Include Pickadate and Pickatime JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/picker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/picker.date.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/picker.time.js"></script> 
<!-- DataTable Initialization -->
<script>
    $(document).ready(function() {
        var table = $('#example2').DataTable({
            lengthChange: false,
            dom: 'Bfrtip', // Buttons enable করার জন্য
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
		$('.datepicker').pickadate({
			selectMonths: true,
	        selectYears: true,
		}),
		$('.timepicker').pickatime()
   
	</script>
<!-- Toastr Notification -->
<script>
    @if(Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>

<!-- App Scripts -->
<script src="{{asset('backend')}}/assets/js/app.js"></script>
<script src="{{asset('backend')}}/assets/js/index.js"></script>

</body>
</html>
