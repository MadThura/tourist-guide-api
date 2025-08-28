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

    <x-alert></x-alert>
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url({{ asset('images/bg.jpg') }});">

        <!-- Overlay -->
        {{-- <div class="absolute inset-0 bg-black bg-opacity-50"></div> --}}

        <!-- Content -->
        <div class="relative z-10 text-center px-6 md:px-12">
            <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg">
                Welcome to Tourist Guide App
            </h1>
            <p class="mt-4 text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                Your ultimate iOS companion to discover the best places, attractions, and hidden gems.
                Explore with ease and plan unforgettable trips.
            </p>

            <!-- Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#"
                    class="px-6 py-3 bg-yellow-500 text-black font-semibold rounded-lg shadow-lg hover:bg-yellow-400 transition">
                    🌍 Explore Places
                </a>
                <a href="#about"
                    class="px-6 py-3 bg-white text-gray-900 font-semibold rounded-lg shadow-lg hover:bg-gray-200 transition">
                    About Us
                </a>
                <a href="#contact"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-500 transition">
                    📩 Contact Us
                </a>
            </div>

        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-white text-gray-800" id="about">
        <div class="max-w-6xl mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">📱 About Our iOS App</h2>
            <p class="text-lg md:text-xl leading-relaxed max-w-3xl mx-auto mb-10">
                The <span class="font-semibold text-yellow-600">Tourist Guide iOS App</span> is designed to make
                your
                travels easier.
                Whether you are exploring a new city or revisiting your favorite spots, our app provides:
            </p>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-xl mb-2">🌍 Explore Places</h3>
                    <p>Discover top destinations, attractions, and hidden gems curated for travelers like you.</p>
                </div>
                <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-xl mb-2">⭐ Ratings & Reviews</h3>
                    <p>Check ratings and feedback from other travelers to plan the best experience.</p>
                </div>
                <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-xl mb-2">🗺️ Easy Navigation</h3>
                    <p>Find directions, maps, and helpful travel tips to make your journey smooth and memorable.</p>
                </div>
            </div>

            <!-- App Store CTA -->
            <div class="mt-12">
                <a href="#"
                    class="inline-flex items-center px-6 py-3 bg-black text-white rounded-lg shadow hover:bg-gray-800 transition">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 384 512">
                        <path
                            d="M318.7 268.2c-.3-37.4 16.6-65.9 52.2-86.5-19.1-27.6-47.8-42.7-85.2-45.1-35.9-2.3-75.1 21.1-89.5 21.1-14.8 0-49.4-20.6-76.6-20.6C72.7 137.1 0 192.6 0 297.5c0 62.9 23 130.4 51.6 173.2 24.1 36.6 52.3 77.7 89.8 76.3 35.6-1.4 49-23.1 92-23.1 42.6 0 55.3 23.1 91.6 22.4 38.2-.7 62.3-37 86.2-73.8 27.1-40 38.3-78.7 38.6-80.9-1-.4-74-28.5-74.1-112.9zM251.4 91.6c23.9-28.9 40.2-69.2 35.7-109.6-34.5 1.3-76.1 22.9-100.7 51.8-22.1 26.4-41.4 67.7-36.2 107.4 38.7 3 77.2-19.9 101.2-49.6z" />
                    </svg>
                    Download on the App Store
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-gray-100 text-gray-800" id="contact">
        <div class="max-w-4xl mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">📩 Contact Us</h2>
            <p class="text-lg md:text-xl leading-relaxed max-w-2xl mx-auto mb-10">
                Have questions or feedback? We'd love to hear from you! Fill out the form below, and our team will
                get
                back to you shortly.
            </p>

            <!-- Contact Form -->
            <form action="{{ route('contact.send') }}" method="POST" class="space-y-6 text-left">
                @csrf
                @method('POST')
                <div>
                    <label for="name" class="block text-sm font-medium">Your Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium">Your Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none">
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium">Your Message</label>
                    <textarea id="message" name="message" rows="4"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-yellow-500 focus:outline-none"></textarea>
                </div>
                <button type="submit"
                    class="w-full py-3 bg-yellow-500 text-black font-semibold rounded-lg shadow-lg hover:bg-yellow-400 transition">
                    🚀 Send Message
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-6 bg-gray-900 text-center text-gray-400 text-sm">
        © {{ date('Y') }} Tourist Guide App. All rights reserved.
    </footer>

</body>

</html>
