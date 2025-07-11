<x-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
        <h1 class="text-2xl font-bold mb-6">Application Settings</h1>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- App Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Application Name</label>
                <input type="text" name="app_name" value="{{ old('app_name', $setting->app_name ?? '') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <!-- Logo -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                @if ($setting->logo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" class="h-16">
                </div>
                @endif
                <input type="file" name="logo" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <!-- Contact Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Email</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $setting->contact_email ?? '') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="text" name="contact_phone" value="{{ old('contact_phone', $setting->contact_phone ?? '') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <!-- Address -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <textarea name="contact_address" rows="2"
                    class="w-full border border-gray-300 rounded px-3 py-2">{{ old('contact_address', $setting->contact_address ?? '') }}</textarea>
            </div>

            <!-- Footer Text -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Footer / Tagline</label>
                <input type="text" name="footer_text" value="{{ old('footer_text', $setting->footer_text ?? '') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</x-layout>