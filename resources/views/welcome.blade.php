<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Tourist Guide</title>

    @vite('resources/css/app.css')

    <style>
        html {
            scroll-behavior: smooth;
        }

        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body class="antialiased bg-gray-100">

    <x-alert />

    <!-- ================= HERO SECTION ================= -->
    <section
        class="relative min-h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url({{ asset('images/bg.jpg') }});">

        <!-- Admin Login Button -->
        <div class="absolute top-6 right-6 z-20">
            <a
                href="{{ url('/admin/login') }}"
                class="px-4 py-2 bg-white/90 text-gray-900 font-semibold rounded-lg shadow hover:bg-white transition backdrop-blur">
                🔐 Admin Login
            </a>
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Content -->
        <div class="relative z-10 text-center px-4 sm:px-6 md:px-12">
            <h1
                class="text-3xl sm:text-4xl md:text-6xl font-bold text-white drop-shadow-lg">
                Welcome to Tourist Guide App
            </h1>

            <p
                class="mt-4 text-base sm:text-lg md:text-xl text-gray-200 max-w-2xl mx-auto">
                Your ultimate iOS companion to discover the best places,
                attractions, and hidden gems. Explore with ease and plan
                unforgettable trips.
            </p>

            <!-- Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a
                    href="#"
                    class="w-full sm:w-auto px-6 py-3 bg-yellow-500 text-black font-semibold rounded-lg shadow-lg hover:bg-yellow-400 transition text-center">
                    🌍 Explore Places
                </a>

                <a
                    href="#about"
                    class="w-full sm:w-auto px-6 py-3 bg-white text-gray-900 font-semibold rounded-lg shadow-lg hover:bg-gray-200 transition text-center">
                    About Us
                </a>

                <a
                    href="#contact"
                    class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-500 transition text-center">
                    📩 Contact Us
                </a>
            </div>
        </div>
    </section>

    <!-- ================= ABOUT SECTION ================= -->
    <section id="about" class="py-12 md:py-16 bg-white text-gray-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 md:px-12 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6">
                📱 About Our iOS App
            </h2>

            <p
                class="text-base sm:text-lg md:text-xl leading-relaxed max-w-3xl mx-auto mb-10">
                The
                <span class="font-semibold text-yellow-600">
                    Tourist Guide iOS App
                </span>
                is designed to make your travels easier. Whether you are
                exploring a new city or revisiting your favorite spots, our app
                provides:
            </p>

            <!-- Features Grid -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 text-left">
                <div
                    class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-xl mb-2">
                        🌍 Explore Places
                    </h3>
                    <p>
                        Discover top destinations, attractions, and hidden gems
                        curated for travelers like you.
                    </p>
                </div>

                <div
                    class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-xl mb-2">
                        ⭐ Ratings & Reviews
                    </h3>
                    <p>
                        Check ratings and feedback from other travelers to plan
                        the best experience.
                    </p>
                </div>

                <div
                    class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-xl mb-2">
                        🗺️ Easy Navigation
                    </h3>
                    <p>
                        Find directions, maps, and helpful travel tips to make
                        your journey smooth and memorable.
                    </p>
                </div>
            </div>

            <!-- App Store Button -->
            <div class="mt-12">
                <a
                    href="#"
                    class="inline-flex items-center px-6 py-3 bg-black text-white rounded-lg shadow hover:bg-gray-800 transition">
                    <i class="fa-brands fa-apple text-2xl mr-2"></i>
                    Download on the App Store
                </a>
            </div>
        </div>
    </section>

    <!-- ================= CONTACT SECTION ================= -->
    <section id="contact" class="py-12 md:py-16 bg-gray-100 text-gray-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 md:px-12 text-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6">
                📩 Contact Us
            </h2>

            <p
                class="text-base sm:text-lg md:text-xl leading-relaxed max-w-2xl mx-auto mb-10">
                Have questions or feedback? We'd love to hear from you!
            </p>

            <form
                action="{{ route('contact.send') }}"
                method="POST"
                class="space-y-6 text-left">
                @csrf

                <div>
                    <label class="block text-sm font-medium">Your Name</label>
                    <input
                        type="text"
                        name="name"
                        class="w-full mt-2 p-3 sm:p-4 border rounded-lg text-base focus:ring-2 focus:ring-yellow-500 focus:outline-none" />
                </div>

                <div>
                    <label class="block text-sm font-medium">Your Email</label>
                    <input
                        type="email"
                        name="email"
                        class="w-full mt-2 p-3 sm:p-4 border rounded-lg text-base focus:ring-2 focus:ring-yellow-500 focus:outline-none" />
                </div>

                <div>
                    <label class="block text-sm font-medium">Your Message</label>
                    <textarea
                        name="message"
                        rows="4"
                        class="w-full mt-2 p-3 sm:p-4 border rounded-lg text-base focus:ring-2 focus:ring-yellow-500 focus:outline-none"></textarea>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 sm:py-4 bg-yellow-500 text-black font-semibold rounded-lg shadow-lg hover:bg-yellow-400 transition">
                    🚀 Send Message
                </button>
            </form>
        </div>
    </section>

    <!-- ================= FOOTER ================= -->
    <footer
        class="py-6 bg-gray-900 text-center text-gray-400 text-sm px-4">
        © {{ date('Y') }} Tourist Guide App. All rights reserved.
    </footer>

    <script src="https://kit.fontawesome.com/6c05f0a96c.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
</body>

</html>