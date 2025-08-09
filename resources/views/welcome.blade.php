<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Digital Meal Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font (Figtree from Google Fonts) -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Internal CSS -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb;
        }

        h1, h2, h3 {
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .btn {
            transition: all 0.3s ease;
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
        }

        .btn:hover {
            transform: scale(1.02);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
        }

        th {
            background-color: #f1f5f9;
            font-weight: 600;
        }

        /* Animation */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mobile-specific improvements */
        @media (max-width: 768px) {
            .btn {
                padding: 0.875rem 1.25rem;
                font-size: 0.875rem;
                width: 100%;
                margin-bottom: 0.5rem;
            }
            
            .space-x-4 {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .space-x-4 > * {
                margin: 0;
            }
        }

        /* Touch-friendly improvements */
        @media (hover: none) and (pointer: coarse) {
            .btn:hover {
                transform: none;
            }
        }
    </style>
</head>
<body class="text-gray-800">

    <!-- Hero Section -->
    <section class="text-center py-12 md:py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 md:px-6">
            <h1 class="text-3xl md:text-4xl lg:text-6xl mb-4 md:mb-6 text-blue-700">Welcome to Digital Meal Management</h1>
            <p class="text-base md:text-lg lg:text-xl mb-6 md:mb-8 text-gray-600">Simplifying student meal tracking and management efficiently and securely.</p>
            <div class="space-x-4 flex flex-col sm:flex-row sm:space-x-4 sm:space-y-0 space-y-2">
                <a href="{{ route('login') }}" class="btn bg-blue-600 text-white hover:bg-blue-700">Login</a>
                <a href="{{ route('register') }}" class="btn bg-gray-300 text-gray-800 hover:bg-gray-400">Register</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 md:px-6 fade-in" id="about-section">
            <h2 class="text-2xl md:text-3xl lg:text-4xl text-center mb-8 md:mb-10 text-gray-800">Why Choose Us?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10 text-center">
                <div class="p-4 md:p-6 bg-white rounded-xl shadow-md hover:shadow-lg">
                    <h3 class="text-lg md:text-xl font-semibold text-blue-600 mb-2">Secure</h3>
                    <p class="text-sm md:text-base">Student data is protected and accessible only by authorized users.</p>
                </div>
                <div class="p-4 md:p-6 bg-white rounded-xl shadow-md hover:shadow-lg">
                    <h3 class="text-lg md:text-xl font-semibold text-blue-600 mb-2">Fast</h3>
                    <p class="text-sm md:text-base">View and manage meals with real-time updates and dashboard analytics.</p>
                </div>
                <div class="p-4 md:p-6 bg-white rounded-xl shadow-md hover:shadow-lg">
                    <h3 class="text-lg md:text-xl font-semibold text-blue-600 mb-2">Reliable</h3>
                    <p class="text-sm md:text-base">Reduce paper use, ensure accuracy, and maintain consistent tracking.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sample Table Section -->
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-5xl mx-auto px-4 md:px-6">
            <h2 class="text-xl md:text-2xl font-bold mb-6 text-center">Recent Student Meals</h2>
            <div class="overflow-x-auto">
                <table class="table-auto shadow-lg rounded-xl overflow-hidden w-full">
                    <thead>
                        <tr>
                            <th class="px-3 md:px-4 py-2 md:py-3 text-sm md:text-base">Student</th>
                            <th class="px-3 md:px-4 py-2 md:py-3 text-sm md:text-base">Meal</th>
                            <th class="px-3 md:px-4 py-2 md:py-3 text-sm md:text-base">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-sm md:text-base">John Doe</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-sm md:text-base">Lunch</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-sm md:text-base">12:30 PM</td>
                        </tr>
                        <tr>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-sm md:text-base">Jane Smith</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-sm md:text-base">Breakfast</td>
                            <td class="px-3 md:px-4 py-2 md:py-3 text-sm md:text-base">8:15 AM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 md:py-10">
        <div class="max-w-6xl mx-auto px-4 md:px-6 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10 text-sm">
            <div>
                <h3 class="text-base md:text-lg font-semibold mb-3 md:mb-4">About</h3>
                <p class="text-xs md:text-sm">We are a college-based team focused on digitalizing meal systems for better health tracking.</p>
            </div>
            <div>
                <h3 class="text-base md:text-lg font-semibold mb-3 md:mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('login') }}" class="hover:underline text-xs md:text-sm">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:underline text-xs md:text-sm">Register</a></li>
                    <li><a href="#" class="hover:underline text-xs md:text-sm">Support</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-base md:text-lg font-semibold mb-3 md:mb-4">Contact</h3>
                <p class="text-xs md:text-sm">RP Ngoma College<br>Email: support@digitalmeals.rw<br>Phone: +250 78 000 000</p>
            </div>
        </div>
        <div class="text-center text-xs mt-6 md:mt-8">© {{ date('Y') }} Digital Meal System. All rights reserved.</div>
    </footer>

    <!-- Internal JS for animation -->
    <script>
        // Simple fade-in on scroll
        window.addEventListener('scroll', () => {
            document.querySelectorAll('.fade-in').forEach(el => {
                if (el.getBoundingClientRect().top < window.innerHeight - 100) {
                    el.classList.add('show');
                }
            });
        });
    </script>
</body>
</html>
