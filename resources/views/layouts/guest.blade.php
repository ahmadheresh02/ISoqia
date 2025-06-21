<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .bg-blue-600 { background-color: #2563eb; }
        .hover\:bg-blue-700:hover { background-color: #1d4ed8; }
        .text-blue-600 { color: #2563eb; }
        .hover\:text-blue-500:hover { color: #3b82f6; }
        .focus\:ring-blue-500:focus { --tw-ring-color: #3b82f6; }
        .focus\:border-blue-500:focus { border-color: #3b82f6; }
        .text-blue-800 { color: #1e40af; }
    </style>
</head>
<body class="font-sans antialiased text-gray-900">
    @yield('content')
</body>
</html>