<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom CSS for background image -->
    <style type="text/tailwindcss">
        body {
            background-image: url('/images/replacement.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            width: 30vh;
            height: 60vh;
        }

        .title{
            @apply text-[3.125rem] leading-[1.1] font-semibold tracking-wide;
        }

        .subtitle{
            @apply text-[1.625rem] font-semibold;
        }
    </style>
</head>
<body>
    <div class="absolute top-0 bottom-0 left-0 right-0 bg-gradient-to-b from-black/90 via-black/50 to-black/90">
        <div class="relative z-10 flex flex-col text-center px-5 items-center justify-center w-[85%] max-w-[800px] text-white h-full mx-auto gap-3">
            <!--Main text-->
        <h1 class="title">Hardware Issues Management System</h1>
        <h5 class="subtitle py-[12px]">NAICC Gannoruwa</h5>
        <!--Login Register Dashboard Buttons-->
        <div>
            @if (Route::has('login'))
            @auth
            <button class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700"><a href="{{ url('/dashboard') }}" class="font-semibold text-white">Dashboard</a></button>
            @else
                <button class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700"><a href="{{ route('login') }}" class="font-semibold text-white">Log in</a></button>

                @if (Route::has('register'))
                    <button class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700"><a href="{{ route('register') }}" class="font-semibold text-white">Register</a></button>
                @endif
            @endauth
        @endif
        </div>
        </div>
    </div>
</body>
</html>

