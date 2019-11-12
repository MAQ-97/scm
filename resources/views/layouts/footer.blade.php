<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                Copyright © 2018 ERP. All rights reserved.
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            </div>
        </div>
    </div>
</div>
</div>


<!-- jquery 3.3.1 -->
<script src="{{ url('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
<!-- bootstap bundle js -->
<script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<!-- slimscroll js -->
<script src="{{ url('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<!-- main js -->
<script src="{{ url('assets/libs/js/main-js.js') }}"></script>
{{--Multiselect--}}
<script src="{{ url('css/multiselect/bootstrap-multiselect.js') }}"></script>


<!-- chart chartist js -->
{{--<script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>--}}
<!-- sparkline js -->
{{--<script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>--}}
<!-- morris js -->
{{--<script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>--}}
{{--<script src="assets/vendor/charts/morris-bundle/morris.js"></script>--}}
<!-- chart c3 js -->
{{--<script src="assets/vendor/charts/c3charts/c3.min.js"></script>--}}
{{--<script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>--}}
{{--<script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>--}}
{{--<script src="assets/libs/js/dashboard-ecommerce.js"></script>--}}
{{--Data Tables--}}
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#categories').DataTable();
        $('#types').DataTable();
        $('#colors').DataTable();
        $('#users').DataTable();
        $('#products').DataTable();
        $('#clients').DataTable();
    } );
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#category').multiselect();
        $('#sub_category').multiselect();
        $('#color_code').multiselect();
    });
</script>
