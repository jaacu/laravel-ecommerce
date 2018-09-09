<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head')
</head>
<body>
@include('shared.template-spinner')
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <section id="wrapper">
            
            @yield('content')
                    
        </section>

    </div>

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

    <script src="{{ asset('js/custom.js')}}" type="text/javascript"></script>

    {{-- <script src="{{ asset('js/validation.js')}}" type="text/javascript"></script> --}}

    <script src="{{ asset('js/customMain.js')}}" type="text/javascript"></script>


    @yield('scripts')


</body>
</html>