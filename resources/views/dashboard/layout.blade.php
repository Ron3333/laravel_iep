<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/css/estilo.css', 'resources/js/app.js'])   
    
</head>
<body>
    @if (session('status'))
    <br>
     {{ session('status') }}
    @endif
     @if (session('status2'))
    <br>
     {{ session('status2') }}
    @endif
    <br>
    @session('key-xx')
         {{ $value }}
    @endsession
    @yield('content')
    <br>
    <br>
    <a style="text-decoration: none; border: 1px solid #ccc; padding: 5px;" href="{{ route('dashboard') }}">Dashboard</a>
</body>
</html>
