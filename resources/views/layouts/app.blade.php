<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Nunito', sans-serif;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-header {
            font-size: 1.5rem;
            font-weight: bold;
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
        }
        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
        }
        .otp-input {
            width: 3rem;
            height: 3rem;
            font-size: 1.5rem;
            text-align: center;
            border: 1px solid #ccc;
        }
        .otp-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn {
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 5px;
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            color: white;
        }
        .btn:hover {
            background: linear-gradient(45deg, #0056b3, #003d80);
        }
        .alert {
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .card-header {
                font-size: 1.2rem;
            }
            .form-control {
                font-size: 0.9rem;
                padding: 8px;
            }
            .btn {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
            .otp-input {
                width: 2.5rem;
                height: 2.5rem;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
