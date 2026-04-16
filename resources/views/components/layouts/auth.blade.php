@props([
    'title',
    'subtitle' => null,
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
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="auth-body">
    <div class="auth-shell">
        <main class="auth-panel">
            <div class="auth-card">
                <p class="auth-app-name">{{ config('app.name', 'Payroll') }}</p>
                <header class="auth-card__header">
                    <h1 class="auth-card__title">{{ $title }}</h1>
                    @if ($subtitle)
                        <p class="auth-card__subtitle">{{ $subtitle }}</p>
                    @endif
                </header>

                {{ $slot }}

                @isset($footer)
                    <div class="auth-footer">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </main>
    </div>
</body>
</html>
