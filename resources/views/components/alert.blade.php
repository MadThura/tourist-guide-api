@if (session()->has('success') || session()->has('fail'))
    <div id="alertBox"
        class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md shadow-xl rounded-xl overflow-hidden">
        @if (session()->has('success'))
            <div class="bg-green-100 text-green-800 flex items-start justify-between gap-4 px-6 py-4">
                <div class="flex items-start gap-2">
                    <span class="text-base font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('alertBox').style.display='none'"
                    class="text-green-700 hover:text-green-900 transition cursor-pointer">
                    &times;
                </button>
            </div>
        @elseif (session()->has('fail'))
            <div class="bg-red-100 text-red-800 flex items-start justify-between gap-4 px-6 py-4">
                <div class="flex items-start gap-2">
                    <span class="text-base font-medium">{{ session('fail') }}</span>
                </div>
                <button onclick="document.getElementById('alertBox').style.display='none'"
                    class="text-red-700 hover:text-red-900 transition cursor-pointer">
                    &times;
                </button>
            </div>
        @endif
    </div>

    <script>
        // Automatically hide after 4 seconds (4000ms)
        setTimeout(() => {
            const alertBox = document.getElementById('alertBox');
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s";
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500); // remove from DOM after fade-out
            }
        }, 4000);
    </script>
@endif
