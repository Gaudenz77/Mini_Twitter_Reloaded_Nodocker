<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="./assetsown/img/hqdefault.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="627">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/css/areset.css', 'resources/css/custom.css'])
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/d4cbcb96c8.js" crossorigin="anonymous"></script>
    <!-- hier wird der Wert von der section "title" eines blade templates ausgefüllt, welches dieses layout "extended" -->
    <title class="">Welcome to Mini-Twitter</title>
</head>

<body>
    <nav class="navbarOwn navbar navbar-expand-lg {{-- navbar-light --}} {{-- bg-light --}}">
        <div class="container">
            <a class="navbar-brand brandOwn" href="/messages">
                <i class="fa-brands fa-twitter fa-spin titlelogo" style="--fa-animation-iteration-count: 1;"></i>
                @yield('title')
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item mt-1 pt-3 px-2">
                        <button class="btn btn-outline-secondary" onclick="toggleDarkMode()">Toggle Dark Mode</button>
                    </li>
                    @auth
                    <li class="nav-link mb-0 mt-1 pt-3">
                        <p class="nav-link" style="">Welcome <b>{{ Auth::user()->name }}</b></p>
                    </li>
                    <li class="nav-item mt-1 pt-3 px-2" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <a class="btn btn-primary" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item px-2" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="btn btn-circlesmall mt-3"><i
                                    class="fa-solid fa-right-from-bracket fa-2x fa-flip"
                                    style="--fa-animation-iteration-count: 1;"></i></button>
                        </form>
                    </li>
                    <li class="nav-item px-2" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <x-button-test />
                    </li>
                    @else
                    <li class="nav-item px-2" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item px-2" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                    @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    


    <div class="container">
        <div class="row justify-content-center">
            <!-- hier wird auch der Wert von der section "title" eines blade templates ausgefüllt, welches dieses layout "extended" -->

            <!-- hier wird der Wert von der section "content" eines blade templates ausgefüllt, welches dieses layout "extended" -->
            @yield('content')
            <!-- hier wird die php Funktion date() aufgerufen mit dem Format-Pattern 'd.m.Y' und im html ausgegeben-->
        </div>
    </div>

    <!-- toggle mode script start -->
    <script>
        // Read the value of the "darkMode" cookie
        const cookies = document.cookie.split("; ");
        const darkModeCookie = cookies.find(cookie => cookie.startsWith("darkMode="));
        const darkModeOn = darkModeCookie ? (darkModeCookie.split("=")[1] === "on") : false;

        // Set the "dark-mode" class on the body element if necessary
        if (darkModeOn) {
            document.body.classList.add("dark-mode");
        }

        function setDarkModePreference(darkModeOn) {
            const cookieValue = darkModeOn ? "on" : "off";
            document.cookie = `darkMode=${cookieValue}; path=/; max-age=${60 * 60 * 24 * 365}`;
        }

        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            setDarkModePreference(document.body.classList.contains('dark-mode'));
        }
    </script>
    <!-- toggle mode script end-->
    @vite(['resources/js/custom.js', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>

</body>

</html>
