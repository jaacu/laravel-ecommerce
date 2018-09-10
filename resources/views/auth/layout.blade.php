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
            <div class="login-register" style="background-image:url({{asset('assets/images/background/login-register.jpg')}});">
                <div>
                    <h4><a class="link" style="position: fixed; top: 3.5%; left: 2%; color: white;" href="/">Back to the homepage.</a></h4>
                </div>
            
                @yield('content')

            </div>
                    
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