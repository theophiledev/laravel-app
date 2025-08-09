<x-guest-layout>
    <style>
        body {
            background: url('/images/foodimage.png') no-repeat center center fixed;
            background-size: cover;
        }
        .register-card {
            background: rgba(255,255,255,0.92);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            max-width: 430px;
            width: 100%;
        }
        .register-title {
            font-size: 2rem;
            font-weight: bold;
            color: #22223b;
            text-align: center;
            margin-bottom: 1.2rem;
        }
        .register-btn {
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
        .register-btn:hover {
            background: #008000;
        }
        .register-links {
            margin-top: 1.2rem;
            text-align: center;
        }
        .register-links a {
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
        <div class="register-card">
            <img src="/images/logo.png" alt="Logo" class="logo">
            <div class="register-title">Registration Form</div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block mb-1 font-semibold">Name:</label>
                    <input id="name" class="block w-full rounded border-gray-300 px-3 py-2 mb-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Reg Number -->
                <div>
                    <label for="regnumber" class="block mb-1 font-semibold">Reg Number:</label>
                    <input id="regnumber" class="block w-full rounded border-gray-300 px-3 py-2 mb-3" type="text" name="regnumber" :value="old('regnumber')" required />
                    <x-input-error :messages="$errors->get('regnumber')" class="mt-2" />
                </div>

                <!-- Campus -->
                <div>
                    <label for="campus" class="block mb-1 font-semibold">Campus:</label>
                    <select id="campus" name="campus" class="block w-full rounded border-gray-300 px-3 py-2 mb-3" required>
                        <option value="" disabled selected>Select your campus</option>
                        <option value="College of Arts and Social Sciences">College of Arts and Social Sciences</option>
                        <option value="College of Education">College of Education</option>
                        <option value="College of Science and Technology">College of Science and Technology</option>
                        <option value="College of Business and Economics">College of Business and Economics</option>
                        <option value="College of Agriculture, Animal Sciences and Veterinary Medicine">College of Agriculture, Animal Sciences and Veterinary Medicine</option>
                        <option value="College of Medicine and Health Sciences">College of Medicine and Health Sciences</option>
                        <option value="College of Law">College of Law</option>
                        <option value="College of Engineering and Architecture">College of Engineering and Architecture</option>
                    </select>
                    <x-input-error :messages="$errors->get('campus')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block mb-1 font-semibold">Email:</label>
                    <input id="email" class="block w-full rounded border-gray-300 px-3 py-2 mb-3" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block mb-1 font-semibold">Phone Number:</label>
                    <input id="phone" class="block w-full rounded border-gray-300 px-3 py-2 mb-3" type="tel" name="phone" :value="old('phone')" required />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-1 font-semibold">Password:</label>
                    <input id="password" class="block w-full rounded border-gray-300 px-3 py-2 mb-3" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block mb-1 font-semibold">Confirm Password:</label>
                    <input id="password_confirmation" class="block w-full rounded border-gray-300 px-3 py-2 mb-3" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button class="register-btn" type="submit">
                    Sign Up
                </button>

                <div class="register-links">
                    <a href="{{ route('login') }}">Login</a> if you already have an account.
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
