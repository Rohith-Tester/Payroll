@props([
    'pageTitle' => 'Document',
    'backUrl' => null,
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }} — {{ config('app.name', 'Payroll') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,600;0,9..40,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/document-print.css') }}">
    @stack('styles')
</head>
<body class="doc-print-body">
    <div class="doc-print-toolbar no-print">
        @if ($backUrl)
            <a href="{{ $backUrl }}" class="doc-print-back">← Back to list</a>
        @else
            <span></span>
        @endif
        <button type="button" class="doc-print-btn" onclick="window.print()">Print / Save as PDF</button>
    </div>
    @if (session('success'))
        <div class="doc-flash no-print" role="status">{{ session('success') }}</div>
    @endif
    <div class="doc-page">
        {{ $slot }}
    </div>
</body>
</html>
