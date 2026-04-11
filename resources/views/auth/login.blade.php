<x-layouts.auth
    title="Sign in"
    subtitle="Enter your work email and password to access your dashboard."
>
    <x-slot name="footer">
        New to {{ config('app.name', 'Payroll') }}?
        <a href="{{ route('register') }}">Create an account</a>
    </x-slot>

    @if ($errors->any() && ! $errors->has('email'))
        <div class="auth-banner-error" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form class="auth-form" method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <x-auth.text-input
            label="Work email"
            name="email"
            type="email"
            autocomplete="username"
            :required="true"
        />

        <x-auth.text-input
            label="Password"
            name="password"
            type="password"
            autocomplete="current-password"
            :required="true"
        />

        <div class="auth-row">
            <label class="auth-checkbox">
                <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
                <span>Remember this device</span>
            </label>
        </div>

        <x-auth.primary-button>Sign in</x-auth.primary-button>
    </form>
</x-layouts.auth>
