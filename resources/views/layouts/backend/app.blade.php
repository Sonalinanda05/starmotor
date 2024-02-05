<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
</head>

<body>
    @include('layouts.backend.partial.sidebar')

    <div id="main">
        @include('layouts.backend.partial.topbar')
        @yield('content')
        <div class="clearfix"></div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
    <script type="text/javascript">
       
    $(".nav").click(function() {
    $("#sidenavbar").css('width', '70px');
    $("#main").css('margin-left', '70px');
    $(".logo").css('visibility', 'hidden');
    $(".logo span").css('visibility', 'visible');
    $(".logo span").css('margin-left', '-10px');
    $(".icon-a").css('visibility', 'hidden');
    $(".icons").css('visibility', 'visible');
    $(".icons").css('margin-left', '-8px');
    $(".nav").css('display', 'none');
    $(".nav2").css('display', 'block');
    });

    $(".nav2").click(function() {
    $("#sidenavbar").css('width', '300px');
    $("#main").css('margin-left', '300px');
    $(".logo").css('visibility', 'visible');
    $(".logo span").css('visibility', 'visible');
    $(".icon-a").css('visibility', 'visible');
    $(".icons").css('visibility', 'visible');
    $(".nav").css('display', 'block');
    $(".nav2").css('display', 'none');
    });
    </script>
    @stack('scripts')
</body>

</html>
