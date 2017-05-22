

    <!-- Vendor scripts -->
    <script src="/css/vendor/pacejs/pace.min.js"></script>
    <script src="/css/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/css/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/css/vendor/datatables/datatables.min.js"></script>
    <script src="/css/vendor/toastr/toastr.min.js"></script>
    <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>


    <!-- App scripts -->
    <script src="/js/luna.js"></script>



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





