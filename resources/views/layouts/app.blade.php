<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    

    <!-- Style BS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles    
</head>
<body class="font-[Poppins]">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand fw-bold m-0" style="color: #1E388D;" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    SIBESI
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                <!-- Middle of Navbar -->
                    <ul class="navbar-nav mx-auto" style="font-family: 'Poppins', sans-serif;">
                                <li class="nav-item">
                                    <a class="nav-link fw-bold" style="color: #1E388D;" href="{{ url('/#home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/#order') }}">Order</a>
                                </li>
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/#about') }}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/#contact') }}">Contact</a>
                                </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <!-- Authentication Links -->
                            <ul class="navbar-nav ms-auto">
                            @guest
                            @if (Route::has('register'))
                            <a class="btn text-white px-4 py-2" href="{{ route('login') }}" style="background-color: #1E388D; border-radius: 50px;">
                            Sign in</a>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireScripts
    <!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true,
  });
  // === Global Dark Mode Loader ===
  function applyDarkMode() {
    if (localStorage.getItem('darkMode') === 'true') {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  }
  document.addEventListener('DOMContentLoaded', applyDarkMode);
  window.addEventListener('storage', function(e) {
    if (e.key === 'darkMode') applyDarkMode();
  });
</script>
</body>
</html>
