<div id="alertBox" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 text-white px-8 py-4 rounded-lg"
    role="alert"
    @if (session()->has('success') || session()->has('fail')) style="display: block;" @else style="display: none;" @endif>

    @if (session()->has('success'))
    <div class="bg-green-500 flex justify-between items-center p-4 rounded-lg">
        <span class="flex-1 text-lg">{{ session('success') }}</span>
        <button onclick="document.getElementById('alertBox').style.display='none'"
            class="bg-green-600 text-white w-8 h-8 flex items-center justify-center text-m font-bold rounded-full border-white hover:bg-green-700 transition duration-300 ease-in-out">x</button>
    </div>
    @elseif (session()->has('fail'))
    <div class="bg-red-500 flex justify-between items-center p-4 rounded-lg">
        <span class="flex-1 text-lg">{{ session('fail') }}</span>
        <button onclick="document.getElementById('alertBox').style.display='none'"
            class="bg-red-600 text-white w-8 h-8 flex items-center justify-center text-m font-bold rounded-full border-white hover:bg-red-700 transition duration-300 ease-in-out">x</button>
    </div>
    @endif

</div>