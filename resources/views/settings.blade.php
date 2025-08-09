<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-6 md:mb-8">
            <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">⚙️ Settings</h1>
            <p class="text-gray-600 text-sm md:text-base">Manage your account settings and security preferences</p>
        </div>

        <!-- Settings Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
            <!-- Password Change Card -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-lock text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Change Password</h2>
                        <p class="text-gray-600 text-sm">Update your account password</p>
                    </div>
                </div>

                @if(session('password_success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('password_success') }}
                    </div>
                @endif

                @if(session('password_error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('password_error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('settings.password') }}" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Current Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="current_password" 
                                   name="current_password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Enter your current password"
                                   required>
                            <button type="button" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    onclick="togglePassword('current_password')">
                                <i class="fas fa-eye" id="current_password_icon"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                            New Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="new_password" 
                                   name="new_password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Enter new password"
                                   required>
                            <button type="button" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    onclick="togglePassword('new_password')">
                                <i class="fas fa-eye" id="new_password_icon"></i>
                            </button>
                        </div>
                        @error('new_password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm New Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="new_password_confirmation" 
                                   name="new_password_confirmation" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                   placeholder="Confirm new password"
                                   required>
                            <button type="button" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    onclick="togglePassword('new_password_confirmation')">
                                <i class="fas fa-eye" id="new_password_confirmation_icon"></i>
                            </button>
                        </div>
                        @error('new_password_confirmation')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                        <i class="fas fa-key mr-2"></i>
                        Update Password
                    </button>
                </form>
            </div>

            <!-- Passkey Management Card -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-shield-alt text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Passkey Management</h2>
                        <p class="text-gray-600 text-sm">Set your meal verification passkey</p>
                    </div>
                </div>

                @if(session('passkey_success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('passkey_success') }}
                    </div>
                @endif

                @if(session('passkey_error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('passkey_error') }}
                    </div>
                @endif

                <!-- Current Passkey Display -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-700">Current Passkey</h3>
                            <p class="text-xs text-gray-500">Used for meal verification</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span id="current_passkey" class="text-lg font-mono font-bold text-gray-800">
                                {{ str_repeat('•', strlen(Auth::user()->passkey ?? '0000')) }}
                            </span>
                            <button type="button" 
                                    class="text-blue-600 hover:text-blue-800 text-sm"
                                    onclick="togglePasskey()">
                                <i class="fas fa-eye" id="passkey_icon"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Change Passkey Form -->
                <form method="POST" action="{{ route('settings.passkey') }}" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label for="new_passkey" class="block text-sm font-medium text-gray-700 mb-2">
                            New Passkey (4+ digits)
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="new_passkey" 
                                   name="new_passkey" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   placeholder="Enter new passkey (min 4 digits)"
                                   pattern="[0-9]{4,}"
                                   maxlength="10"
                                   required>
                            <button type="button" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    onclick="togglePassword('new_passkey')">
                                <i class="fas fa-eye" id="new_passkey_icon"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimum 4 digits, maximum 10 digits</p>
                        @error('new_passkey')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_passkey_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm New Passkey
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="new_passkey_confirmation" 
                                   name="new_passkey_confirmation" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors"
                                   placeholder="Confirm new passkey"
                                   pattern="[0-9]{4,}"
                                   maxlength="10"
                                   required>
                            <button type="button" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    onclick="togglePassword('new_passkey_confirmation')">
                                <i class="fas fa-eye" id="new_passkey_confirmation_icon"></i>
                            </button>
                        </div>
                        @error('new_passkey_confirmation')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Update Passkey
                    </button>
                </form>
            </div>
        </div>

        <!-- Security Tips -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">
                <i class="fas fa-lightbulb mr-2"></i>Security Tips
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-700">
                <div class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-1 text-green-600"></i>
                    <div>
                        <strong>Strong Password:</strong> Use a mix of letters, numbers, and symbols
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-1 text-green-600"></i>
                    <div>
                        <strong>Unique Passkey:</strong> Don't use the same numbers as your password
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-1 text-green-600"></i>
                    <div>
                        <strong>Keep Private:</strong> Never share your passkey with others
                    </div>
                </div>
                <div class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-1 text-green-600"></i>
                    <div>
                        <strong>Regular Updates:</strong> Change your credentials periodically
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '_icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Toggle passkey visibility
        function togglePasskey() {
            const passkeyElement = document.getElementById('current_passkey');
            const icon = document.getElementById('passkey_icon');
            const currentPasskey = '{{ Auth::user()->passkey ?? "0000" }}';
            
            if (passkeyElement.textContent.includes('•')) {
                passkeyElement.textContent = currentPasskey;
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passkeyElement.textContent = '•'.repeat(currentPasskey.length);
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Password strength validation
        document.getElementById('new_password').addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            updatePasswordStrengthIndicator(strength);
        });

        function calculatePasswordStrength(password) {
            let score = 0;
            
            if (password.length >= 8) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;
            
            return score;
        }

        function updatePasswordStrengthIndicator(strength) {
            const strengthText = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
            const strengthColor = ['text-red-600', 'text-orange-600', 'text-yellow-600', 'text-blue-600', 'text-green-600'];
            
            // You can add a strength indicator element here if needed
            console.log('Password strength:', strengthText[strength - 1] || 'Very Weak');
        }

        // Passkey validation
        document.getElementById('new_passkey').addEventListener('input', function() {
            const passkey = this.value;
            const isValid = /^[0-9]{4,10}$/.test(passkey);
            
            if (passkey.length > 0 && !isValid) {
                this.setCustomValidity('Passkey must be 4-10 digits only');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</x-app-layout> 