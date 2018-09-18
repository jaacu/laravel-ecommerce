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
    <script src="{{ url('assets/js/custom.js') }}"></script>
    <script src="{{ asset('js/customMain.js')}}" type="text/javascript"></script>

    @yield('scripts')
    {{-- Global Document Ready Function --}}
    <script>

        jQuery(document).ready(function() {
            @yield('jQuery')
        });
    </script>

</body>
</html>