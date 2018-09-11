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
        <div class="page-wrapper">
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
    <!-- All Jquery -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- ============================================================== -->
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/sidebarmenu.js')}}"></script>
    <!--stickey kit -->
    <script src="{{asset('js/sticky-kit.min.js')}}"></script>
    <!--Custom JavaScript -->
    {{-- <script src="js/custom.min.js"></script> --}}
    <script src="{{ asset('js/custom.min.js')}}" type="text/javascript"></script>
    {{-- <script src="{{ asset('js/custom.js')}}" type="text/javascript"></script> --}}

    <script src="{{ asset('js/customMain.js')}}" type="text/javascript"></script>


    @yield('scripts')
    {{-- Global Document Ready Function --}}
    <script>
        jQuery(document).ready(function() {
            @yield('jQuery')
        });
    </script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    {{-- <script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script> --}}
    {{-- <script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script> --}}
    <!-- Chart JS -->
    {{-- <script src="../assets/plugins/echarts/echarts-all.js"></script> --}}
    <!-- Chart JS -->
    {{-- <script src="js/dashboard1.js"></script> --}}
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    {{-- <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script> --}}

</body>
</html>