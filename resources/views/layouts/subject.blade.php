<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing_page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home_main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/right_main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/subject.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    {{-- @include('layouts.navbar') --}}

    <main>
        <div class="subject-detail">
            <div class="show-card container">
                <h3 class="show-card__title">{{ $subject->name }} ({{ count($expiryCards) }} thẻ tới hạn)</h3>
                <div class="row">
                    <!-- Show card right -->
                    @include('layouts.subject.right_subject')

                    <!-- Show card left -->
                    @include('layouts.subject.show_card')
                </div>
            </div>

            <!-- Subject utility -->
            @include('layouts.subject.utility')

            <!-- Show card list -->
            @include('layouts.subject.list_card')

        </div>
    </main>

    @include('layouts.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</body>
</html>
