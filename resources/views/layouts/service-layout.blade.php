<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'KanooX')</title>

    {{-- Common CSS --}}
    <link href="{{ $base_url }}/css/style.css" rel="stylesheet">

    <style>
        /* ==========================
           SERVICE PAGE HEADER
           ========================== */

        .service-header {
            height: 72px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        .service-header img {
            height: 48px;     /* locked size */
            width: auto;
            object-fit: contain;
        }

        /* Zoom safety */
        @media (min-width: 1400px) {
            .service-header img { height: 44px; }
        }

        @media (min-width: 1600px) {
            .service-header img { height: 40px; }
        }

        /* Page wrapper */
        .service-content {
            padding: 40px 24px;
            background: #f6f8fc;
            min-height: calc(100vh - 72px);
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- HEADER --}}
    <header class="service-header">
        <img src="{{ $base_url }}/images/logo.png" alt="KanooX Logo">
    </header>

    {{-- PAGE CONTENT --}}
    <main class="service-content">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
