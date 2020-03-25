<html lang="en" class="perfect-scrollbar-on">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>
        @yield('title')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
          name="viewport">
    <!--     Fonts and icons     -->

    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/datatables.css')}}"/>

@yield('css')
<body class="">
<div class="wrapper ">
    @include('backend.layouts.slideBar')
    <div class="main-panel ps-container ps-theme-default ps-active-y" data-ps-id="0c17f1c4-0a8e-e416-0637-a68da7634f41">
        <!-- Navbar -->
            @include('backend.layouts.navbar')
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                @yield('footer')
            </div>
        </footer>
    </div>
</div>
<!--   Core JS Files   -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"
        integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb"
        crossorigin="anonymous"></script>
<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}"></script>
<script src="https://unpkg.com/default-passive-events"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
<!-- Chartist JS -->
<script src="{{asset('assets/js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/material-dashboard.js?v=2.1.0')}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->

<script src="{{asset('assets/demo/demo.js')}}"></script>
<script src="{{asset('js/datatables.js')}}"></script>
<script>
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.deleteNotification', function (e) {
            e.preventDefault();

            var id = $(this).data("id");

            $.ajax({
                type: "get",
                url: "http://testt.test/admin/notification/" + id,
                success: function (data) {
                    $('#notifications').empty().html(data);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    })
</script>


@yield('script')

</body>
</html>
