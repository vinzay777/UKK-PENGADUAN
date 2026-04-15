<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FacilityHub - Login')</title>

    <!-- Tailwind CDN (bisa diganti ke build nanti) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #EEEFE0;
        }
        .title-font {
            font-family: 'Playfair Display', serif;
        }
        /* .capy-wave {
            animation: wave 3s infinite;
            transform-origin: 70% 70%;
        }
        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(15deg); }
            75% { transform: rotate(-15deg); }
        } */
    </style>

    @stack('styles')
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-6 sm:py-8 relative overflow-hidden">

    <!-- Optional subtle background blobs -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-16 -left-16 w-72 h-72 sm:w-96 sm:h-96 bg-orange-200 rounded-full blur-3xl opacity-30"></div>
        <div class="absolute -bottom-16 -right-16 w-72 h-72 sm:w-96 sm:h-96 bg-orange-400 rounded-full blur-3xl opacity-20"></div>
    </div>

    @yield('content')

    @stack('scripts')
</body>
</html>
