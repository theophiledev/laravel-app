<x-guest-layout>
    <style>
        body {
            background: url('/images/foodimage.png') no-repeat center center fixed;
            background-size: cover;
        }
        .login-card {
            background: rgba(255,255,255,0.92);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            max-width: 400px;
            width: 100%;
        }
        .login-title {
            font-size: 2rem;
            font-weight: bold;
            color: #22223b;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .login-btn {
            background: #38b000;
            color: #fff;
            font-weight: bold;
            border-radius: 6px;
            padding: 0.75rem 0;
            width: 100%;
            margin-top: 1.5rem;
            transition: background 0.2s;
        }
        .login-btn:hover {
            background: #008000;
        }
        .login-links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.2rem;
        }
        .login-links a {
            color: #1d3557;
            text-decoration: underline;
            font-size: 0.97rem;
        }
          .logo {
            display: block;
            margin: 0 auto 1.2rem auto;
            max-width: 90px;
        }
    </style>
    <div class="min-h-screen flex items-center justify-center">
        <div class="login-card">
            <img src="/images/logo.png" alt="Logo" class="logo">
            <div class="login-title">Login Form</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Reg Number -->
                <div>
                    <label for="regnumber" class="block mb-1 font-semibold">Reg Number:</label>
                    <input id="regnumber" class="block w-full rounded border-gray-300 px-3 py-2 mb-3" type="text" name="regnumber" :value="old('regnumber')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('regnumber')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-1 font-semibold">Password:</label>
                    <input id="password" class="block w-full rounded border-gray-300 px-3 py-2 mb-3" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <button class="login-btn" type="submit">
                    Login
                </button>

                <div class="login-links">
                    <a href="{{ route('register') }}">Sign up</a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
