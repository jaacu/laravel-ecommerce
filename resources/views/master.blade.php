<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head')
</head>
<body class="fix-sidebar fix-header card-no-border">
@include('shared.template-spinner')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        
        @include('layout.header')
        
        @include('layout.sidebar')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper linear-transition">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                @includeWhen($errors->any() , 'shared.errors')
                @includeWhen( session()->has('success'), 'shared.success')
                @includeWhen( session()->has('warning'), 'shared.warning')
                    @yield('content')

                </div>
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            @include('layout.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    @includeIf('layout.logoutForm')
    <div class="modal fade" id="modalPlaceholder">
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js')}}"></script>
    <script src="{{asset('js/sticky-kit.min.js')}}"></script>
    <script src="{{ url('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ url('assets/js/custom.js') }}"></script>
    <script src="{{ asset('js/customMain.js')}}" type="text/javascript"></script>
    @yield('scripts')
    {{-- Global Document Ready Function --}}
    <script>
    jQuery(document).ready(function() {
        @yield('jQuery')

        $('.modal-load-button').click(function(){
            $('#modalPlaceholder').load( $(this).data('url') + '?id=' + $(this).data('id') , function(){
                $('#modalPlaceholder').modal()
            })
        })

        $('.confirmate').click(function(e){
            e.preventDefault();
            var form  = $(this).parents('form').first()
            swal({   
                title: "Are you sure?",   
                text: "You will not be able to recover this imaginary file!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes, delete it!",   
                cancelButtonText: "No, cancel plx!",   
                closeOnConfirm: false,   
                closeOnCancel: false 
            }, function(isConfirm){   
                if (isConfirm) {     
                    form.submit()   
                } else {     
                    swal("Cancelled", "Your imaginary file is safe :)", "error");   
                } 
            });  
        })

    });
    </script>

</body>
</html>