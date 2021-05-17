<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing_page.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home_main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/right_main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/subject.css') }}" rel="stylesheet">
    <link href="{{ asset('css/library.css') }}" rel="stylesheet">
    <link href="{{ asset('css/subject_creater.css') }}" rel="stylesheet">
    <link href="{{ asset('css/exam.css') }}" rel="stylesheet">
    <link href="{{ asset('css/writing.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    
</head>
<body>
    @include('layouts.navbar')

    <main>
            @auth
                @yield('content')
            @endauth
                
            @guest
                @yield('content')
            @endguest
    </main>
    

    @include('layouts.footer')
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    @yield('script')
    
    <script>
        const btnCreateFolder = document.querySelector('#btn_create_folder');
        const inputFolderTitle = document.querySelector('#folder_title');

        inputFolderTitle.addEventListener('keydown', function() {
            if (inputFolderTitle.value === '') {
                btnCreateFolder.disabled = true;
                console.log(inputFolderTitle.value);
            }
            else {
                btnCreateFolder.disabled = false;
                console.log(inputFolderTitle.value);
            }
            
        });
    </script>
</body>
</html>