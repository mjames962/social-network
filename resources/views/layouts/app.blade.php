<!doctype html>
<html lang = "en">

<head>
    <title> Social Network - @yield('title')</title>
</head>

<body>
    <h1> Social Network - @yield('title')</h1>

    @if (session('message'))
        <p><b>{{ session('message') }}</b></p>
    @endif
  
  @if ($errors->any())
    <div>
        Error(s):
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        
        </ul>
    </div>
  @endif
  
  
    <div>
        @yield('content')
    </div>

<body>

</html>