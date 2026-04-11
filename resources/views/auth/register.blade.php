<x-layouts.auth
    title="Create your account"
    subtitle="Use your work details. You’ll sign in with email and password."
>
    <x-slot name="footer">
        Already registered?
        <a href="{{ route('login') }}">Sign in</a>
    </x-slot>

    <form class="auth-form" method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <x-auth.text-input
            label="Full name"
            name="user_name"
            type="text"
            autocomplete="name"
            :required="true"
        />

        <x-auth.text-input
            label="Work email"
            name="email"
            type="email"
            autocomplete="email"
            :required="true"
        />

        <x-auth.text-input
            label="Password"
            name="password"
            type="password"
            autocomplete="new-password"
            :required="true"
        />

        <x-auth.text-input
            label="Confirm password"
            name="password_confirmation"
            type="password"
            autocomplete="new-password"
            :required="true"
        />

        <x-auth.primary-button>Create account</x-auth.primary-button>
    </form>
</x-layouts.auth>
