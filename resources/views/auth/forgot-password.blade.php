<x-guest-layout>
    <style>
        body {
            background: url('/images/restophoto2.jpeg') no-repeat center center fixed;
            background-size: cover;
        }
        .forgot-card {
            background: rgba(255,255,255,0.92);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            max-width: 400px;
            width: 100%;
        }
        .forgot-title {
            font-size: 2rem;
            font-weight: bold;
            color: #22223b;
            text-align: center;
            margin-bottom: 1.2rem;
        }
        .forgot-btn {
            background: #38b000;
            color: #fff;
            font-weight: bold;
            border-radius: 6px;
            padding: 0.75rem 0;
            width: 100%;
            margin-top: 1.5rem;
            transition: background 0.2s;
            border: none;
        }
        .forgot-btn:hover {
            background: #008000;
        }
          .logo {
            display: block;
            margin: 0 auto 1.2rem auto;
            max-width: 90px;
        }
    </style>
    <div class="min-h-screen flex items-center justify-center">
        <div class="forgot-card">
            <img src="/images/logo.png" alt="Logo" class="logo">
            <div class="forgot-title">Forgot Password</div>
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 text-center">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full rounded border-gray-300 px-3 py-2 mb-3" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <button class="forgot-btn" type="submit">
                    {{ __('Email Password Reset Link') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
