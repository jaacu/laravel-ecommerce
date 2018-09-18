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