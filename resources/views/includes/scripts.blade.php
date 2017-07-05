

    <!-- Vendor scripts -->
    <script src="/css/vendor/pacejs/pace.min.js"></script>
    <script src="/css/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/css/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/css/vendor/datatables/datatables.min.js"></script>
    <script src="/css/vendor/toastr/toastr.min.js"></script>
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}


    <!-- App scripts -->
    <script src="/js/luna.js"></script>

    <script>
        $(document).ready(function () {
            toastr.options = {
                "debug": false,
                "newestOnTop": false,
                "positionClass": "toast-bottom-right",
                "closeButton": true,
                "progressBar": true
            };


            if($('#alert-get').data('has-success')==true){
                toastr.success($('#alert-get').text())
            }
            if($('#alert-get').data('has-error')==true){
                toastr.error($('#alert-get').text())
            }
        });
    </script>



    <script>
        $(document).ready(function () {



            $('#tableExample2').DataTable({
                "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "lengthMenu": [ [6, 25, 50, -1], [6, 25, 50, "All"] ],
                "iDisplayLength": 6,
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            });


        });

    </script><script>
        $(document).ready(function () {



            $('#tableExample1').DataTable({
                "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "lengthMenu": [ [6, 25, 50, -1], [6, 25, 50, "All"] ],
                "iDisplayLength": 6,
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            });


        });

    </script></script><script>
        $(document).ready(function () {



            $('#tableExample3').DataTable({
                "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "lengthMenu": [ [6, 25, 50, -1], [6, 25, 50, "All"] ],
                "iDisplayLength": 6,
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            });


        });

    </script></script></script><script>
        $(document).ready(function () {



            $('#tableExample4').DataTable({
                "dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
                "lengthMenu": [ [6, 25, 50, -1], [6, 25, 50, "All"] ],
                "iDisplayLength": 6,
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false,
                } ]
            });


        });

    </script>


    <script>
        $(document).ready(function () {

            toastr.options = {
                "debug": false,
                "newestOnTop": false,
                "positionClass": "toast-bottom-right",
                "closeButton": true,
                "progressBar": true
            };

            $('.homerDemo1').on('click', function(event){
                toastr.info('Info - This is a custom LUNA info notification');
            });

            $('.homerDemo2').on('click', function(event){
                toastr.success('Success - This is a LUNA success notification');
            });

            $('.homerDemo3').on('click', function(event){
                toastr.warning('Warning - This is a LUNA warning notification');
            });

            $('.homerDemo4').on('click', function(event){
                toastr.error('Error - This is a LUNA error notification');
            });


        });
    </script>

    @if((Request::path() == "dashboard"))
        <script>
            $(document).ready(function () {

                // Run toastr notification with Welcome message
                setTimeout(function(){
                    toastr.options = {
                        "positionClass": "toast-top-right",
                        "closeButton": true,
                        "progressBar": true,
                        "showEasing": "swing",
                        "timeOut": "1800"
                    };
                    toastr.warning('<strong>You entered to R3COMMEND</strong> <br/><small>ADMIN PANEL. </small>');
                },1000)

            });
        </script>
    @endif





