@props([
    'title' => 'Dashboard',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — {{ config('app.name', 'Payroll') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="app-body">
    <div class="app-layout">
        <aside class="app-sidebar">
            <div class="app-sidebar__brand">{{ config('app.name', 'Payroll') }}</div>
            @include('partials.app-nav')
            <div class="app-sidebar__foot">
                @auth
                    <div class="app-sidebar__user">{{ auth()->user()->user_name ?? auth()->user()->email }}</div>
                @endauth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="app-logout" style="width: 100%; justify-content: center;">Sign out</button>
                </form>
            </div>
        </aside>
        <div class="app-content-wrap">
            <header class="app-topbar">
                <h1 class="app-topbar__title">{{ $title }}</h1>
            </header>
            <main class="app-main">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
